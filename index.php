<?php
include('Server/game.php');
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

    <!-- Navbar -->

    <!-- Game Section -->
    <div class="container-lg">
        <div class="row">
            <?php while ($row = $game->fetch_assoc()) { ?>
                    <div class="col-sm-4 mb-4">
                        <div class="card">
                            <a href="<?php echo "workerSelect.php?game=" . $row['Nama_Game']; ?>" style="text-decoration: none; text-align: center; color: black;">
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