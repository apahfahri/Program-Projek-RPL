<?php
// Koneksi ke database
include('server/connection.php');

// Query SQL untuk mengambil data perubahan rank
$sql = "SELECT Point, Price FROM rank";
$result = $conn->query($sql);

// Simpan data perubahan rank ke dalam array
$perubahanRank = array();
while ($row = $result->fetch_assoc()) {
    $perubahanRank[$row['Point']] = $row['Price'];
}
?>
