<?php  
session_start();
require_once "../../control/db_connection.php";
if(!isset($_SESSION['id'])) {
    header('Location:../../index.php');
    exit(); // Ajout d'un exit() après la redirection pour stopper l'exécution du script
}
$search = isset($_GET['search']) ? $_GET['search'] : '';


// Préparation de la requête SQL pour récupérer les demandes avec les noms des personnes et les noms des services filtrées par nom_service = 'Service Recette'
$sql = "SELECT demande.*, personne.nom AS nom_personne , personne.prenom AS prenom_personne
        FROM demande 
        INNER JOIN personne ON demande.id_personne = personne.id
        WHERE demande.nom_service = 'Service de Contrôle et de la Recherche' 
        AND demande.id_demande NOT IN (SELECT id_demande FROM reponses)
        AND demande.id_demande NOT IN (SELECT id_demande FROM signale)";
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
            var forms = document.querySelectorAll("form[action*='../../control/reponse.php']");
            var modalAccept = document.getElementById("confirmationWindowAccept");
            var modalRefuse = document.getElementById("confirmationWindowRefuse");
            var closeButtonAccept = document.querySelector(".close.accept");
            var closeButtonRefuse = document.querySelector(".close.refuse");
            var confirmationFormAccept = document.getElementById("confirmationFormAccept");
            var confirmationFormRefuse = document.getElementById("confirmationFormRefuse");
            var modalCauseFieldRefuse = document.getElementById("modalCauseFieldRefuse");

            forms.forEach(function(form) {
                form.addEventListener("submit", function(event) {
                    event.preventDefault();

                    var formData = new FormData(form);
                    var action = form.action;
                    var acceptOption = form.querySelector("input[name='reponse'][value='Accepter']").checked;
                    var refuseOption = form.querySelector("input[name='reponse'][value='Refuser']").checked;

                    if (acceptOption) {
                        modalAccept.setAttribute("data-action", action);
                        modalAccept.setAttribute("data-form", JSON.stringify(Array.from(formData.entries())));
                        modalAccept.setAttribute("data-form-id", form.closest('.demande-card').id);
                        showConfirmationWindow('accept');
                    } else if (refuseOption) {
                        modalRefuse.setAttribute("data-action", action);
                        modalRefuse.setAttribute("data-form", JSON.stringify(Array.from(formData.entries())));
                        modalRefuse.setAttribute("data-reponse", "Refuser");
                        modalRefuse.setAttribute("data-form-id", form.closest('.demande-card').id);
                        showConfirmationWindow('refuse');
                    }
                });
            });

            closeButtonAccept.addEventListener("click", hideConfirmationWindowAccept);
            closeButtonRefuse.addEventListener("click", hideConfirmationWindowRefuse);

            confirmationFormAccept.addEventListener("submit", function(event) {
                event.preventDefault();

                var action = modalAccept.getAttribute("data-action");
                var formData = new FormData();
                var originalData = JSON.parse(modalAccept.getAttribute("data-form"));
                var formId = modalAccept.getAttribute("data-form-id");
                originalData.forEach(function(pair) {
                    formData.append(pair[0], pair[1]);
                });

                sendFormData(action, formData, formId);
            });

            confirmationFormRefuse.addEventListener("submit", function(event) {
                event.preventDefault();

                var action = modalRefuse.getAttribute("data-action");
                var formData = new FormData();
                var originalData = JSON.parse(modalRefuse.getAttribute("data-form"));
                var formId = modalRefuse.getAttribute("data-form-id");
                originalData.forEach(function(pair) {
                    formData.append(pair[0], pair[1]);
                });

                var causeDeRefus = document.getElementById("causeDeRefus").value;
                formData.append("reponse", "Refuser");
                formData.append("cause_de_refus", causeDeRefus);

                sendFormData(action, formData, formId);
            });

            function sendFormData(action, formData, formId) {
                fetch(action, {
                    method: 'POST',
                    body: formData
                })
                .then(response => {
                    if (response.ok) {
                        var demandeCard = document.getElementById(formId);
                        demandeCard.parentNode.removeChild(demandeCard);
                        hideConfirmationWindowAccept();
                        hideConfirmationWindowRefuse();
                    } else {
                        console.error('Une erreur s\'est produite lors de la soumission du formulaire');
                    }
                })
                .catch(error => {
                    console.error('Erreur fetch:', error);
                });
            }

            function showConfirmationWindow(type) {
                if (type === 'accept') {
                    modalAccept.style.display = "block";
                } else if (type === 'refuse') {
                    modalRefuse.style.display = "block";
                }
            }

            function hideConfirmationWindowAccept() {
                modalAccept.style.display = "none";
            }

            function hideConfirmationWindowRefuse() {
                modalRefuse.style.display = "none";
                document.getElementById("causeDeRefus").value = ''; // Clear the input after closing the modal
            }
        });
    </script>
    
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
                <li><a  href="service_de_Contrôle_et_de_la_Recherche.php">Accueil</a></li>
               
                <li><a href="../../control/deconnexion.php" onclick="confirmLogout(event)">Déconnexion</a></li>
            </ul>
        </nav>

        

    </div>
   </header>
   <div class="search-bar">
    <div class="container">
        <form method="GET" action="les_demandes_control.php">
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
                    <div class='demande-card' id='demande-" . $demande['id_demande'] . "'>
                    <h3>Nom du personne</h3>
                    <p>" . htmlspecialchars($demande['nom_personne'] . ' ' . $demande['prenom_personne']) . "</p>
                    <h3>Nom du document</h3>
                    <p>" . htmlspecialchars($demande['nom_document']) . "</p>
                    <a class='detail-btn' href='../detail.php?id_demande=". $demande['id_demande'] ."&nom_personne=". $demande['nom_personne'] ."&prenom_personne=". $demande['prenom_personne']."&nom_document=". $demande['nom_document'] ."&nom_service=". $demande['nom_service'] ."&demande_text=". $demande['demande_text'] ."&date_heure=". $demande['date_heure'] ."'>Détails</a>
                  
                    <!-- Formulaire pour la réponse -->
                    <form action='../../control/reponse.php?id_demande=". $demande['id_demande'] ."' method='post'>
                      <div class='option accepter'>
                      <input type='radio' id='accepter-" . $demande['id_demande'] . "' name='reponse' value='Accepter'>
                      <label for='accepter-" . $demande['id_demande'] . "'>Accepter</label>
                      </div>
                      <div class='option refuser'>
                      <input type='radio' id='refuser-" . $demande['id_demande'] . "' name='reponse' value='Refuser'>
                      <label for='refuser-" . $demande['id_demande'] . "'>Refuser</label>
                      </div>
                      <input type='submit' value='Envoyer réponse'>
                      </form>
                      <button type='button' class='signal-btn' data-id-demande='". $demande['id_demande'] ."'>Signaler</button>

                  </div>
                    ";
                }
            }
            ?>
        </div>
    </div>
    <div id="confirmationWindowAccept" class="modal">
        <div class="modal-content">
            <span class="close accept">&times;</span>
            <h2>Confirmation de l'acceptation</h2>
            <form id="confirmationFormAccept">
                <button type="submit">Confirmer</button>
            </form>
        </div>
    </div>

    <div id="confirmationWindowRefuse" class="modal">
        <div class="modal-content">
            <span class="close refuse">&times;</span>
            <h2>Cause du refus :</h2>
            <form id="confirmationFormRefuse">
                <div id="modalCauseFieldRefuse">
                    <label for="causeDeRefus">Cause du refus :</label>
                    <input type="text" id="causeDeRefus" name="causeDeRefus" required>
                </div>
                <button type="submit">Envoyer</button>
            </form>
        </div>
    </div>
    <div id="confirmationWindowSignale" class="modal">
        <div class="modal-content">
        <span class="close_signal">&times;</span>
            <h2>Cause de Signale :</h2>
            <form id="confirmationFormSignale">
                <div id="modalCauseFieldSignale">
                    <label for="causeDeSignale">Cause de Signale :</label>
                    <input type="text" id="causeDeSignale" name="causeDeSignale" required>
                </div>
                <button type="submit">Envoyer</button>
            </form>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Sélectionnez les boutons "Signaler"
            var signalerButtons = document.querySelectorAll(".signal-btn");

            // Sélectionnez la fenêtre de confirmation
            var confirmationWindowSignale = document.getElementById("confirmationWindowSignale");

            // Attachez un gestionnaire d'événements click à chaque bouton "Signaler"
            signalerButtons.forEach(function(button) {
                button.addEventListener("click", function() {
                    var idDemande = button.getAttribute("data-id-demande");
                    // Mettre à jour l'attribut data-id-demande de la fenêtre de confirmation
                    confirmationWindowSignale.setAttribute("data-id-demande", idDemande);
                    // Affichez la fenêtre de confirmation lorsque le bouton "Signaler" est cliqué
                    showConfirmationWindow();
                });
            });
             // Attachez un gestionnaire d'événements click au bouton de fermeture de la fenêtre de confirmation
        var closeButton = document.querySelector(".close_signal");
        closeButton.addEventListener("click", function() {
            hideConfirmationWindow();
        });

            // Sélectionnez le formulaire de confirmation
            var confirmationFormSignale = document.getElementById("confirmationFormSignale");

            // Attachez un gestionnaire d'événements submit au formulaire de confirmation
            confirmationFormSignale.addEventListener("submit", function(event) {
                event.preventDefault(); // Empêcher le comportement par défaut du formulaire

                // Récupérez la cause du signalement saisie par l'utilisateur
                var causeDeSignale = document.getElementById("causeDeSignale").value;

                // Récupérez l'ID de la demande à partir de l'attribut data-id-demande
                var idDemande = confirmationWindowSignale.getAttribute("data-id-demande");

                // Effectuer une requête AJAX pour mettre à jour la demande avec la cause de signalement
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "../../control/update_signal.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                        // Mettre à jour l'affichage ou effectuer d'autres actions si nécessaire
                        console.log("Traitement mis à jour pour la demande avec l'ID : " + idDemande);
                        // Masquer la fenêtre de confirmation
                        hideConfirmationWindow();
                        // Actualiser la page pour refléter les changements
                        location.reload();
                    }
                };
                xhr.send("id_demande=" + idDemande + "&causeDeSignale=" + causeDeSignale);
            });

            // Fonction pour afficher la fenêtre de confirmation
            function showConfirmationWindow() {
                confirmationWindowSignale.style.display = "block";
            }

            // Fonction pour masquer la fenêtre de confirmation
            function hideConfirmationWindow() {
                confirmationWindowSignale.style.display = "none";
            }
        });
    </script>
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
