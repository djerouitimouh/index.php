<?php
session_start();
require_once "../../control/db_connection.php";

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id'])) {
    header('Location: ../../index.php');
    exit;
}

// Vérifier si l'identifiant de la demande est passé dans l'URL
if (!isset($_GET['id_demande'])) {
    header('Location: erreur.php');
    exit;
}

// Récupérer l'identifiant de la demande à modifier
$id_demande = $_GET['id_demande'];

// Récupérer les informations de la demande depuis la base de données
$sql = "SELECT * FROM demande WHERE id_demande = :id_demande AND id_personne = :id_personne";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id_demande' => $id_demande, 'id_personne' => $_SESSION['id']]);
$demande = $stmt->fetch();

// Vérifier si la demande existe et appartient à l'utilisateur
if (!$demande) {
    header('Location: erreur.php');
    exit;
}

// Traitement du formulaire de modification
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer le nouveau texte de la demande depuis le formulaire
    $demande_text = $_POST['demande_text'];

    // Mettre à jour la demande dans la base de données
    $sql_update = "UPDATE demande SET demande_text = :demande_text WHERE id_demande = :id_demande";
    $stmt_update = $pdo->prepare($sql_update);
    $stmt_update->execute(['demande_text' => $demande_text, 'id_demande' => $id_demande]);

    // Rediriger vers la page de demande après la modification
    header("Location: ../../views/votre_demande.php");
    exit;
}
$user_id = $_SESSION['id'];

$sql_count_unread = "SELECT COUNT(*) AS unread_count FROM notifications WHERE id_user = :id AND is_read = 0";
$stmt_count_unread = $pdo->prepare($sql_count_unread);
$stmt_count_unread->execute(['id' => $user_id]);
$unread_count = $stmt_count_unread->fetchColumn();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier la demande</title>
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

    function showModificationConfirmation(event) {
        event.preventDefault();
        document.getElementById('modificationConfirmationDialog').style.display = 'block';
        document.getElementById('overlay').style.display = 'block';
    }

    function proceedModification() {
        hideModificationConfirmationDialog();
        document.getElementById("modificationForm").submit();
    }

    function cancelModification(event) {
        event.preventDefault();
        hideModificationConfirmationDialog();
    }

    function hideModificationConfirmationDialog() {
        document.getElementById('modificationConfirmationDialog').style.display = 'none';
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
                <li><a  href="notifications.php">Notifications <?php if($unread_count > 0) echo "(" .$unread_count . ")" ?></a></li>
                <li><a href="edit.php">Compte</a></li>
                <li><a href="../../control/deconnexion.php" onclick="confirmLogout(event)">Déconnexion</a></li>
            </ul>
        </nav>
    </div>
</header>

<div class="instructions">
    <h2>Comment modifier votre demande :</h2>
    <p>Pour modifier votre demande de document, veuillez suivre les étapes suivantes :</p>
    <ul>
        <li><strong>Vérifiez les informations :</strong> Assurez-vous que les informations affichées sont correctes.</li>
        <li><strong>Modifiez le texte :</strong> Changez le texte de votre demande dans le champ prévu à cet effet.</li>
        <li><strong>Enregistrez les modifications :</strong> Cliquez sur le bouton "Enregistrer les modifications" pour soumettre vos changements.</li>
    </ul>
</div>
<div class="title-border">
    <h1>Modifier la demande</h1>
</div>
<div class="modifier-demande">
    <div class="container">
        <form id="modificationForm" action="../../control/modifier_demande.php?id_demande=<?php echo $demande['id_demande']; ?>" method="post">
            <div class="form-group">
                <label for="nom_document">Nom du document</label>
                <input type="text" id="nom_document" name="nom_document" value="<?php echo htmlspecialchars($demande['nom_document']); ?>" readonly>
            </div>
            <div class="form-group">
                <label for="nom_service">Nom du Service</label>
                <input type="text" id="nom_service" name="nom_service" value="<?php echo htmlspecialchars($demande['nom_service']); ?>" readonly>
            </div>
            <div class="form-group">
                <label for="demande_text">Demande</label>
                <textarea id="demande_text" name="demande_text" rows="4" required><?php echo htmlspecialchars($demande['demande_text']); ?></textarea>
            </div>
            <div class="form-group">
                <label for="date_heure">Date et Heure</label>
                <input type="text" id="date_heure" name="date_heure" value="<?php echo htmlspecialchars($demande['date_heure']); ?>" readonly>
            </div>
            <div class="note">
                <p>Note : Assurez-vous que toutes les informations fournies sont correctes et complètes avant d'enregistrer les modifications.</p>
            </div>
            <div class="envoye">
                <button type="submit" onclick="showModificationConfirmation(event)">Enregistrer les modifications</button>
            </div>
        </form>
    </div>
</div>

<div id="logoutConfirmationDialog" class="confirmation-dialog">
    <p>Êtes-vous sûr de vouloir vous déconnecter ?</p>
    <div class="dialog-buttons">
        <button onclick="proceedLogout()">Oui</button>
        <button onclick="cancelLogout()">Non</button>
    </div>
</div>
<div id="modificationConfirmationDialog" class="confirmation-dialog">
    <p>Êtes-vous sûr de vouloir enregistrer ces modifications ?</p>
    <div class="dialog-buttons">
        <button onclick="proceedModification()">Oui</button>
        <button onclick="cancelModification(event)">Non</button>
    </div>
</div>
<div id="overlay" class="overlay"></div>
</body>
</html>
