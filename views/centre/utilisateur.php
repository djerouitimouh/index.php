<?php
session_start();
require_once "../../control/db_connection.php";
if(!isset($_SESSION['id'])) {
    header('Location:../../index.php');
    exit(); // Ajout d'un exit() après la redirection pour stopper l'exécution du script
}
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Construire la requête SQL de base
$sql = "SELECT * FROM personne WHERE email NOT IN ('centre_des_impots@gmail.com', 'Service_Recette@gmail.com', 'Service_Pricipale_de_Gestion@gmail.com', 'Servise_de_Controle_et_de_la_Recherche@gmail.com')";

// Si des critères de recherche sont spécifiés, ajouter des conditions à la requête
$searchParams = [];
if ($search) {
    // Si la recherche contient un espace, nous supposons qu'il s'agit du nom et du prénom de la personne
    if (strpos($search, ' ') !== false) {
        $searchParams = explode(' ', $search);
        $sql .= " AND personne.nom LIKE :nom AND personne.prenom LIKE :prenom";
    } else {
        // Sinon, rechercher dans les deux colonnes (nom et prénom)
        $sql .= " AND (personne.prenom LIKE :search OR personne.prenom LIKE :search)";
    }
}

// Préparer la requête SQL
$stmt = $pdo->prepare($sql);

// Lier les valeurs des paramètres de recherche si spécifiés
if ($search) {
    if (count($searchParams) == 2) {
        $stmt->bindValue(':nom', '%' . $searchParams[0] . '%', PDO::PARAM_STR);
        $stmt->bindValue(':prenom', '%' . $searchParams[1] . '%', PDO::PARAM_STR);
    } else {
        $stmt->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
    }
}

// Exécuter la requête
$stmt->execute();
$users = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Center</title>
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
<body>
<header>
    <div class="container">
        <div class="logo">
            <img src="../../public/images/logo1.png" alt="CDI">
        </div>
        <nav class="bar">
            <ul>
                <li><a href="centre.php">Accueil</a></li>
                <li><a href="les_demandes_sig.php">Signalees</a></li>
                <li><a class="active" href="utilisateur.php">Les Utilisateurs</a></li>
                <li><a href="../../control/deconnexion.php" onclick="confirmLogout(event)">Déconnexion</a></li>
            </ul>
        </nav>
    </div>
</header>
<div class="search-bar">
    <div class="container">
        <form method="GET" action="utilisateur.php">
            <input type="text" name="search" placeholder="Rechercher par nom, prénom ou nom de document" value="<?php echo htmlspecialchars($search); ?>">
            <button type="submit">Rechercher</button>
        </form>
    </div>
</div>
<div class="user-table-container">
    <h2>Liste des Utilisateurs</h2>
    <table class="user-table">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Détails</th>
                <th>Demandes</th>
                <th>Supprimer</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Afficher les utilisateurs filtrés par la recherche
            if ($users) {
                foreach ($users as $user) {
                    echo "<tr>";
                    echo "<td>{$user['nom']}</td>";
                    echo "<td>{$user['prenom']}</td>";
                    echo "<td><a href='../detailper.php?id=" . "&id=" . $user['id'] . "&nom_personne=" . $user['nom'] . "&prenom_personne=" . $user['prenom'] . "&date_de_naissance=" . $user['dateNaissance'] . "' class='user-details-btn'>Détails</a></td>";
                    echo "<td><a href='les_demande_de_per.php?id_personne=" . $user['id'] . "' class='view-demands-btn'>Voir les demandes</a></td>";
                    echo "<td><a href='#' onclick='showDeleteConfirmationDialog(event, \"../../control/efface_user.php?id_personne=" . $user['id'] . "\")' class='user-delete-btn'>Effacer</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Aucun utilisateur trouvé</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>
<div id="deleteConfirmationDialog" class="confirmation-dialog">
    <p>Êtes-vous sûr de vouloir effacer cette personne ?</p>
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
