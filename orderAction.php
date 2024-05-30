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
    $current_date = date('Y-m-d H:i:s'); 

    $Id_User = mysqli_real_escape_string($conn, $Id_User);
    $Id_Worker = mysqli_real_escape_string($conn, $Id_Worker);
    $Id_Game = mysqli_real_escape_string($conn, $Id_Game);
    $total_price = mysqli_real_escape_string($conn, $total_price);
    $initial = mysqli_real_escape_string($conn, $initial);
    $final = mysqli_real_escape_string($conn, $final);
    $message = mysqli_real_escape_string($conn, $message);

    $query = "INSERT INTO `order` (Id_User, Id_Worker, Id_Game, total_price, initial_rank, final_rank, message, date) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    
    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("iiiiiiss", $Id_User, $Id_Worker, $Id_Game, $total_price, $initial, $final, $message, $current_date);
        $stmt->execute();
        $stmt->close();
    
        header("Location: myOrder.php?success=Successfully placed an order!");
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
}
?>
