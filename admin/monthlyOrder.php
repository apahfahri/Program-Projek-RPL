<?php
session_start();
include('../server/connection.php');

$query = "
    SELECT 
        MONTH(date) AS month,
        YEAR(date) AS year,
        COUNT(*) AS order_count
    FROM `order`
    WHERE Status_Payment = 'Paid'
    GROUP BY year, month
    ORDER BY year, month;
";

$stmt = $conn->prepare($query);
$stmt->execute();
$stmt->bind_result($month, $year, $order_count);

$monthlyOrders = array_fill(0, 12, 0);

while ($stmt->fetch()) {
    $monthlyOrders[$month - 1] = $order_count; 
}

$stmt->close();

echo json_encode($monthlyOrders);
?>
