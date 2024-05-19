<?php
include('server/connection.php');

if(isset($_GET['game'])) {
    $idGame = $_GET['game'];

    $query = "SELECT * FROM rank WHERE Id_Game = $idGame";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $ranks = $stmt->get_result();
} 
?>
