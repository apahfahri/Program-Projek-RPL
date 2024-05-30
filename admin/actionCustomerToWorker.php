<?php
include('../server/connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['customer_id']) && isset($_POST['game_id'])) {
        $id_user = $_POST['order_id'];
        $id_game = $_POST['game_id'];

        try {
            $conn->begin_transaction();

            $update_query = "UPDATE users SET status = 'Worker', Foto = 'profile.jpe    g' WHERE Id_User = ?";
            $stmt = $conn->prepare($update_query);
            $stmt->bind_param('i', $id_user);
            $stmt->execute();

            $insert_query = "INSERT INTO workers (Id_User, Id_Game) VALUES (?, ?)";
            $stmt = $conn->prepare($insert_query);
            $stmt->bind_param('ii', $id_user, $id_game);
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

