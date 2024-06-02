<?php
session_start();
include('layout/header.php');
include('server/connection.php');

$query = "SELECT * FROM game g inner join workers w on w.Id_Game = g.Id_Game inner join users u on u.Id_User = w.Id_User";
$stmt = $conn->prepare($query);
$stmt->execute();
$workers = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="css/styleIndex.css">
    <script src="https://kit.fontawesome.com/5f166431bc.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5+zdwu/YgBbB5TN7EYLlvdjF83ttsI4va/CV6P1N" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container-lg">
        <div class="row mb-3">
            <h5>All Worker: </h5>
        </div>
        <div class="row">
            <?php while ($row = $workers->fetch_assoc()) { ?>
                <div class="col-sm-4 mb-4">
                    <div class="card text-bg-dark shadow scale">
                        <img src="image/<?php echo $row['Foto'] ?>" class="card-img-top" alt="gambar">
                        <div class="card-body">
                            <h5 class="card-title mb-3"><?php echo $row['Username'] ?></h5>
                            <a href="profileWorkerPage.php?id=<?php echo $row['Id_Worker'] ?>" class="btn btn-warning"> <i class="fa-regular fa-address-card"></i> Profile</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</body>

</html>