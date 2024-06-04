<?php
// Inclusion du fichier de connexion à la base de données
require_once "db_connection.php";

// Démarrage de la session
session_start();

// Vérification si l'utilisateur est connecté
if (!isset($_SESSION['id'])) {
    // Redirection vers la page de connexion si l'utilisateur n'est pas connecté
    header('Location: ../views/client/connexion.php');
    exit; // Assure l'arrêt du script après la redirection
}

// Récupération de l'identifiant de l'utilisateur à partir de la session
$id_personne = $_SESSION['id'];

// Tableau associatif contenant la correspondance entre les documents et les services
$document_to_service = array(
    "Extraits des Rôles" => "Service Recette",
    "Calendrier de Paiement" => "Service Recette",
    "C20" => "Service Principal de Gestion",
    "Franchise TVA: (F20,F21,F22)" => "Service Principal de Gestion",
    "Attestation du NIF" => "Service Principal de Gestion",
    "PV d'Entrée ou d'Exploitation" => "Service Principal de Gestion",
    "Etat d'Environnement" => "Service Principal de Gestion",
    "PV Constat" => "Service de Contrôle et de la Recherche"
);

// Vérification si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['submit'])) {
    // Récupération des données du formulaire
    $document = $_POST['document'];
    $motif = $_POST['motif'];
    $service = $document_to_service[$document]; // Récupération du service correspondant au document

    // Debugging output
    echo "ID Personne: $id_personne<br>";
    echo "Document: $document<br>";
    echo "Motif: $motif<br>";
    echo "Service: $service<br>";

    // Préparation de la requête SQL avec des paramètres nommés pour la sécurité
  $sql = "INSERT INTO demande (id_personne, nom_document, demande_text, date_heure, nom_service) VALUES (:id_personne, :nom_document, :demande_text, CURRENT_TIMESTAMP, :nom_service)";
    $stmt = $pdo->prepare($sql);

    // Exécution de la requête avec les valeurs des paramètres
    $success = $stmt->execute([':id_personne' => $id_personne, ':nom_document' => $document, ':demande_text' => $motif, ':nom_service' => $service]);

    // Vérification du succès de l'opération d'insertion
    if ($success) {
        echo "Insertion réussie";
        // Redirection vers une page de confirmation ou un tableau de bord
        header('Location: ../views/client/welcome.php');
        exit; // Assure l'arrêt du script après la redirection
    } else {
        // Output SQL error for debugging
        $errorInfo = $stmt->errorInfo();
        echo "Erreur SQL: " . $errorInfo[2];
        // En cas d'échec, enregistrement d'un message d'erreur dans la session
        $_SESSION['error'] = "Something went wrong!";
        header('Location: ../views/error.php');
        exit; // Assure l'arrêt du script après la redirection
    }
}
?>
