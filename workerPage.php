<?php
session_start();
include('layout/header.php');
include('server/connection.php');

$query = "SELECT o.Id_Order, 
                 c_u.Username as Customer_Username, 
                 g.Nama_Game, 
                 g.Image, 
                 r1.rank as Initial_Rank, 
                 r2.rank as Final_Rank, 
                 o.Total_Price, 
                 o.Status
          FROM `order` o
          INNER JOIN workers w ON o.Id_Worker = w.Id_Worker
          INNER JOIN users c_u ON o.Id_User = c_u.Id_User
          INNER JOIN game g ON o.Id_Game = g.Id_Game
          INNER JOIN rank r1 ON o.initial_rank = r1.Point AND g.Id_Game = r1.Id_Game
          INNER JOIN rank r2 ON o.final_rank = r2.Point AND g.Id_Game = r2.Id_Game
          WHERE o.Id_Worker = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $_SESSION['id_user']);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/styleIndex.css">
</head>

<body>
    <div class="container mt-5">
        <h5>My Orders</h5>

        <div class="row">
            <?php while ($row = $result->fetch_assoc()) { ?>
                <div class="col-12 mb-3">
                    <div class="card h-100 card text-bg-dark">
                        <div class="row g-0">
                            <div class="col-md-4">
                                <img src="./asset/game/<?php echo $row['Image']; ?>" class="img-fluid rounded-start" alt="Game Image" style="height: 100%; object-fit: cover;">
                            </div>
                            <div class="col-md-8 d-flex flex-column">
                                <div class="card-body d-flex flex-column">
                                    <p class="card-text">Customer: <?php echo $row['Customer_Username']; ?></p>
                                    <p class="card-text">Rank: <?php echo $row['Initial_Rank']; ?> -> <?php echo $row['Final_Rank']; ?></p>
                                    <p class="card-text">Status: <?php echo $row['Status']; ?></p>
                                    <div class="mt-auto d-flex justify-content-between align-items-center w-100">
                                        <div>
                                            <?php if ($row['Status'] == 'Pending') { ?>
                                                <form action="acceptOrder.php" method="POST">
                                                    <input type="hidden" name="order_id" value="<?php echo $row['Id_Order']; ?>">
                                                    <button type="submit" class="btn btn-primary btn-sm">Accept</button>
                                                </form>
                                                <form action="declineOrder.php" method="POST">
                                                    <input type="hidden" name="order_id" value="<?php echo $row['Id_Order']; ?>">
                                                    <button type="submit" class="btn btn-danger btn-sm">Decline</button>
                                                </form>
                                            <?php } else { ?>
                                                <button class="btn btn-secondary btn-sm" disabled>Cancel</button>
                                            <?php } ?>
                                        </div>
                                        <p class="card-text mb-0">Total Price: Rp.<?php echo $row['Total_Price']; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</body>

</html>