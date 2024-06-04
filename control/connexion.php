<?php
// Établir la connexion à la base de données
require_once "db_connection.php";

// Démarrer la session
session_start();

// Vérifier si le formulaire a été soumis
if (isset($_POST['submit'])) {
    // Vérifier si les données du formulaire sont présentes
    if (isset($_POST['identifiant']) && isset($_POST['motDePasse'])) {
        // Récupérer les données du formulaire
        $identifiant = $_POST['identifiant'];
        $motDePasse = $_POST['motDePasse'];

        // Déterminer si l'identifiant est un email ou un nom d'utilisateur
        if (filter_var($identifiant, FILTER_VALIDATE_EMAIL)) {
            // Requête pour sélectionner l'utilisateur par email
            $sql = "SELECT * FROM personne WHERE email = :identifiant";
        } else {
            // Requête pour sélectionner l'utilisateur par nom d'utilisateur
            $sql = "SELECT * FROM personne WHERE username = :identifiant";
        }

        $stmt = $pdo->prepare($sql);
        $stmt->execute(['identifiant' => $identifiant]);

        // Récupérer les informations de l'utilisateur
        $user = $stmt->fetch();

        // Vérifier si l'utilisateur existe
        if ($user) {
            // Vérifier si le mot de passe est correct pour les comptes spécifiques
            if (($identifiant === 'centre_des_impots@gmail.com' || $identifiant === 'Service_Recette@gmail.com' ||
                 $identifiant === 'Service_Pricipale_de_Gestion@gmail.com' || $identifiant === 'Servise_de_Controle_et_de_la_Recherche@gmail.com')
                 && password_verify($motDePasse, $user['motDePasse'])) {
                // Rediriger vers les pages spécifiques en fonction du compte
                if ($identifiant === 'centre_des_impots@gmail.com') {
                    header('Location: ../views/centre/centre.php');
                } elseif ($identifiant === 'Service_Recette@gmail.com') {
                    header('Location: ../views/service_recette/service_recette.php');
                } elseif ($identifiant === 'Service_Pricipale_de_Gestion@gmail.com') {
                    header('Location: ../views/service_principale_de_gestion/Service_Principale_de_Gestion.php');
                } elseif ($identifiant === 'Servise_de_Controle_et_de_la_Recherche@gmail.com') {
                    header('Location: ../views/service_de_Contrôle_et_de_la_Recherche/service_de_Contrôle_et_de_la_Recherche.php');
                }
                $_SESSION['id'] = $user['id'];
                exit();
            } 
            // Vérifier si le mot de passe est correct pour les autres utilisateurs
            elseif (password_verify($motDePasse, $user['motDePasse'])) {
                // Définir la session
                $_SESSION['id'] = $user['id'];
                // Rediriger vers le tableau de bord
                header('Location: ../views/client/welcome.php');
                exit();
            } else {
                // Mot de passe incorrect
                $_SESSION['error'] = "Mot de passe incorrect !";
            }
        } else {
            // Utilisateur introuvable
            $_SESSION['error'] = "Utilisateur introuvable";
        }
    } else {
        // Données manquantes
        $_SESSION['error'] = "Une ou plusieurs données du formulaire sont manquantes.";
    }
} else {
    // Formulaire non soumis
    $_SESSION['error'] = "Le formulaire n'a pas été soumis.";
}

// Rediriger vers la page de connexion en cas d'erreur
header('Location: ../views/client/connexion.php');
exit();
?>
