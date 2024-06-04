<?php
// Vérifiez si l'identifiant de la demande est passé en paramètre
if(isset($_POST['id_demande'])) {
    $id_demande = $_POST['id_demande'];

    // Mettre à jour le champ `traiter` à "oui" dans la table `reponses`
    require_once "db_connection.php";
    $sql_update_traiter = "UPDATE reponses SET recuperez = 'oui' WHERE id_demande = ?";
    $stmt_update_traiter = $pdo->prepare($sql_update_traiter);
    $stmt_update_traiter->execute([$id_demande]);

    // Réponse pour la requête AJAX
    echo "Traitement mis à jour pour la demande avec l'ID : " . $id_demande;
} else {
    // Si l'identifiant de la demande n'est pas passé en paramètre
    echo "Erreur : Identifiant de demande manquant.";
}
?>