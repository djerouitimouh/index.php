<?php
session_start();
require_once "db_connection.php";

// Vérifiez si les données sont bien reçues en POST
if (isset($_POST['id_demande']) && isset($_POST['causeDeSignale'])) {
    // Assurez-vous de nettoyer et d'échapper les données pour éviter les injections SQL
    $id_demande = htmlspecialchars($_POST['id_demande']);
    $causeDeSignale = htmlspecialchars($_POST['causeDeSignale']);

    // Préparez la requête SQL pour insérer les données dans la table signale
    $sql = "INSERT INTO signale (id_demande, cause_de_signale) VALUES (:id_demande, :causeDeSignale)";
    $stmt = $pdo->prepare($sql);

    try {
        // Exécutez la requête avec les valeurs appropriées
        $stmt->execute(array(
            ':id_demande' => $id_demande,
            ':causeDeSignale' => $causeDeSignale
        ));

        // Récupérer l'id_personne à partir de la table demande pour créer la notification
        $sql_select = "SELECT id_personne, nom_document FROM demande WHERE id_demande = :id_demande";
        $stmt_select = $pdo->prepare($sql_select);
        $stmt_select->execute([':id_demande' => $id_demande]);
        $demande = $stmt_select->fetch(PDO::FETCH_ASSOC);

        if ($demande) {
            $id_personne = $demande['id_personne'];
            $nom_document = $demande['nom_document'];
            $message = "Votre demande de " . $nom_document . " a été signalée pour la cause suivante : " . $causeDeSignale;

            // Préparation de la requête SQL pour insérer la notification
            $sql_insert_notification = "INSERT INTO notifications (id_user, message, is_read, created_at) VALUES (?, ?, 0, NOW())";
            $stmt_insert_notification = $pdo->prepare($sql_insert_notification);
            $stmt_insert_notification->execute([$id_personne, $message]);
        }

        // Retournez une réponse indiquant que l'opération s'est bien déroulée
        echo "Le signalement a été ajouté avec succès et la notification a été envoyée.";
    } catch (PDOException $e) {
        // En cas d'erreur, affichez un message d'erreur
        echo "Erreur lors de l'ajout du signalement : " . $e->getMessage();
    }
} else {
    // Si les données POST requises ne sont pas présentes, renvoyez un message d'erreur
    echo "Des données POST sont manquantes.";
}
?>
