<?php
session_start();
include('server/connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $order_id = $_POST['order_id'];
    $review = $_POST['review'];
    $rating = $_POST['rating'];

    $query = "UPDATE `order` SET Review = ?, Rating = ? WHERE Id_Order = ?";
    $stmt = $conn->prepare($query);

    $stmt->bind_param('sii', $review, $rating, $order_id);

    if ($stmt->execute()) {
        header('Location: myOrder.php?success=1');
        exit();
    } else {
        header('Location: myOrder.php?error=1');
        exit();
    }
} else {
    header('Location: myOrders.php');
    exit();
}
?>
