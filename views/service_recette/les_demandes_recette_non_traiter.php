<?php  
session_start();
require_once "../../control/db_connection.php";
if(!isset($_SESSION['id'])) {
    header('Location:../../index.php');
    exit(); // Ajout d'un exit() après la redirection pour stopper l'exécution du script
}
$search = isset($_POST['search']) ? $_POST['search'] : '';

// Préparation de la requête SQL pour récupérer les demandes avec les noms des personnes et les noms des services filtrées par nom_service = 'Service Recette'
$sql = "SELECT demande.*, personne.nom AS nom_personne, personne.prenom AS prenom_personne
        FROM demande 
        INNER JOIN personne ON demande.id_personne = personne.id
        INNER JOIN reponses ON demande.id_demande = reponses.id_demande
        WHERE demande.nom_service = 'Service Recette' 
        AND reponses.reponse = 'Accepter'
        AND reponses.traiter = 'non'";
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
    <title>Service Recette</title>
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
        
        document.addEventListener('DOMContentLoaded', function() {
            var pretButtons = document.querySelectorAll(".pret-btn");
            var confirmationWindow = document.getElementById("confirmationWindow");
            pretButtons.forEach(function(button) {
                button.addEventListener("click", function() {
                    var idDemande = button.getAttribute("data-id-demande");
                    confirmationWindow.setAttribute("data-id-demande", idDemande);
                    showConfirmationWindow();
                });
            });

            var closeButton = document.querySelector(".close");
            closeButton.addEventListener("click", function() {
                hideConfirmationWindow();
            });

            var confirmationForm = document.getElementById("confirmationForm");
            confirmationForm.addEventListener("submit", function(event) {
                event.preventDefault();

                var dateRecuperation = document.getElementById("dateRecuperation").value;
                var timeSlot = document.getElementById("timeSlot").value;
                var idDemande = confirmationWindow.getAttribute("data-id-demande");

                var xhr = new XMLHttpRequest();
                xhr.open("POST", "../../control/update_traitement.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        console.log("Traitement mis à jour pour la demande avec l'ID : " + idDemande);
                        hideConfirmationWindow();
                        location.reload();
                    }
                };
                xhr.send("id_demande=" + idDemande + "&date_recuperation=" + dateRecuperation + "&time_slot=" + timeSlot);
            });

            function showConfirmationWindow() {
                confirmationWindow.style.display = "block";
            }

            function hideConfirmationWindow() {
                confirmationWindow.style.display = "none";
            }

            document.getElementById('dateRecuperation').addEventListener('change', function() {
                var timeSlotSelect = document.getElementById('timeSlot');
                timeSlotSelect.innerHTML = '';
                var date = this.value;

                var xhr = new XMLHttpRequest();
                xhr.open("POST", "get_time_slot_counts.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        var timeSlots = JSON.parse(xhr.responseText);
                        var startTime = 8;
                        var endTime = 16;
                        for (var hour = startTime; hour < endTime; hour++) {
                            for (var minutes = 0; minutes < 60; minutes += 30) {
                                var time = ('0' + hour).slice(-2) + ':' + ('0' + minutes).slice(-2);
                                var count = timeSlots.find(slot => slot.time_slot === time)?.count || 0;
                                var option = document.createElement('option');
                                option.value = time;
                                option.textContent = time + " (" + count + " fois)";
                                timeSlotSelect.appendChild(option);
                            }
                        }
                    }
                };
                xhr.send("date=" + date);
            });
        });
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
                <li><a   href="service_recette.php">Accueil</a></li>
               
                <li><a href="../../control/deconnexion.php" onclick="confirmLogout(event)">Déconnexion</a></li>
            </ul>
        </nav>

        

    </div>
   </header>
   <div class="search-bar">
    <div class="container">
        <form method="POST" action="les_demandes_recette_non_traiter.php">
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
                        <p>". $demande['nom_personne'] ." " . $demande['prenom_personne'] . "</p>
                        <h3>Nom du document</h3>
                        <p>". $demande['nom_document'] ."</p>
                        <a class='detail-btn' href='../detail.php?id_demande=". $demande['id_demande'] ."&nom_personne=". $demande['nom_personne'] ."&prenom_personne=". $demande['prenom_personne']."&nom_document=". $demande['nom_document'] ."&nom_service=". $demande['nom_service'] ."&demande_text=". $demande['demande_text'] ."&date_heure=". $demande['date_heure'] ."'>Détails</a>
                        <button type='button' class='pret-btn' data-id-demande='". $demande['id_demande'] ."'>Prêt</button>
                    </div>
                    ";
                }
            }
            ?>
        </div>
    </div>

    <!-- HTML pour la fenêtre de confirmation -->
    <div id="confirmationWindow" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Date de récupération :</h2>
        <form id="confirmationForm">
            <label for="dateRecuperation">Date de récupération :</label>
            <input type="date" id="dateRecuperation" name="dateRecuperation" required>
            <label for="timeSlot">Créneau horaire :</label>
            <select id="timeSlot" name="timeSlot" required></select>
            <button type="submit" id="envoyerBtn">Envoyer</button>
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
<div id="overlay" class="overlay"></div>
</body>
</html>

