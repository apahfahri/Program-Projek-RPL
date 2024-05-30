<?php
session_start();
include('server/connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['order_id'])) {
        $order_id = $_POST['order_id'];

        // Update order status to 'accepted'
        $query = "UPDATE `order` SET status = 'Declined' WHERE Id_Order = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $order_id);
        if ($stmt->execute()) {
            header('Location: workerPage.php?success=successfully rejected the order');
        } else {
            header('Location: workerPage.php?failed=Failed rejected the order');
        }
        $stmt->close();
    }
}
exit();
?>