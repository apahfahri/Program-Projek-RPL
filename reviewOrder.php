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
        header('Location: myOrder.php?success=Successfully provided a review');
        exit();
    } else {
        header('Location: myOrder.php?failed=Failed provided a review');
        exit();
    }
} else {
    header('Location: myOrders.php');
    exit();
}
?>
