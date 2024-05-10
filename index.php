<?php
session_start();

include('Server/game.php');
include('layout/header.php')
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>

    <div class="container-fluid pb-3">
        <div class="d-grid gap-3" style="grid-template-columns: 1fr 2fr;">
            <div class="bg-body-tertiary border rounded-3">
                <br><br><br><br><br><br><br><br><br><br>
            </div>
            <div class="bg-body-tertiary border rounded-3">
                <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active" data-bs-interval="10000">
                            <img src="asset/game/Valorant.jpeg" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item" data-bs-interval="2000">
                            <img src="asset/game/Counter Strike 2.jpeg" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="asset/game/League Of Legends.jpeg" class="d-block w-100" alt="...">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Game Section -->
    <div class="container-lg">
        <div class="row">
            <?php while ($row = $game->fetch_assoc()) { ?>
                <div class="col-sm-4 mb-4">
                    <div class="card">
                        <a href="<?php echo "workerSelect.php?game=" . $row['Id_Game']; ?>" style="text-decoration: none; text-align: center; color: black;">
                            <img class="card-img-top" src="asset/game/<?php echo $row['Nama_Game'] ?>.jpeg" alt="Card image cap">
                            <h5 class="card-title"><?php echo $row['Nama_Game'] ?></h5>
                        </a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

</body>

</html>