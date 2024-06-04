<?php  
session_start();
require_once "../../control/db_connection.php";
if(!isset($_SESSION['id'])) {
    header('Location:../../index.php');
    exit(); // Ajout d'un exit() après la redirection pour stopper l'exécution du script
}

// Préparation de la requête SQL pour récupérer le nombre de demandes avec les noms des personnes et les noms des services filtrées par nom_service = 'Service Recette'
$sql_nonac_recette = "SELECT COUNT(*) AS nombre_demandes
        FROM demande 
        WHERE nom_service = 'Service Recette' 
        AND id_demande NOT IN (SELECT id_demande FROM reponses)
        AND demande.id_demande NOT IN (SELECT id_demande FROM signale)";

$stmt_nonac_recette = $pdo->prepare($sql_nonac_recette);
$stmt_nonac_recette->execute();
$nombre_demandes_nonac_recette = $stmt_nonac_recette->fetchColumn(); 



$sql_nontr_recette = "SELECT COUNT(*) AS nombre_demandes_reponse
                FROM reponses 
                INNER JOIN demande ON reponses.id_demande = demande.id_demande
                WHERE reponses.reponse = 'Accepter' 
                AND reponses.traiter = 'non' 
                AND demande.nom_service = 'Service Recette'";

$stmt_nontr_recette = $pdo->prepare($sql_nontr_recette);
$stmt_nontr_recette->execute();
$nombre_demandes_nontr_recette = $stmt_nontr_recette->fetchColumn(); 

$sql_nonrc_recette = "SELECT COUNT(*) AS nombre_demandes_reponse
                FROM reponses 
                INNER JOIN demande ON reponses.id_demande = demande.id_demande
                WHERE reponses.reponse = 'Accepter'
             AND reponses.traiter = 'oui'
             AND reponses.recuperez = 'non' 
                AND demande.nom_service = 'Service Recette'";

$stmt_nonrc_recette = $pdo->prepare($sql_nonrc_recette);
$stmt_nonrc_recette->execute();
$nombre_demandes_nonrc_recette = $stmt_nonrc_recette->fetchColumn();

$sql_rc_recette = "SELECT COUNT(*) AS nombre_demandes_reponse
                FROM reponses 
                INNER JOIN demande ON reponses.id_demande = demande.id_demande
                WHERE reponses.reponse = 'Accepter'
             AND reponses.traiter = 'oui'
             AND reponses.recuperez = 'oui' 
                AND demande.nom_service = 'Service Recette'";

$stmt_rc_recette = $pdo->prepare($sql_rc_recette);
$stmt_rc_recette->execute();
$nombre_demandes_rc_recette = $stmt_rc_recette->fetchColumn();

$sql_rf_recette = "SELECT COUNT(*) AS nombre_demandes_reponse
                FROM reponses 
                INNER JOIN demande ON reponses.id_demande = demande.id_demande
                WHERE reponses.reponse = 'Refuser' 
                AND demande.nom_service = 'Service Recette'";

$stmt_rf_recette = $pdo->prepare($sql_rf_recette);
$stmt_rf_recette->execute();
$nombre_demandes_rf_recette = $stmt_rf_recette->fetchColumn();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Servise recette</title>
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
                <li><a class="active"  href="service_recette.php">Accueil</a></li>
               
                <li><a href="../../control/deconnexion.php" onclick="confirmLogout(event)">Déconnexion</a></li>
            </ul>
        </nav>

        

    </div>
   </header>
   <div class="service">
    <div class="service-header">
        <h2>Service Recette</h2>
    </div>

    <div class="service-content">
        <!-- Première ligne de demandes -->
        <div class="ligne-demandes">
            <div class="demande-border">
                <h3> Demandes en attente d'acceptation </h3>
                <p>Le nombre de demande : <span class="nombre-demandes"><?php echo $nombre_demandes_nonac_recette; ?></span> </p>
                <a href="les_demandes_recette.php">Voir les détails</a>
            </div>
            <div class="demande-border-attente">
                <h3>Demandes acceptées en attente de traitement </h3>
                <p>Le nombre de demande : <span class="nombre-demandes"><?php echo $nombre_demandes_nontr_recette; ?></span> </p>
                <a href="les_demandes_recette_non_traiter.php">Voir les détails</a>
            </div>
        </div>
        <!-- Deuxième ligne de demandes -->
        <div class="ligne-demandes">
            <div class="demande-border-refuser">
                <h3>Demandes refusées ou récupérées </h3>
                <p>Le nombre de demande refusées : <span class="nombre-demandes"><?php echo $nombre_demandes_rf_recette; ?></span> </p>
                <p>Le nombre de demande récupérées : <span class="nombre-demandes"><?php echo $nombre_demandes_rc_recette; ?></span> </p>

                <a href="les_demandes_recette_refuser.php">Voir les détails</a>
            </div>
            <div class="demande-border-pret">
                <h3>Demandes prêtes </h3>
                <p>Le nombre de demande : <span class="nombre-demandes"><?php echo $nombre_demandes_nonrc_recette; ?></span> </p>
                <a href="les_demandes_recette_pret.php">Voir les détails</a>
            </div>
        </div>
    </div>
</div>


<!--<div class="button-container">
   <a href="les_demandes_recette.php?etat=non_acceptees" class="custom-button">Demandes non acceptées</a>
    <a href="les_demandes_recette_non_traiter.php?etat=acceptees_non_traitees" class="custom-button">Demandes acceptées non traitées</a>
</div> -->
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
