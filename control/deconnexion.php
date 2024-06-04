<?php
    // Démarre ou reprend la session
    session_start();

    // Détruit toutes les données associées à la session actuelle
    session_destroy();

    // Redirige l'utilisateur vers la page index.php
    header('Location: ../index.php');
    exit(); // Assurez-vous d'arrêter l'exécution du script après la redirection
?>
