<?php
session_start();
require_once "../control/db_connection.php";

// Vérification si l'identifiant de la demande est passé en paramètre dans l'URL et si la réponse est soumise
if (isset($_GET['id_demande']) && isset($_POST['reponse'])) {
    $id_demande = $_GET['id_demande'];
    $reponse = $_POST['reponse'];
    $cause_de_refus = isset($_POST['cause_de_refus']) ? $_POST['cause_de_refus'] : null;

    // Préparation de la requête SQL pour insérer la réponse
    $sql_insert_reponse = "INSERT INTO reponses (id_demande, reponse, cause_de_refus) VALUES (?, ?, ?)";
    $stmt_insert_reponse = $pdo->prepare($sql_insert_reponse);
    $stmt_insert_reponse->execute([$id_demande, $reponse, $cause_de_refus]);

    // Récupérer l'id_personne et le nom du document à partir de la table demande
    $sql = "SELECT id_personne, nom_document FROM demande WHERE id_demande = :id_demande";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id_demande' => $id_demande]);
    $demande = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($demande) {
        $id_personne = $demande['id_personne'];
        $nom_document = $demande['nom_document'];

        // Définir le message de la notification en fonction de la réponse
        if ($reponse == 'Accepter') {
            $message = "Votre demande de " . $nom_document . " est acceptée.";
        } else if ($reponse == 'Refuser') {
            $message = "Votre demande de " . $nom_document . " est refusée.";
        } else {
            $message = "Votre demande de " . $nom_document . " a reçu une réponse.";
        }

        // Préparation de la requête SQL pour insérer la notification
        $sql_insert_notification = "INSERT INTO notifications (id_user, message, is_read, created_at) VALUES (?, ?, 0, NOW())";
        $stmt_insert_notification = $pdo->prepare($sql_insert_notification);
        $stmt_insert_notification->execute([$id_personne, $message]);

        // Suppression de la demande (optionnel, à réactiver si nécessaire)
        // $sql_delete_demande = "DELETE FROM demande WHERE id_demande = ?";
        // $stmt_delete_demande = $pdo->prepare($sql_delete_demande);
        // $stmt_delete_demande->execute([$id_demande]);

        // Redirection ou autre action après le traitement
        header("Location: success.php");
        exit;
    } else {
        // Si la demande n'existe pas, redirection vers une page d'erreur ou autre action
        header("Location: erreur.php");
        exit;
    }
} else {
    // Si l'identifiant de la demande ou la réponse n'est pas passé en paramètre, redirection vers une page d'erreur ou autre action
    header("Location: erreur.php");
    exit;
}
?>
