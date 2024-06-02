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

    <div class="container bg-dark my-5">
        <div class="row p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center border-dark shadow-lg">
            <div class="col-lg-7 p-3 p-lg-5 pt-lg-3">
                <h1 class="display-4 fw-bold lh-1 text-white">Rank Boosting Platform</h1>
                <p class="lead text-light">You can increase your rank without any effort here. By providing lots of games and lots of worker, Smurfer will help you to become a real gamer</p>

            </div>
            <div class="col-lg-4 offset-lg-1 p-0 overflow-hidden shadow-lg">
                <img class="rounded-lg-3" src="asset/backgroun-login.jpeg" alt="" width="720">
            </div>
        </div>
    </div>

    <!-- <div class="container px-4 py-5" id="features">
        <h2 class="pb-2 text-light border-bottom">Features</h2>
        <div class="row g-4 py-4 row-cols-1 row-cols-lg-3">
            <div class="col d-flex align-items-start"> 
                <div>
                    <a href="index.php" class="btn btn-dark pb-0 mb-2">
                        <h3 class="fs-2 text-white">Can to Order Service</h3>
                    </a>
                    <p class="text-white-50">If you are tired of losing all the time playing games, you should order our worker to increase your rank. so you just drink coffee and wait effortless</p>
                </div>
            </div>
            <div class="col d-flex align-items-start">
                <div>
                    <a href="index.php" class="btn btn-dark pb-0 mb-2">
                        <h3 class="fs-2 text-white">View Worker's Profile</h3>
                    </a>
                    <p class="text-white-50">Here you can find the specifications of our workers. <br>You can see the worker's profile when you want to order a worker for you</p>
                </div>
            </div>
            <div class="col d-flex align-items-start">
                <div>
                    <a href="index.php" class="btn btn-dark pb-0 mb-2">
                        <h3 class="fs-2 text-white">Available to be a Worker</h3>
                    </a>
                    <p class="text-white-50">If you feel good at playing the game, that's our jockey. We have provided a place for you, then you can get the results yourself</p>
                </div>
            </div>

        </div>
    </div> -->

    <div class="container px-4 py-5" id="features">
        <h2 class="pb-2 text-light border-bottom">Features</h2>
        <div class="row g-4 py-4 row-cols-1 row-cols-lg-3">
            <div class="col d-flex align-items-start">
                <div>
                    <h3 class="fs-2 text-white">Can to Order Service</h3>
                    <p class="text-white-50">If you are tired of losing all the time playing games, you should order our worker to increase your rank. so you just drink coffee and wait effortless</p>
                    <a href="index.php" class="btn btn-primary">
                        Order
                    </a>
                </div>
            </div>
            <div class="col d-flex align-items-start">

                <div>
                    <h3 class="fs-2 text-white">View Worker's Profile</h3>
                    <p class="text-white-50">Here you can find the specifications of our workers. <br>You can see the worker's profile when you want to order a worker for you</p>
                    <a href="#" class="btn btn-primary">
                        Worker
                    </a>
                </div>
            </div>
            <div class="col d-flex align-items-start">
                <div>
                    <h3 class="fs-2 text-white">Available to be a Worker</h3>
                    <p class="text-white-50">If you feel good at playing the game, that's our jockey. We have provided a place for you, then you can get the results yourself</p>
                    <a href="https://wa.link/ygcguz" class="btn btn-primary">
                        Join to Workers
                    </a>
                </div>
            </div>

        </div>
    </div>

</body>

</html>