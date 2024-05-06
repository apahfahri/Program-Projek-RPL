<?php
session_start();
include('layout/header.php')
?>

<?php
include('server/connection.php');

if (isset($_GET['game'])) {
    $game = $_GET['game'];
    $query = "SELECT * FROM workers_game wg inner join workers w on w.Id_Worker = wg.Id_Worker inner join users u on u.Id_User = w.Id_User WHERE wg.Id_Game = $game";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $workers = $stmt->get_result();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>

    <div class="container-lg">
        <div class="row">
            <?php while ($row = $workers->fetch_assoc()) { ?>
                <div class="col-sm-4 mb-4">
                    <div class="card">
                        <img src="image/<?php echo $row['Foto'] ?>.jpeg" class="card-img-top" alt="gambar">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['Username'] ?></h5>
                            <p class="card-text">Rating : <?php echo $row['Rating'] ?></p>
                            <a href="#" class="btn btn-primary">Order</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

</body>

</html>