<?php
require_once "../../control/db_connection.php";

if (isset($_POST['date'])) {
    $date = $_POST['date'];

    $sql = "SELECT 
                DATE_FORMAT(date_de_recuperation, '%H:%i') AS time_slot, 
                COUNT(*) AS count 
            FROM reponses 
            WHERE DATE(date_de_recuperation) = :date 
            GROUP BY time_slot";

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':date', $date, PDO::PARAM_STR);
    $stmt->execute();
    $timeSlots = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($timeSlots);
}
?>
