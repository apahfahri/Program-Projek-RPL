<?php
    include('connection.php');

    $query_game = "SELECT * FROM game";

    $stmt_game = $conn->prepare($query_game);

    $stmt_game->execute();

    $game = $stmt_game->get_result();
    
?>
