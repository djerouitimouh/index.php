<?php
    // Démarrage de la session en premier
    session_start();

    // Vérification si l'utilisateur est connecté
    if(!isset($_SESSION['id'])) {
        header('Location: ../index.php');
        exit(); // Arrêt de l'exécution du script après la redirection
    }

    // Vérification si l'identifiant de la demande est passé dans l'URL
    if(isset($_GET['id_demande'])) {
        // Connexion à la base de données
        require_once "db_connection.php";

        // Récupération de l'identifiant de la demande à supprimer
        $id_demande = $_GET['id_demande'];

        // Requête SQL pour supprimer la demande
        $sql = "DELETE FROM demande WHERE id_demande = :id_demande";

        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id_demande' => $id_demande]);

        // Redirection vers la page précédente après la suppression
        header('Location: ../views/client/votre_demande.php');
        exit();
    } else {
        // Redirection vers la page précédente si l'identifiant de la demande n'est pas passé
        header('Location: ../views/client/votre_demande.php');
        exit();
    }
?>
