<?php  
session_start();
require_once "../../control/db_connection.php";
if(!isset($_SESSION['id'])) {
    header('Location:../../index.php');
    exit(); // Ajout d'un exit() après la redirection pour stopper l'exécution du script
}
$search = isset($_POST['search']) ? $_POST['search'] : '';

// Préparation de la requête SQL pour récupérer les demandes avec les noms des personnes et les noms des services filtrées par nom_service = 'Service Recette'
$sql = "SELECT demande.*, personne.nom AS nom_personne , personne.prenom AS prenom_personne
        FROM demande 
        INNER JOIN personne ON demande.id_personne = personne.id
        INNER JOIN reponses ON demande.id_demande = reponses.id_demande
        WHERE demande.nom_service = 'Service de Contrôle et de la Recherche' 
        AND reponses.reponse = 'Accepter'
        AND reponses.traiter = 'oui'
        AND reponses.recuperez = 'non'";
if ($search) {
    // Si la recherche contient un espace, nous supposons qu'il s'agit du nom et du prénom de la personne
    if (strpos($search, ' ') !== false) {
        $searchParams = explode(' ', $search);
        $sql .= " AND personne.nom LIKE :nom AND personne.prenom LIKE :prenom";
    } else {
        $sql .= " AND demande.nom_document LIKE :search";
    }
}

$stmt = $pdo->prepare($sql);

if ($search) {
    // Si la recherche contient un espace, nous lierons les paramètres pour nom et prénom
    if (isset($searchParams)) {
        $stmt->bindValue(':nom', '%' . $searchParams[0] . '%', PDO::PARAM_STR);
        $stmt->bindValue(':prenom', '%' . $searchParams[1] . '%', PDO::PARAM_STR);
    } else {
        $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
    }
}

$stmt->execute();
$demandes = $stmt->fetchAll(); 
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service de Contrôle et de la Recherche</title>
    <link rel="stylesheet" href="../../public/css/style1.css">
    <!-- JavaScript pour gérer la suppression dynamique des demandes -->
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        // Sélectionnez tous les boutons "Recuperer"
        var pretButtons = document.querySelectorAll(".recuperer-btn");

        // Sélectionnez la fenêtre de confirmation
        var confirmationDialog = document.getElementById("confirmationDialog");
        var overlay = document.getElementById("overlay");
        var confirmBtn = document.getElementById("confirmBtn");
        var cancelBtn = document.getElementById("cancelBtn");

        var idDemandeToProcess;

        // Fonction pour afficher la fenêtre de confirmation
        function showConfirmationDialog(event) {
            event.preventDefault();
            idDemandeToProcess = event.target.getAttribute('data-id-demande');
            confirmationDialog.style.display = "block";
            overlay.style.display = "block";
        }

        // Fonction pour masquer la fenêtre de confirmation
        function hideConfirmationDialog() {
            confirmationDialog.style.display = "none";
            overlay.style.display = "none";
        }

        // Attachez un gestionnaire d'événements click à chaque bouton "Recuperer"
        pretButtons.forEach(function(button) {
            button.addEventListener("click", showConfirmationDialog);
        });

        // Attachez un gestionnaire d'événements click au bouton de confirmation
        confirmBtn.addEventListener("click", function() {
            updateTraitement(idDemandeToProcess);
            hideConfirmationDialog();
        });

        // Attachez un gestionnaire d'événements click au bouton d'annulation
        cancelBtn.addEventListener("click", function() {
            hideConfirmationDialog();
        });

        // Fonction pour mettre à jour le traitement dans la base de données
        function updateTraitement(idDemande) {
            // Effectuer une requête AJAX pour mettre à jour le champ `traiter` à "oui"
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "../../control/update_recuperation.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Mettre à jour l'affichage ou effectuer d'autres actions si nécessaire
                    console.log("Traitement mis à jour pour la demande avec l'ID : " + idDemande);
                    // Actualiser la page pour refléter les changements
                    location.reload();
                }
            };
            xhr.send("id_demande=" + idDemande);
        }
    });

    function confirmLogout(event) {
        event.preventDefault();
        document.getElementById('logoutConfirmationDialog').style.display = 'block';
        document.getElementById('overlay').style.display = 'block';
    }

    function proceedLogout() {
        hideLogoutConfirmationDialog();
        window.location.href = '../../control/deconnexion.php';
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
                <li><a   href="service_de_Contrôle_et_de_la_Recherche.php">Accueil</a></li>
               
                <li><a href="../../control/deconnexion.php" onclick="confirmLogout(event)">Déconnexion</a></li>
            </ul>
        </nav>
    </div>
   </header>
   <div class="search-bar">
    <div class="container">
        <form method="post" action="les_demandes_control_pret.php">
            <input type="text" name="search" placeholder="Rechercher par nom, prénom ou nom de document" value="<?php echo htmlspecialchars($search); ?>">
            <button type="submit">Rechercher</button>
        </form>
    </div>
</div>
    
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
                    echo "
                    <div class='demande-card'>
                        <h3>Nom du personne</h3>
                        <p>". $demande['nom_personne'] ." " . $demande['prenom_personne'] ."</p>
                        <h3>Nom du document</h3>
                        <p>". $demande['nom_document'] ."</p>
                        <a class='detail-btn' href='../detail.php?id_demande=". $demande['id_demande'] ."&nom_personne=". $demande['nom_personne'] ."&nom_document=". $demande['nom_document'] ."&nom_service=". $demande['nom_service'] ."&demande_text=". $demande['demande_text'] ."&date_heure=". $demande['date_heure'] ."'>Détails</a>
                        <button data-id-demande='". $demande['id_demande'] ."' class='recuperer-btn'>Recuperer</button>
                    </div>
                    ";
                }
            }
            ?>
        </div>
    </div>
    <div id="confirmationDialog" class="confirmation-dialog">
    <p>Êtes-vous sûr de vouloir marquer cette demande comme récupérée ?</p>
    <div class="dialog-buttons">
        <button id="confirmBtn">Oui</button>
        <button id="cancelBtn">Non</button>
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