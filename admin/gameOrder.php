<?php
include('connection.php'); 

$query = "
    SELECT 
        id_game,
        MONTH(order_date) AS month, 
        COUNT(*) AS order_count 
    FROM `order` 
    GROUP BY id_game, MONTH(order_date)
";

$result = $conn->query($query);

$data = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $game_id = $row['id_game'];
        $month = (int)$row['month'] - 1; 
        $order_count = (int)$row['order_count'];
        
        if (!isset($data[$game_id])) {
            $data[$game_id] = array_fill(0, 12, 0);
        }
        
        $data[$game_id][$month] = $order_count;
    }
}

echo json_encode($data);

$conn->close();
?>
