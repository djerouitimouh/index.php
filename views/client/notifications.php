<?php
session_start();
require_once "../../control/db_connection.php";

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['id'])) {
    header('Location: ../../index.php');
    exit;
}

$user_id = $_SESSION['id'];

// Récupérer les notifications pour l'utilisateur connecté
$sql = "SELECT id_notification, message, is_read, created_at FROM notifications WHERE id_user = :id AND is_read = 0 ORDER BY created_at DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $user_id]);
$notifications = $stmt->fetchAll(PDO::FETCH_ASSOC);
$sql_count_unread = "SELECT COUNT(*) AS unread_count FROM notifications WHERE id_user = :id AND is_read = 0";
$stmt_count_unread = $pdo->prepare($sql_count_unread);
$stmt_count_unread->execute(['id' => $user_id]);
$unread_count = $stmt_count_unread->fetchColumn();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications</title>
    <link rel="stylesheet" href="../../public/css/style1.css">
    
    <script>
    function confirmLogout(event) {
        event.preventDefault();
        document.getElementById('logoutConfirmationDialog').style.display = 'block';
        document.getElementById('overlay').style.display = 'block';
    }

    function proceedLogout() {
        hideLogoutConfirmationDialog();
        window.location.href = "../../control/deconnexion.php";
    }

    function cancelLogout() {
        hideLogoutConfirmationDialog();
    }

    function hideLogoutConfirmationDialog() {
        document.getElementById('logoutConfirmationDialog').style.display = 'none';
        document.getElementById('overlay').style.display = 'none';
    }
    </script>
</head>
<body>
<header>
    <div class="container">
        <div class="logo">
            <img src="../../public/images/logo1.png" alt="CDI">
        </div>
        <nav class="bar">
            <ul>
                <li><a href="welcome.php">Accueil</a></li>
                <li><a href="votre_demande.php">Vous demandes</a></li>
                <li><a class="active" href="notifications.php">Notifications <?php if($unread_count > 0) echo "(" . $unread_count . ")" ?></a></li>
                <li><a href="edit.php">Compte</a></li>
                <li><a href="../../control/deconnexion.php" onclick="confirmLogout(event)">Déconnexion</a></li>
            </ul>
        </nav>
    </div>
</header>
<main>
    <div class="container">
        
        <?php if (count($notifications) > 0): ?>
            <ul class="notifications-list">
                <?php foreach ($notifications as $notification): ?>
                    <li class="notification <?= $notification['is_read'] ? 'read' : 'unread' ?>">
                        <form action="../../control/mark_as_read.php" method="POST">
                            <p><?= htmlspecialchars($notification['message']) ?></p>
                            <span class="date"><?= htmlspecialchars($notification['created_at']) ?></span>
                            <?php if (!$notification['is_read']): ?>
                                <button type="submit" name="mark_as_read" value="<?= $notification['id_notification'] ?>">Marquer comme lu</button>
                            <?php endif; ?>
                        </form>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Aucune notification trouvée.</p>
        <?php endif; ?>
    </div>
</main>
<div id="logoutConfirmationDialog" class="confirmation-dialog" style="display:none;">
    <p>Êtes-vous sûr de vouloir vous déconnecter ?</p>
    <button onclick="proceedLogout()">Oui</button>
    <button onclick="cancelLogout()">Non</button>
</div>
<div id="overlay" class="overlay" style="display:none;" onclick="hideLogoutConfirmationDialog()"></div>
</body>
</html>
