<?php

$host = 'localhost'; // or your database host
$db = 'centredesimpots'; // your database name
$user = 'root'; // your database username
$pass = ''; // your database password
$charset = 'utf8mb4';

$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    //echo "Connexion réussie!";
    
    // Placez le code ici s'il doit être exécuté en cas de succès de la tentative de connexion
} catch (\PDOException $e) {
    echo "Erreur de connexion : " . $e->getMessage();
    // throw new \PDOException($e->getMessage(), (int) $e->getCode());
}

?>