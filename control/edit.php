<?php
// connect to the data base 
include_once "db_connection.php";
// open the box
session_start();
if(isset($_POST['submit'])) {

    // get the id from the session
    $id = $_SESSION['id'];

    // get the form info
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $username = $_POST['username'];

    $email = $_POST['email'];
    $motDePasse = $_POST['motDePasse'];
    // prepare the sql
    $sql = "UPDATE personne SET ";
    $params = array();

    // add each field to the query if it has been provided
    if(!empty($nom)){
        $sql .= "nom=:nom, ";
        $params['nom'] = $nom;
    }
    if(!empty($prenom)){
        $sql .= "prenom=:prenom, ";
        $params['prenom'] = $prenom;
    }
    if(!empty($username)){
        $sql .= "username=:username, ";
        $params['username'] = $username;
    }

    if (!empty($email)){
        $sql .= "email=:email, ";
        $params['email']=$email;
    }

    if(!empty($motDePasse)) {
        // hash the password
        $hashedpassword = password_hash($motDePasse, PASSWORD_DEFAULT);
        $sql .= "motDePasse=:motDePasse, ";
        $params['motDePasse'] = $hashedpassword;
    }
    $sql = rtrim($sql, ', ') . " WHERE id=:id";
    $params['id'] = $id;

    $stmt = $pdo->prepare($sql);
    $answer = $stmt->execute($params);
    // check if successful
    if ($answer) {
        $_SESSION['message'] = "updated successfully";
        header("Location: ../views/client/edit.php");
    } else {
        $_SESSION['message'] = 'Error happen, sorry!';
    }}