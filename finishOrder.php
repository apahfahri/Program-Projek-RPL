<?php
session_start();
include('../Smurfer/Server/connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_order = $_POST['id_order'];
    $target_dir = "uploads/results/";
    $target_file = $target_dir . basename($_FILES["result_image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $check = getimagesize($_FILES["result_image"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    if ($_FILES["result_image"]["size"] > 5000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";

    } else {
        if (move_uploaded_file($_FILES["result_image"]["tmp_name"], $target_file)) {
            $query = "UPDATE `order` SET Result = ?, Status = 'Done' WHERE Id_Order = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param('si', $target_file, $id_order);

            if ($stmt->execute()) {
                $_SESSION['success'] = "Order finished successfully.";
                header("Location: workerPage.php");
            } else {
                echo "Sorry, there was an error updating your order.";
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
} else {
    header("Location: workerPage.php");
}
?>
