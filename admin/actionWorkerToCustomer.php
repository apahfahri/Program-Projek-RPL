<?php
include('../server/connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['customerId'])) {
        $id_user = $_POST['customerId'];

        try {
            $conn->begin_transaction();

            $update_query = "UPDATE users SET status = 'Customer', Foto = 'default2.jpg' WHERE Id_User = ?";
            $stmt = $conn->prepare($update_query);
            $stmt->bind_param('i', $id_user);
            $stmt->execute();

            $delete_query = "DELETE FROM workers WHERE Id_User = ?";
            $stmt = $conn->prepare($delete_query);
            $stmt->bind_param('i', $id_user);
            $stmt->execute();

            $conn->commit();
            header("Location: dashboard.php");
            exit();
        } catch (Exception $e) {
            $conn->rollback();
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "Invalid input";
    }
} else {
    echo "Invalid request method";
}
?>
