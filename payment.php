<?php
session_start();
include('server/connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $order_id = $_POST['order_id'];
    $payment_method = $_POST['payment_method'];
    $game_username = $_POST['game_username'];
    $game_password = $_POST['game_password'];
    $proof_transaction = '';

    if (isset($_FILES['transaction_proof']) && $_FILES['transaction_proof']['error'] == 0) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES['transaction_proof']['name']);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        if ($_FILES['transaction_proof']['size'] > 5000000) { 
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES['transaction_proof']['tmp_name'], $target_file)) {
                $proof_transaction = $target_file;
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        echo "No file uploaded or there was an upload error.";
    }

    if ($proof_transaction != '') {
        $query = "UPDATE `order` SET Status = 'Waiting Payment Confirmation', Payment_Method = ?, Proof_Transaction = ?, Game_Username = ?, Game_Password = ? WHERE Id_Order = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ssssi', $payment_method, $proof_transaction, $game_username, $game_password, $order_id);

        if ($stmt->execute()) {
            header('location: myOrder.php?success');
        } else {
            echo "Error: " . $stmt->error;
        }
    }
} else {
    echo "Invalid request.";
}

$conn->close();
?>
