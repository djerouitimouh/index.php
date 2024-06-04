<?php
session_start();
require_once "db_connection.php";

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['id'])) {
    header('Location: ../../index.php');
    exit;
}

// Vérifiez si l'ID de la notification à marquer comme lue est envoyé via POST
if(isset($_POST['mark_as_read'])) {
    // Récupérez l'ID de la notification à partir des données POST
    $notification_id = $_POST['mark_as_read'];

    // Mettez à jour la colonne `is_read` dans la base de données
    $sql = "UPDATE notifications SET is_read = 1 WHERE id_notification = :id AND id_user = :user_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $notification_id, 'user_id' => $_SESSION['id']]);
}

// Redirigez l'utilisateur vers la page des notifications après la mise à jour
header('Location: ../views/client/notifications.php');
exit;
?>
