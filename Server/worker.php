<?php

include('connection.php');

if (isset($_GET['game'])) {
    $id = $_GET['game'];
    $query = "SELECT * FROM workers_game wg inner join workers w on w.Id_Worker = wg.Id_Worker inner join users u on u.Id_User = w.Id_User WHERE wg.Id_Game = $id";
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
    $game = "All Game";
    $query = "SELECT * FROM workers w inner join users u on u.Id_User = w.Id_User";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $workers = $stmt->get_result();
}

?>
