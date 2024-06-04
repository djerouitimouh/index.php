<?php
// Inclusion de la configuration de la base de données
session_start();


if(isset($_GET['id_personne'])){
    require_once "db_connection.php";
    // Supprimer les demandes de l'utilisateur
    $id_personne = $_GET['id_personne'];

    // Supprimer les réponses associées aux demandes supprimées
    $sql_delete_reponses = "DELETE reponses FROM reponses INNER JOIN demande ON reponses.id_demande = demande.id_demande WHERE demande.id_personne = ?";
    $stmt = $pdo->prepare($sql_delete_reponses);
    $stmt->execute([$id_personne]);
    // Vérifier si la suppression a réussi ou non

    // Supprimer les signalements associés aux demandes supprimées
    $sql_delete_signalements = "DELETE signale FROM signale INNER JOIN demande ON signale.id_demande = demande.id_demande WHERE demande.id_personne = ?";
    $stmt = $pdo->prepare($sql_delete_signalements);
    $stmt->execute([$id_personne]);
    // Vérifier si la suppression a réussi ou non
    $sql_delete_notifications = "DELETE FROM notifications WHERE id_user = ?";
    $stmt = $pdo->prepare($sql_delete_notifications);
    $stmt->execute([$id_personne]);
    // Supprimer les demandes de l'utilisateur
    $sql_delete_demandes = "DELETE FROM demande WHERE id_personne = ?";
    $stmt = $pdo->prepare($sql_delete_demandes);
    $stmt->execute([$id_personne]);
    // Vérifier si la suppression a réussi ou non

    // Supprimer l'utilisateur de la table personne
    $sql_delete_personne = "DELETE FROM personne WHERE id = ?";
    $stmt = $pdo->prepare($sql_delete_personne);
    $stmt->execute([$id_personne]);
    // Vérifier si la suppression a réussi ou non
    
    // Après avoir effectué la suppression avec succès
    header('Location: ../views/centre/les_demandes_sig.php');
    exit(); // Assurez-vous de terminer le script après la redirection
} else {
    header('Location: ../views/centre/les_demandes_sig.php');
    exit();  
}
?>
