<?php  
session_start();
require_once "../../control/db_connection.php";
if(!isset($_SESSION['id'])) {
    header('Location:../../index.php');
    exit(); // Ajout d'un exit() après la redirection pour stopper l'exécution du script
}

$search = isset($_GET['search']) ? $_GET['search'] : '';
$type = isset($_GET['type']) ? $_GET['type'] : 'refuser';  // Par défaut, afficher les demandes refusées

// Requête SQL en fonction du type de demande
if ($type == 'recuperer') {
    $sql = "SELECT demande.*, personne.nom AS nom_personne, personne.prenom AS prenom_personne
            FROM demande 
            INNER JOIN personne ON demande.id_personne = personne.id
            INNER JOIN reponses ON demande.id_demande = reponses.id_demande
            WHERE demande.nom_service = 'Service Recette' 
            AND reponses.reponse = 'Accepter'
            AND reponses.traiter = 'oui'
            AND reponses.recuperez = 'oui'";
} else {
    $sql = "SELECT demande.*, personne.nom AS nom_personne, personne.prenom AS prenom_personne
            FROM demande 
            INNER JOIN personne ON demande.id_personne = personne.id
            INNER JOIN reponses ON demande.id_demande = reponses.id_demande
            WHERE demande.nom_service = 'Service Recette' 
            AND reponses.reponse = 'Refuser'";
}

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
    <title>Centre</title>
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

        function showDemandes(type) {
            window.location.href = `les_demandes_recette_ref_centre.php?type=${type}`;
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
            <li><a   href="centre.php">Accueil</a></li>
                <li><a href="les_demandes_sig.php">Signalees</a></li>

                <li><a href="utilisateur.php">Les Utilisateurs</a></li>
                <li><a href="../../control/deconnexion.php" onclick="confirmLogout(event)">Déconnexion</a></li>
            </ul>
        </nav>
    </div>
</header>
<div class="toogle">
    <button class="toggle-btn <?php echo $type == 'refuser' ? 'active' : ''; ?>" onclick="showDemandes('refuser')">Afficher les demandes refusées</button>
    <button class="toggle-btn <?php echo $type == 'recuperer' ? 'active' : ''; ?>" onclick="showDemandes('recuperer')">Afficher les demandes récupérées</button>
</div>
<div class="search-bar">
    <div class="container">
        <form method="GET" action="les_demandes_recette_ref_centre.php">
            <input type="hidden" name="type" value="<?php echo htmlspecialchars($type); ?>">
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
                    <h3>Nom de la personne</h3>
                    <p>" . $demande['nom_personne'] . " " . $demande['prenom_personne'] . "</p>
                    <h3>Nom du document</h3>
                    <p>" . $demande['nom_document'] . "</p>
                    <a class='detail-btn' href='../detail.php?id_demande=" . $demande['id_demande'] . "&nom_personne=" . $demande['nom_personne'] . "&prenom_personne=" . $demande['prenom_personne'] . "&nom_document=" . $demande['nom_document'] . "&nom_service=" . $demande['nom_service'] . "&demande_text=" . $demande['demande_text'] . "&date_heure=" . $demande['date_heure'] . "'>Détails</a>
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
