<?php
include('../server/connection.php');

$data = json_decode(file_get_contents('php://input'), true);


if (isset($data['id'])) {
    $orderId = $data['id'];
    
    $query = "UPDATE `order` SET Status = 'In Progress', Status_Payment = 'Paid' WHERE Id_Order = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $orderId);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['success' => false]);
}
?>
