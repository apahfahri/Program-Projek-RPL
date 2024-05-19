<?php
include('server/connection.php');
session_start();

if (isset($_POST['initial']) && isset($_POST['final'])) {
    $Id_User = $_SESSION['Id_user'];
    $Id_Worker = $_POST['id_worker'];
    $Id_Game = $_POST['id_game'];
    $total_price = $_POST['price'];
    $initial = $_POST['initial'];
    $final = $_POST['final'];
    $message = $_POST['message'];

    $query = "INSERT INTO order values (null, $Id_User, $Id_Worker, $Id_Game, $total_price, $initial, $final, $message)";
    $result = mysqli_query($conn, $query);
}
?>