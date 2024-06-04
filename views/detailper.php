<?php
session_start();
require_once "../control/db_connection.php";
if(!isset($_SESSION['id'])) {
    header('Location:../index.php');
    exit(); // Ajout d'un exit() après la redirection pour stopper l'exécution du script
}

// Vérifier si les données sont présentes dans l'URL
if (isset($_GET['id']) && isset($_GET['prenom_personne']) && isset($_GET['nom_personne']) && isset($_GET['date_de_naissance'])) {
    // Récupérer les données de l'URL
    $id = $_GET['id'];
    $nom_personne = $_GET['nom_personne'];
    $prenom_personne = $_GET['prenom_personne'];
    $date_de_naissance = $_GET['date_de_naissance'];
    
    // Requête pour récupérer le nombre de demandes pour cette personne
    $sql_demande_count = "SELECT COUNT(*) AS demande_count FROM demande WHERE id_personne = :id";
    $stmt_demande_count = $pdo->prepare($sql_demande_count);
    $stmt_demande_count->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt_demande_count->execute();
    $demande_count = $stmt_demande_count->fetchColumn();

    // Requête pour récupérer le nombre de demandes signalées pour cette personne
    $sql_signale_count = "
        SELECT COUNT(*) AS signale_count
        FROM signale
        WHERE id_demande IN (SELECT id_demande FROM demande WHERE id_personne = :id)";
    $stmt_signale_count = $pdo->prepare($sql_signale_count);
    $stmt_signale_count->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt_signale_count->execute();
    $signale_count = $stmt_signale_count->fetchColumn();

} else {
    // Rediriger vers une page d'erreur si les données sont manquantes dans l'URL
    header("Location: erreur.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de la demande</title>
    <link rel="stylesheet" href="../public/css/style1.css">
</head>
<body>
    
    <div class="demande-detail">
        <div class="container">
            <div class="demande-card">
                <h3>Nom de la personne</h3>
                <p><?php echo htmlspecialchars($nom_personne); ?></p>
                <h3>Prénom</h3>
                <p><?php echo htmlspecialchars($prenom_personne); ?></p>
                <h3>Date de Naissance</h3>
                <p><?php echo htmlspecialchars($date_de_naissance); ?></p>
                <h3>Nombre de demandes</h3>
                <p><?php echo $demande_count; ?></p>
                <h3>Nombre de demandes signalées</h3>
                <p><?php echo $signale_count; ?></p>
            </div>
        </div>
    </div>
</body>
</html>
