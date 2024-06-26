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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styleIndex.css">
    <title>Document</title>
</head>

<body>
    <div class="container-fluid pb-3 mb-3">
        <div class="bg-body-tertiary shadow">
            <div id="carouselGamePage" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active" data-bs-interval="10000">
                        <img src="image/crsl01.jpg" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item" data-bs-interval="5000">
                        <img src="image/crsl02.jpg" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="image/crsl03.jpg" class="d-block w-100" alt="...">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselGamePage" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselGamePage" data-bs-slide="next">
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
                    <div class="content">
                        <a href="<?php echo "workerSelect.php?game=" . $row['Id_Game']; ?>">
                            <div class="content-overlay">

                            </div>
                            <img class="content-image" src="asset/game/<?php echo $row['Nama_Game'] ?>.jpeg">
                            <div class="content-details fadeIn-bottom">
                                <h3 class="content-title"><?php echo $row['Nama_Game'] ?></h3>
                            </div>
                        </a>
                    </div>

                </div>
            <?php } ?>
        </div>
    </div>

</body>

</html>