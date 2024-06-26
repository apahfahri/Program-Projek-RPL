<?php
session_start();
include('server/connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['order_id'])) {
        $order_id = $_POST['order_id'];

        // Update order status to 'accepted'
        $query = "UPDATE `order` SET status = 'Canceled' WHERE Id_Order = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $order_id);
        if ($stmt->execute()) {
            header('Location: myOrder.php?success=Successfully cancel an order!');
        } else {
            header('Location: myOrder.php?failed=Failed cancel an order! Try Again');
        }
        $stmt->close();
    }
}
exit();
?>