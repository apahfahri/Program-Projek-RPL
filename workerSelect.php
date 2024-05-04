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
</head>

<body>

    <div class="container-lg">
        <div class="row">
            <?php while ($row = $workers->fetch_assoc()) { ?>
                <div class="col-sm-4 mb-4">
                    <div class="card">
                            <h5 class="card-title"><?php echo $row['Username'] ?></h5>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

</body>

</html>