<?php 
// connect to the database
require_once "db_connection.php";

// check if the form is submitted
if (isset($_POST['submit'])){
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $username = $_POST['username'];
    $sexe = $_POST['sexe'];
    $dateNaissance = $_POST['dateNaissance'];
    $email = $_POST['email'];
    $motDePasse = $_POST['motDePasse'];
    $confirmMotDePasse = $_POST['confirmMotDePasse'];

    // Vérifiez si les mots de passe correspondent
    if ($motDePasse !== $confirmMotDePasse) {
        session_start();
        $_SESSION['error'] = "Les mots de passe ne correspondent pas!";
        header('Location: ../views/client/inscription.php');
        exit();
    }

    // check if user already exists
    $sql = "SELECT * FROM personne WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch();
    if ($user) {
        session_start();
        $_SESSION['error'] = "Utilisateur déjà existant!";
        header('Location: ../views/client/inscription.php');
        exit();
    }
    $sqli = "SELECT * FROM personne WHERE username = :username";
    $stmti = $pdo->prepare($sqli);
    $stmti->execute(['username' => $username]);
    $useri = $stmti->fetch();
    if ($useri) {
        session_start();
        $_SESSION['error'] = "Utilisateur déjà existant!";
        header('Location: ../views/client/inscription.php');
        exit();
    }


    // Insert user into database
    $sql = "INSERT INTO personne (nom, prenom,username, sexe, dateNaissance, email, motDePasse) VALUES (:nom, :prenom, :username, :sexe, :dateNaissance, :email, :motDePasse)";
    $stmt = $pdo->prepare($sql);
    // hash the password
    $motDePasse = password_hash($motDePasse, PASSWORD_DEFAULT);

    $answer = $stmt->execute(['nom' => $nom, 'prenom' => $prenom,'username' => $username, 'sexe' => $sexe, 'dateNaissance' => $dateNaissance, 'email' => $email, 'motDePasse' => $motDePasse]);
    
    if ($answer) {
        // Get the last inserted ID
        $last_id = $pdo->lastInsertId();
        // Start session
        session_start();
        // Redirect to the welcome page
        $_SESSION['id'] = $last_id;
        header('Location: ../views/client/welcome.php');
    } else {
        session_start();
        $_SESSION['error'] = "Quelque chose s'est mal passé!";
        header('Location: ../views/client/inscription.php');
    }
}
?>
