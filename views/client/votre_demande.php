<?php
session_start();

if (!isset($_SESSION['id'])) {
    header('Location: ../../index.php');
    exit();
}

require_once "../../control/db_connection.php";

$id = $_SESSION['id'];

$sql = "SELECT demande.*, reponses.reponse, reponses.traiter,reponses.recuperez, personne.nom, personne.prenom ,reponses.cause_de_refus,reponses.date_de_recuperation,
CASE WHEN signale.id_demande IS NOT NULL THEN 1 ELSE 0 END AS is_signale

    FROM demande 
    LEFT JOIN reponses ON demande.id_demande = reponses.id_demande
    LEFT JOIN personne ON demande.id_personne = personne.id
    LEFT JOIN signale ON demande.id_demande = signale.id_demande
    WHERE demande.id_personne = :id";

$stmt = $pdo->prepare($sql);
$stmt->execute(['id' => $id]);
$demandes = $stmt->fetchAll();
$user_id = $_SESSION['id'];

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
    <title>Vos demandes</title>
    <link rel="stylesheet" href="../../public/css/style1.css">
    <script>
    let deleteUrl = '';
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

    function showDeleteConfirmationDialog(event, url) {
        event.preventDefault();
        deleteUrl = url;
        document.getElementById('deleteConfirmationDialog').style.display = 'block';
        document.getElementById('overlay').style.display = 'block';
    }

    function proceedDeletion() {
        hideDeleteConfirmationDialog();
        window.location.href = deleteUrl;
    }

    function cancelDeletion() {
        hideDeleteConfirmationDialog();
    }

    function hideDeleteConfirmationDialog() {
        document.getElementById('deleteConfirmationDialog').style.display = 'none';
        document.getElementById('overlay').style.display = 'none';
    }
    </script>
  
</head>

<header>
    <div class="container">
        <div class="logo">
            <img src="../../public/images/logo1.png" alt="CDI">
        </div>
        <nav class="bar">
            <ul>
                <li><a  href="welcome.php">Accueil</a></li>
                <li><a class="active"  href="votre_demande.php">Vous demandes</a></li>
                <li><a href="notifications.php">Notifications <?php if($unread_count > 0) echo "(" . $unread_count . ")" ?></a></li>
                <li><a href="edit.php">Compte</a></li>
                <li><a href="../../control/deconnexion.php" onclick="confirmLogout(event)">Déconnexion</a></li>
            </ul>
        </nav>

        

    </div>
   </header>
<div class="vtr_demnd">
    <div class="container">
        <?php
        if (empty($demandes)) {
            echo "
            <div class='card'>
                <h3>Il n'y a pas de demande</h3>
            </div>
            ";
        } else {
            foreach ($demandes as $demande) {
                echo "<div class='card'>";
                echo "<h3>Nom du document</h3>";
                echo "<p>" . $demande['nom_document'] . "</p>";
                echo "<h3>Nom du Service</h3>";
                echo "<p>" . $demande['nom_service'] . "</p>";
            
                if (isset($demande['traiter']) && $demande['traiter'] == 'oui'&& $demande['recuperez'] == 'non' && $demande['reponse'] == 'Accepter') {
                    echo "<p class='message ready'>Votre document est prêt. Veuillez venir le récupérer le " . $demande['date_de_recuperation'] . ".</p>";
                } elseif (isset($demande['traiter']) && $demande['traiter'] == 'non' && $demande['reponse'] == 'Accepter') {
                    echo "<p class='message not-ready'>Votre document n'est pas prêt pour l'instant.</p>";
                } elseif ($demande['reponse'] == 'Refuser') {
                    echo "<p class='message not-ready'>Votre demande a été refusée pour la raison suivante : " . $demande['cause_de_refus'] . "</p>";
                }
            if($demande['is_signale']){
                echo "<p class='reponse refuse'>Demande signalée</p>";
            }else if (isset($demande['traiter'])  && $demande['recuperez'] == 'non' && $demande['reponse'] == 'Accepter') {
                    echo "<p class='reponse accepte'>Accepter</p>";
                } elseif ($demande['reponse'] == 'Refuser') {
                    echo "<p class='reponse refuse'>Refuser</p>";
                } elseif ($demande['recuperez'] == 'oui') {
                    echo "<p class='reponse accepte'>Récupérée</p>";
                } else {
                    echo "<p class='reponse refuse'>En attente</p>";
                }                echo "<div class='control'>";
            
                echo "<a href='../detail.php?id_demande=" . $demande['id_demande'] . "'>voir</a>";
                if ($demande['reponse'] != 'Accepter' && $demande['reponse'] != 'Refuser' && !$demande['is_signale'])  {
                    echo "<a href='modifier_demande.php?id_demande=" . $demande['id_demande'] . "'>Modifier</a>";
                    echo "<a href='#' onclick='showDeleteConfirmationDialog(event, \"../../control/supprimer_demande.php?id_demande=" . $demande['id_demande'] . "\")'>Effacer</a>";
                }
            
                echo "</div>";
                echo "</div>";
            }
        }
        ?>
    </div>
</div>

<div id="deleteConfirmationDialog" class="confirmation-dialog">
    <p>Êtes-vous sûr de vouloir effacer cette demande ?</p>
    <div class="dialog-buttons">
        <button onclick="proceedDeletion()">Oui</button>
        <button onclick="cancelDeletion()">Non</button>
    </div>
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
