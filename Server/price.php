<?php
include('server/connection.php');
$sql = "SELECT Point, Price FROM rank where Id_Game = $id";
$result = $conn->query($sql);

$perubahanRank = array();
while ($row = $result->fetch_assoc()) {
    $perubahanRank[$row['Point']] = $row['Price'];
}
?>
