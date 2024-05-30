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
        $query = "
            UPDATE workers w
            JOIN (
                SELECT Id_Worker, AVG(Rating) AS avg_rating
                FROM `order`
                GROUP BY Id_Worker
            ) o ON w.Id_Worker = o.Id_worker
            SET w.rating = o.avg_rating;
        ";

        if ($conn->query($query) === TRUE) {
            echo "Ratings updated successfully.";
        } else {
            echo "Error updating ratings: " . $conn->error;
        }

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
