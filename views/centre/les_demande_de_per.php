<?php
session_start();
require_once "../../control/db_connection.php";
if(!isset($_SESSION['id'])) {
    header('Location:../../index.php');
    exit(); // Ajout d'un exit() après la redirection pour stopper l'exécution du script
}
// Vérifiez si l'ID de la personne est présent dans l'URL
if(isset($_GET['id_personne'])) {
    // Récupérez l'ID de la personne depuis l'URL
    $id_personne = $_GET['id_personne'];

    // Effectuez une requête SQL pour récupérer toutes les demandes de cette personne 
    $sql_demandes = "SELECT demande.*, personne.nom AS nom_personne, personne.prenom AS prenom_personne, reponses.reponse, reponses.traiter, reponses.recuperez,
    CASE WHEN signale.id_demande IS NOT NULL THEN 1 ELSE 0 END AS is_signale
    FROM demande 
    INNER JOIN personne ON demande.id_personne = personne.id
    LEFT JOIN reponses ON demande.id_demande = reponses.id_demande
    LEFT JOIN signale ON demande.id_demande = signale.id_demande
    WHERE demande.id_personne = :id_personne";

    $stmt_demandes = $pdo->prepare($sql_demandes);
    $stmt_demandes->execute(['id_personne' => $id_personne]);
    $demandes = $stmt_demandes->fetchAll();
    
    // Affichez les demandes récupérées
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Center</title>
    <link rel="stylesheet" href="../../public/css/style1.css">
    
        
    </style>
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
            <li><a href="centre.php">Accueil</a></li>
                <li><a href="les_demandes_sig.php">Signalées</a></li>
                <li><a href="utilisateur.php">Les Utilisateurs</a></li>
                <li><a href="../../control/deconnexion.php" onclick="confirmLogout(event)">Déconnexion</a></li>
            </ul>
        </nav>
    </div>
</header>
<div class="demandes">
    <div class="container">
        <?php
        if (empty($demandes)) {
            echo "
            <div class='demande-card'>
                <h3>Il n'y a pas de demande</h3>
            </div>
            ";
        } else {
            foreach ($demandes as $demande) {
                $message = '';
                $class = '';

                if ($demande['is_signale']) {
                    $message = 'Demande signalée';
                    $class = 'demande-signale';
                } elseif ($demande['reponse'] == 'Accepter' && $demande['traiter'] == 'non') {
                    $message = 'Demande acceptée en cours de traitement';
                    $class = 'demande-accept';
                } elseif ($demande['reponse'] == 'Refuser') {
                    $message = 'Demande refusée';
                    $class = 'demande-refuse';
                } elseif ($demande['reponse'] == 'Accepter' && $demande['traiter'] == 'oui' && $demande['recuperez'] == 'non') {
                    $message = 'Demande prête mais pas récupérée';
                    $class = 'demande-accept';
                } elseif ($demande['recuperez'] == 'oui') {
                    $message = 'Demande récupérée';
                    $class = 'demande-accept';
                } else {
                    $message = 'Demande en attente';
                    $class = 'demande-refuse';
                }

                echo "
                <div class='demande-card $class'>
                    <p class='message'>$message</p>
                    <h3>Nom de la personne</h3>
                    <p>{$demande['nom_personne']} {$demande['prenom_personne']}</p>
                    <h3>Nom du document</h3>
                    <p>{$demande['nom_document']}</p>
                    <a class='detail-btn' href='../detail.php?id_demande={$demande['id_demande']}&nom_personne={$demande['nom_personne']}&prenom_personne={$demande['prenom_personne']}&nom_document={$demande['nom_document']}&nom_service={$demande['nom_service']}&demande_text={$demande['demande_text']}&date_heure={$demande['date_heure']}'>Détails</a>
                </div>
                ";
            }
        }
        ?>
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
