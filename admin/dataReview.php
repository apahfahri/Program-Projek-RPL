<?php
include('../server/connection.php');

$query = "SELECT o.Review, u.Username AS Customer_Name, u.Foto
          FROM `order` o
          INNER JOIN users u ON o.Id_User = u.Id_User
          WHERE o.Review IS NOT NULL 
          ORDER BY o.date DESC
          LIMIT 3";

$stmt = $conn->prepare($query);
$stmt->execute();
$stmt->bind_result($review, $customer_name, $foto);

$reviews = [];
while ($stmt->fetch()) {
    $reviews[] = ['review' => $review, 'customer_name' => $customer_name, 'foto' => $foto];
}
$stmt->close();
?>
