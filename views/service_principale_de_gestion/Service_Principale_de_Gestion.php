<?php  
session_start();
require_once "../../control/db_connection.php";
if(!isset($_SESSION['id'])) {
    header('Location:../../index.php');
    exit(); // Ajout d'un exit() après la redirection pour stopper l'exécution du script
}
$sql_nonac_gestion = "SELECT COUNT(*) AS nombre_demandes
        FROM demande 
        WHERE nom_service = 'Service Principal de Gestion' 
        AND id_demande NOT IN (SELECT id_demande FROM reponses)
        AND demande.id_demande NOT IN (SELECT id_demande FROM signale)";

$stmt_nonac_gestion = $pdo->prepare($sql_nonac_gestion);
$stmt_nonac_gestion->execute();
$nombre_demandes_nonac_gestion = $stmt_nonac_gestion->fetchColumn(); 



$sql_nontr_gestion = "SELECT COUNT(*) AS nombre_demandes_reponse
                FROM reponses 
                INNER JOIN demande ON reponses.id_demande = demande.id_demande
                WHERE reponses.reponse = 'Accepter' 
                AND reponses.traiter = 'non' 
                AND demande.nom_service = 'Service Principal de Gestion'";

$stmt_nontr_gestion = $pdo->prepare($sql_nontr_gestion);
$stmt_nontr_gestion->execute();
$nombre_demandes_nontr_gestion = $stmt_nontr_gestion->fetchColumn();

$sql_nonrc_gestion = "SELECT COUNT(*) AS nombre_demandes_reponse
                FROM reponses 
                INNER JOIN demande ON reponses.id_demande = demande.id_demande
                WHERE reponses.reponse = 'Accepter'
             AND reponses.traiter = 'oui'
             AND reponses.recuperez = 'non' 
                AND demande.nom_service = 'Service Principal de Gestion'";

$stmt_nonrc_gestion = $pdo->prepare($sql_nonrc_gestion);
$stmt_nonrc_gestion->execute();
$nombre_demandes_nonrc_gestion = $stmt_nonrc_gestion->fetchColumn();

$sql_rc_gestion = "SELECT COUNT(*) AS nombre_demandes_reponse
                FROM reponses 
                INNER JOIN demande ON reponses.id_demande = demande.id_demande
                WHERE reponses.reponse = 'Accepter'
             AND reponses.traiter = 'oui'
             AND reponses.recuperez = 'oui' 
                AND demande.nom_service = 'Service Principal de Gestion'";

$stmt_rc_gestion = $pdo->prepare($sql_rc_gestion);
$stmt_rc_gestion->execute();
$nombre_demandes_rc_gestion = $stmt_rc_gestion->fetchColumn();

$sql_rf_gestion = "SELECT COUNT(*) AS nombre_demandes_reponse
                FROM reponses 
                INNER JOIN demande ON reponses.id_demande = demande.id_demande
                WHERE reponses.reponse = 'Refuser' 
                AND demande.nom_service = 'Service Principal de Gestion'";

$stmt_rf_gestion = $pdo->prepare($sql_rf_gestion);
$stmt_rf_gestion->execute();
$nombre_demandes_rf_gestion = $stmt_rf_gestion->fetchColumn();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servise principale de gestion</title>
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
                <li><a   href="Service_Principale_de_Gestion.php">Accueil</a></li>
               
                <li><a href="../../control/deconnexion.php" onclick="confirmLogout(event)">Déconnexion</a></li>
            </ul>
        </nav>

        

    </div>
   </header>
   <div class="service">
    <div class="service-header">
        <h2>Service Principal de Gestion</h2>
    </div>

    <div class="service-content">
        <!-- Première ligne de demandes -->
        <div class="ligne-demandes">
            <div class="demande-border">
                <h3> Demandes en attente d'acceptation </h3>
                <p>Le nombre de demande : <span class="nombre-demandes"><?php echo $nombre_demandes_nonac_gestion; ?></span> </p>
                <a href="les_demandes_gestion.php">Voir les détails</a>
            </div>
            <div class="demande-border-attente">
                <h3>Demandes acceptées en attente de traitement </h3>
                <p>Le nombre de demande : <span class="nombre-demandes"><?php echo $nombre_demandes_nontr_gestion; ?></span> </p>
                <a href="les_demandes_gestion_non_traiter.php">Voir les détails</a>
            </div>
        </div>
        <!-- Deuxième ligne de demandes -->
        <div class="ligne-demandes">
            <div class="demande-border-refuser">
                <h3>Demandes refusées ou récupérées </h3>
                <p>Le nombre de demande refusées : <span class="nombre-demandes"><?php echo $nombre_demandes_rf_gestion; ?></span> </p>
                <p>Le nombre de demande récupérées : <span class="nombre-demandes"><?php echo $nombre_demandes_rc_gestion; ?></span> </p>

                <a href="les_demandes_gestion_refuser.php">Voir les détails</a>
            </div>
            <div class="demande-border-pret">
                <h3>Demandes prêtes </h3>
                <p>Le nombre de demande : <span class="nombre-demandes"><?php echo $nombre_demandes_nonrc_gestion; ?></span> </p>
                <a href="les_demandes_gestion_pret.php">Voir les détails</a>
            </div>
        </div>
    </div>
</div>

<!--<div class="button-container">
    <a href="les_demandes_gestion.php?etat=non_acceptees" class="custom-button">Demandes non acceptées</a>
    <a href="les_demandes_gestion_non_traiter.php?etat=acceptees_non_traitees" class="custom-button">Demandes acceptées non traitées</a>
</div>-->
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
