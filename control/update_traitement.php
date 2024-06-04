<?php

// Vérifiez si l'identifiant de la demande et la date de récupération sont passés en paramètre
if(isset($_POST['id_demande']) && isset($_POST['date_recuperation'], $_POST['time_slot'])) {
    $id_demande = $_POST['id_demande'];
    $date_recuperation = $_POST['date_recuperation'];
    $time_slot = $_POST['time_slot'];
    $date_recuperation = $date_recuperation . ' ' . $time_slot;

    // Mettre à jour le champ `traiter` à "oui" et enregistrer la date de récupération dans la table `reponses`
    require_once "db_connection.php";
    $sql_update_traiter = "UPDATE reponses SET traiter = 'oui', date_de_recuperation = ? WHERE id_demande = ?";
    $stmt_update_traiter = $pdo->prepare($sql_update_traiter);
    $stmt_update_traiter->execute([$date_recuperation, $id_demande]);

    // Récupérer l'id_personne de la table demande pour ajouter la notification
    $sql_select_personne = "SELECT id_personne, nom_document FROM demande WHERE id_demande = ?";
    $stmt_select_personne = $pdo->prepare($sql_select_personne);
    $stmt_select_personne->execute([$id_demande]);
    $demande = $stmt_select_personne->fetch(PDO::FETCH_ASSOC);

    if ($demande) {
        $id_personne = $demande['id_personne'];
        $nom_document = $demande['nom_document'];
        $message = "Votre demande de " . $nom_document . " a été traitée.". "Date de récupération : " . $date_recuperation;

        // Insérer une notification dans la table notification
        $sql_insert_notification = "INSERT INTO notifications (id_user, message, is_read, created_at) VALUES (?, ?, 0, NOW())";
        $stmt_insert_notification = $pdo->prepare($sql_insert_notification);
        $stmt_insert_notification->execute([$id_personne, $message]);

        // Réponse pour la requête AJAX
        echo "Traitement mis à jour pour la demande avec l'ID : " . $id_demande;
    } else {
        echo "Erreur : Demande non trouvée.";
    }
} else {
    // Si l'identifiant de la demande ou la date de récupération ne sont pas passés en paramètre
    echo "Erreur : Identifiant de demande ou date de récupération manquant.";
}

?>
