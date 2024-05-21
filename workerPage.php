<?php
session_start();
include('layout/header.php');
include('server/connection.php');

$query = "SELECT o.Id_Order, u.Username, g.Nama_Game, r1.rank as Initial_Rank, r2.rank as Final_Rank, o.Total_Price, o.Status
          FROM `order` o
          INNER JOIN workers w ON o.Id_Worker = w.Id_Worker
          INNER JOIN users u ON w.Id_User = u.Id_User
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
        <h5>Your Jobs</h5>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Worker</th>
                        <th>Game</th>
                        <th>Initial Rank</th>
                        <th>Final Rank</th>
                        <th>Total Price</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo $row['Id_Order']; ?></td>
                            <td><?php echo $row['Username']; ?></td>
                            <td><?php echo $row['Nama_Game']; ?></td>
                            <td><?php echo $row['Initial_Rank']; ?></td>
                            <td><?php echo $row['Final_Rank']; ?></td>
                            <td><?php echo $row['Total_Price']; ?></td>
                            <td><?php echo $row['Status']; ?></td>
                            <td>
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
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
