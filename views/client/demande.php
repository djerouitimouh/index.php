<?php
    // open first
    session_start();

    // secure the page
    if(!isset($_SESSION['id'])) {
        header('Location:../../index.php');
        exit(); // Ajout d'un exit() après la redirection pour stopper l'exécution du script
    }

    // connect to the data base
    include_once "../../control/db_connection.php";
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
    <title>Demande de document</title>
    <link rel="stylesheet" href="../../public/css/style1.css">
    
    <script>
    let logoutUrl = '../../control/deconnexion.php';

    function confirmLogout(event) {
        event.preventDefault();
        document.getElementById('logoutConfirmationDialog').style.display = 'block';
        document.getElementById('overlay').style.display = 'block';
    }

    function proceedLogout() {
        hideLogoutConfirmationDialog();
        window.location.href = logoutUrl;
    }

    function cancelLogout() {
        hideLogoutConfirmationDialog();
    }

    function hideLogoutConfirmationDialog() {
        document.getElementById('logoutConfirmationDialog').style.display = 'none';
        document.getElementById('overlay').style.display = 'none';
    }

    function showConfirmationDialog(event) {
        event.preventDefault();
        document.getElementById('confirmationDialog').style.display = 'block';
        document.getElementById('overlay').style.display = 'block';
    }

    function hideConfirmationDialog() {
        document.getElementById('confirmationDialog').style.display = 'none';
        document.getElementById('overlay').style.display = 'none';
    }

    function proceedSubmission() {
        hideConfirmationDialog();
        document.getElementById("demandeForm").submit();
    }

    function cancelSubmission(event) {
        event.preventDefault();
        hideConfirmationDialog();
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
                <li><a  href="welcome.php">Accueil</a></li>
                <li><a href="votre_demande.php">Vous demandes</a></li>
                <li><a  href="notifications.php">Notifications <?php if($unread_count > 0) echo "(" .$unread_count . ")" ?></a></li>
                <li><a href="edit.php">Compte</a></li>
                <li><a href="../../control/deconnexion.php" onclick="confirmLogout(event)">Déconnexion</a></li>
            </ul>
        </nav>
    </div>
</header>

<div class="instructions">
    <h2>Comment écrire votre demande :</h2>
    <p>Pour faire une demande de document, veuillez suivre les étapes suivantes :</p>
    <ul>
        <li><strong>Choisir un document :</strong> Sélectionnez le document que vous souhaitez demander dans le menu déroulant.</li>
        <li><strong>Passer votre demande :</strong> Indiquez le motif de votre demande dans la zone de texte fournie. Soyez clair et précis.</li>
        <li><strong>Envoyer la demande :</strong> Cliquez sur le bouton "Envoyer la demande" pour soumettre votre demande.</li>
    </ul>
</div>
<div class="title-border">
    <h1>Demande de document</h1>
</div>
<div class="demnd">
    <form id="demandeForm" action="../../control/demande.php" method="post">
        <div class="champ">
            <label for="document">Choisir un document:</label>
            <select id="document" name="document" required>
                <optgroup label="Service Recette">
                    <option value="Extraits des Rôles">Extraits des Rôles</option>
                    <option value="Calendrier de Paiement">Calendrier de Paiement</option>
                </optgroup>
                <optgroup label="Service Principal de Gestion">
                    <option value="C20">C20</option>
                    <option value="Franchise TVA: (F20,F21,F22)">Franchise TVA: (F20,F21,F22)</option>
                    <option value="Attestation du NIF">Attestation du NIF</option>
                    <option value="PV d'Entrée ou d'Exploitation">PV d'Entrée ou d'Exploitation</option>
                    <option value="Etat d'Environnement">Etat d'Environnement</option>
                </optgroup>
                <optgroup label="Service de Contrôle et de la Recherche">
                    <option value="PV Constat">PV Constat</option>
                </optgroup>
            </select>
        </div>
        <div class="champ">
            <label for="motif">Passer votre Demande:</label>
            <textarea id="motif" name="motif" rows="5" required></textarea>
        </div>
        <div class="note">
            <p>Note : Assurez-vous que toutes les informations fournies sont correctes et complètes pour éviter des retards dans le traitement de votre demande.</p>
        </div>
        <div class="envoye">
            <button onclick="showConfirmationDialog(event)">Envoyer la demande</button>
        </div>
        <div id="confirmationDialog" class="confirmation-dialog">
            <p>Êtes-vous sûr de vouloir envoyer cette demande ?</p>
            <div class="dialog-buttons">
                <button type="submit" name="submit" onclick="proceedSubmission()">Oui</button>
                <button onclick="cancelSubmission(event)">Non</button>
            </div>
        </div>
        <div id="overlay" class="overlay"></div>
    </form>
</div>
<div id="logoutConfirmationDialog" class="confirmation-dialog">
    <p>Êtes-vous sûr de vouloir vous déconnecter ?</p>
    <div class="dialog-buttons">
        <button onclick="proceedLogout()">Oui</button>
        <button onclick="cancelLogout()">Non</button>
    </div>
</div>
<div id="overlay" class="overlay"></div>
</body>
</html>
