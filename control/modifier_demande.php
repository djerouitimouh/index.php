<?php
session_start();
require_once "db_connection.php";

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id'])) {
    header('Location:../index.php');
    exit;
}

// Vérifier si l'identifiant de la demande est passé dans l'URL
if (!isset($_GET['id_demande'])) {
    header('Location: erreur.php');
    exit;
}

// Récupérer l'identifiant de la demande à modifier
$id_demande = $_GET['id_demande'];

// Récupérer les informations de la demande depuis la base de données
$sql = "SELECT * FROM demande WHERE id_demande = :id_demande AND id_personne = :id_personne";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id_demande' => $id_demande, 'id_personne' => $_SESSION['id']]);
$demande = $stmt->fetch();

// Vérifier si la demande existe et appartient à l'utilisateur
if (!$demande) {
    header('Location: erreur.php');
    exit;
}

// Traitement du formulaire de modification
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer le nouveau texte de la demande depuis le formulaire
    $demande_text = $_POST['demande_text'];

    // Mettre à jour la demande dans la base de données avec la nouvelle demande_text et la date_heure actuelle
    $sql_update = "UPDATE demande SET demande_text = :demande_text, date_heure = NOW() WHERE id_demande = :id_demande";
    $stmt_update = $pdo->prepare($sql_update);
    $stmt_update->execute(['demande_text' => $demande_text, 'id_demande' => $id_demande]);

    // Rediriger vers la page de demande après la modification
    header("Location: ../views/client/votre_demande.php");
    exit;
}

?>
