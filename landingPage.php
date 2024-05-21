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
                    <div class="carousel-item" data-bs-interval="2000">
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
                <h1 class="display-4 fw-bold lh-1 text-white">Border hero with cropped image and shadows</h1>
                <p class="lead text-light">Quickly design and customize responsive mobile-first sites with Bootstrap, the world’s most popular front-end open source toolkit, featuring Sass variables and mixins, responsive grid system, extensive prebuilt components, and powerful JavaScript plugins.</p>

            </div>
            <div class="col-lg-4 offset-lg-1 p-0 overflow-hidden shadow-lg">
                <img class="rounded-lg-3" src="asset/backgroun-login.jpeg" alt="" width="720">
            </div>
        </div>
    </div>

    <div class="container px-4 py-5" id="hanging-icons">
        <h2 class="pb-2 text-light border-bottom">Features</h2>
        <div class="row g-4 py-4 row-cols-1 row-cols-lg-3">
            <div class="col d-flex align-items-start">
                
                <div>
                    <h3 class="fs-2 text-white">Joki game rank up</h3>
                    <p class="text-white-50">Paragraph of text beneath the heading to explain the heading. We'll add onto it with another sentence and
                        probably just keep going until we run out of words.</p>
                    <a href="#" class="btn btn-primary">
                        Primary button
                    </a>
                </div>
            </div>
            <div class="col d-flex align-items-start">
                
                <div>
                    <h3 class="fs-2 text-white">Dapat menjadi joki</h3>
                    <p class="text-white-50">Paragraph of text beneath the heading to explain the heading. We'll add onto it with another sentence and
                        probably just keep going until we run out of words.</p>
                    <a href="#" class="btn btn-primary">
                        Primary button
                    </a>
                </div>
            </div>
            <div class="col d-flex align-items-start">
                
                <div>
                    <h3 class="fs-2 text-white">Joki game rank up</h3>
                    <p class="text-white-50">Paragraph of text beneath the heading to explain the heading. We'll add onto it with another sentence and
                        probably just keep going until we run out of words.</p>
                    <a href="#" class="btn btn-primary">
                        Primary button
                    </a>
                </div>
            </div>

        </div>
    </div>

</body>

</html>