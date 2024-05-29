<?php
session_start();
include('../server/connection.php');

$query = 
    "SELECT 'Customer' AS Status, COUNT(*) AS count FROM users WHERE Status = 'Customer'
    UNION ALL
    SELECT 'Worker', COUNT(*) FROM users WHERE Status = 'Worker'
    UNION ALL
    SELECT 'Order', COUNT(*) FROM `Order` WHERE Status != 'Declined' && Status != 'Canceled'
    UNION ALL
    SELECT 'Profit', SUM(Total_Price) FROM `Order` WHERE Status_Payment = 'Paid'";

$stmt = $conn->prepare($query);
$stmt->execute();
$stmt->bind_result($status, $count);

// Mengambil hasil
$counts = [];
while ($stmt->fetch()) {
    $counts[] = ['status' => $status, 'count' => $count];
}
$stmt->close();

header('Content-Type: application/json');
echo json_encode($counts);
?>
