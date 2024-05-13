<?php
session_start();
include('layout/header.php');
include('server/connection.php');
include('Server/worker.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/5f166431bc.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container-lg">
        <div class="row mb-3">
            <h5>Game: <?php echo $game ?></h5>
        </div>
        <div class="row">
            <?php while ($row = $workers->fetch_assoc()) { ?>
                <div class="col-sm-4 mb-4">
                    <div class="card text-bg-dark shadow scale">
                        <img src="image/<?php echo $row['Foto']?>" class="card-img-top" alt="gambar">
                        <div class="card-body ">
                            <h5 class="card-title"><?php echo $row['Username'] ?></h5>
                            <p class="card-text"> <span style="color: yellow;"><i class="fa-regular fa-star"></i></span> 
                                <?php echo $row['Rating'] ?></p>
                            <a href="#" class="btn btn-primary"><i class="fa-solid fa-file-contract"></i> Order</a>
                            <a href="#" class="btn btn-warning"> <i class="fa-regular fa-address-card"></i> Profile</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</body>


</html>