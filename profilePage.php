<?php
session_start();
include('layout/header.php')
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profil Pengguna</title>
    <!-- CSS Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="card" style="width: 18rem;">
            <img class="card-img-top" src="foto_pengguna.jpg" alt="Foto Pengguna">
            <div class="card-body">
                <h5 class="card-title">Nama: Budi</h5>
                <p class="card-text">Email: budi@example.com</p>
                <a href="#" class="btn btn-primary">Lihat Profil</a>
            </div>
        </div>
    </div>
    <!-- JS Bootstrap -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
