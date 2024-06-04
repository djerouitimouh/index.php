<?php
session_start();
require_once "../control/db_connection.php";
if(!isset($_SESSION['id'])) {
    header('Location:../index.php');
    exit();
}

// Vérifier si l'id_demande est présent dans l'URL
if(isset($_GET['id_demande'])) {
    // Récupérer l'id_demande de l'URL
    $id_demande = $_GET['id_demande'];

    // Requête pour récupérer les détails de la demande
    $sql = "SELECT d.id_demande, p.nom, p.prenom, d.nom_document, d.demande_text, d.date_heure, d.nom_service, 
                   r.cause_de_refus, r.date_de_recuperation, s.cause_de_signale
            FROM demande d
            LEFT JOIN reponses r ON d.id_demande = r.id_demande
            LEFT JOIN personne p ON d.id_personne = p.id
            LEFT JOIN signale s ON d.id_demande = s.id_demande
            WHERE d.id_demande = :id_demande";

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id_demande' => $id_demande]);
        $demande = $stmt->fetch();

        if ($demande) {
            $nom_personne = $demande['nom'];
            $prenom_personne = $demande['prenom'];
            $nom_document = $demande['nom_document'];
            $demande_text = $demande['demande_text'];
            $date_heure = $demande['date_heure'];
            $nom_service = $demande['nom_service'];
        } else {
            // Rediriger vers une page d'erreur si la demande n'existe pas
            header("Location: erreur.php");
            exit;
        }

        // Vérifier l'état de la demande
        $etat_demande = "En attente";
        $etat_class = "etat-attente";
        $cause_de_signale = "";
        $cause_de_refus = "";
        $date_de_recuperation = "";

        // Vérifier si la demande est signalée
        $sql_signale = "SELECT cause_de_signale FROM signale WHERE id_demande = :id_demande";
        $stmt_signale = $pdo->prepare($sql_signale);
        $stmt_signale->execute(['id_demande' => $id_demande]);
        if ($row_signale = $stmt_signale->fetch()) {
            $etat_demande = "Signalée";
            $etat_class = "etat-signalee";
            $cause_de_signale = $row_signale['cause_de_signale'];
        } else {
            // Vérifier les réponses
            $sql_reponse = "SELECT reponse, traiter, recuperez, cause_de_refus, date_de_recuperation FROM reponses WHERE id_demande = :id_demande";
            $stmt_reponse = $pdo->prepare($sql_reponse);
            $stmt_reponse->execute(['id_demande' => $id_demande]);
            $reponse = $stmt_reponse->fetch();
            
            if ($reponse) {
                if ($reponse['reponse'] == "Refuser") {
                    $etat_demande = "Refusée";
                    $etat_class = "etat-refusee";
                    $cause_de_refus = $reponse['cause_de_refus'];
                } elseif ($reponse['reponse'] == "Accepter") {
                    if ($reponse['traiter'] == "non") {
                        $etat_demande = "Acceptée mais pas prête";
                        $etat_class = "etat-acceptee";
                    } elseif ($reponse['traiter'] == "oui" && $reponse['recuperez'] == "non") {
                        $etat_demande = "Prête mais pas récupérée";
                        $etat_class = "etat-acceptee";
                        $date_de_recuperation = $reponse['date_de_recuperation'];
                    } elseif ($reponse['recuperez'] == "oui") {
                        $etat_demande = "Récupérée";
                        $etat_class = "etat-acceptee";
                    }
                }
            }
        }

    } catch (PDOException $e) {
        echo "Erreur de requête : " . $e->getMessage();
        exit;
    }

} else {
    // Rediriger vers une page d'erreur si l'id_demande est manquant dans l'URL
    header("Location: erreur.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de la demande</title>
    <link rel="stylesheet" href="../public/css/style1.css">
</head>
<body>
    
    <div class="etat-demande <?php echo htmlspecialchars($etat_class); ?>">
        <h3>État de la demande</h3>
        <p><?php echo htmlspecialchars($etat_demande); ?></p>
    </div>

    <div class="demande-detail">
        <div class="container">
            <div class="demande-card">
                <h3>Nom de la personne</h3>
                <p><?php echo htmlspecialchars($nom_personne) . ' ' . htmlspecialchars($prenom_personne); ?></p>
                <h3>Nom du service</h3>
                <p><?php echo htmlspecialchars($nom_service); ?></p>
                <h3>Nom du document</h3>
                <p><?php echo htmlspecialchars($nom_document); ?></p>
                <h3>Demande</h3>
                <p><?php echo wordwrap(htmlspecialchars($demande_text), 100, "<br />\n", true); ?></p>
                <h3>Date et heure</h3>
                <p><?php echo htmlspecialchars($date_heure); ?></p>
                <?php if ($etat_demande == "Signalée") { ?>
                    <h3>Cause du signalement</h3>
                    <p><?php echo htmlspecialchars($cause_de_signale); ?></p>
                <?php } elseif ($etat_demande == "Refusée") { ?>
                    <h3>Cause du refus</h3>
                    <p><?php echo htmlspecialchars($cause_de_refus); ?></p>
                <?php } elseif ($etat_demande == "Prête mais pas récupérée") { ?>
                    <h3>Date de récupération</h3>
                    <p><?php echo htmlspecialchars($date_de_recuperation); ?></p>
                <?php } ?>
            </div>
        </div>
    </div>
</body>
</html>
