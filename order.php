<?php
include('server/connection.php');
session_start();

if (isset($_POST['initial']) && isset($_POST['final'])) {
    $Id_User = $_POST['id_user'];
    $Id_Worker = $_POST['id_worker'];
    $Id_Game = $_POST['id_game'];
    $total_price = $_POST['price'];
    $initial = $_POST['initial'];
    $final = $_POST['final'];
    $message = $_POST['message'];

    $Id_User = mysqli_real_escape_string($conn, $Id_User);
    $Id_Worker = mysqli_real_escape_string($conn, $Id_Worker);
    $Id_Game = mysqli_real_escape_string($conn, $Id_Game);
    $total_price = mysqli_real_escape_string($conn, $total_price);
    $initial = mysqli_real_escape_string($conn, $initial);
    $final = mysqli_real_escape_string($conn, $final);
    $message = mysqli_real_escape_string($conn, $message);

    $query = "INSERT INTO `order` (Id_User, Id_Worker, Id_Game, total_price, initial_rank, final_rank, message) VALUES (?, ?, ?, ?, ?, ?, ?)";
    
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("iiiiiis", $Id_User, $Id_Worker, $Id_Game, $total_price, $initial, $final, $message);
        $stmt->execute();
        $stmt->close();
    
        header("Location: myOrder.php?success");
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
}
?>
