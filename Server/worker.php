<?php

include('connection.php');

if (isset($_GET['game'])) {
    $id = $_GET['game'];
    $query = "SELECT * FROM game g inner join workers w on w.Id_Game = g.Id_Game inner join users u on u.Id_User = w.Id_User WHERE g.Id_Game = $id";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $workers = $stmt->get_result();
    
    $query_game = "SELECT Nama_Game FROM game WHERE Id_Game = $id";
    $stmt_game = $conn->prepare($query_game);
    $stmt_game->execute();
    $game_result = $stmt_game->get_result();
    $game_data = $game_result->fetch_assoc();
    $game = $game_data['Nama_Game'];
} else {
    header('location: index.php?error=Select Game First');
}
?>
