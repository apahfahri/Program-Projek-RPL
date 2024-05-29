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
                 o.Status,
                 o.Message,
                 o.Game_Username,
                 o.Game_Password
          FROM `order` o
          INNER JOIN workers w ON o.Id_Worker = w.Id_Worker
          INNER JOIN users c_u ON o.Id_User = c_u.Id_User
          INNER JOIN game g ON o.Id_Game = g.Id_Game
          INNER JOIN rank r1 ON o.initial_rank = r1.Point AND g.Id_Game = r1.Id_Game
          INNER JOIN rank r2 ON o.final_rank = r2.Point AND g.Id_Game = r2.Id_Game
          WHERE o.Id_Worker = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $_SESSION['id_worker']);
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
    <script src="https://kit.fontawesome.com/5f166431bc.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/styleIndex.css">
</head>

<body>
    <div class="container mt-5">
        <h5>Your Jobs</h5>
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
                                                <form action="acceptOrder.php" method="POST" style="display:inline;">
                                                    <input type="hidden" name="order_id" value="<?php echo $row['Id_Order']; ?>">
                                                    <button type="submit" class="btn btn-primary btn-sm">Accept</button>
                                                </form>
                                                <form action="declineOrder.php" method="POST" style="display:inline;">
                                                    <input type="hidden" name="order_id" value="<?php echo $row['Id_Order']; ?>">
                                                    <button type="submit" class="btn btn-danger btn-sm">Decline</button>
                                                </form>
                                            <?php } else if ($row['Status'] == 'In Progress') { ?>
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#detailModal" data-message="<?php echo htmlspecialchars($row['Message']); ?>" data-game-username="<?php echo htmlspecialchars($row['Game_Username']); ?>" data-game-password="<?php echo htmlspecialchars($row['Game_Password']); ?>"> Details</button>
                                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#finishOrderModal-<?php echo $row['Id_Order']; ?>">Finish</button>
                                            <?php } ?>
                                        </div>
                                        <p class="card-text mb-0">Total Price: Rp.<?php echo $row['Total_Price']; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Finish Order -->
                <div class="modal fade" id="finishOrderModal-<?php echo $row['Id_Order']; ?>" tabindex="-1" aria-labelledby="finishOrderLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="finishOrderLabel">Finish Order</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="finishOrder.php" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="id_order" value="<?php echo $row['Id_Order']; ?>">
                                    <div class="mb-3">
                                        <label for="result_image" class="form-label">Upload Result Image</label>
                                        <input type="file" class="form-control" id="result_image" name="result_image" required>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary">Finish Order</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            <?php } ?>
        </div>
    </div>

    <!-- Modal Detail -->
    <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Detail Order</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="messageInput" class="form-label">Message</label>
                        <input type="text" class="form-control" id="messageInput" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="gameUsernameInput" class="form-label">Game Username</label>
                        <input type="text" class="form-control" id="gameUsernameInput" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="gamePasswordInput" class="form-label">Game Password</label>
                        <input type="text" class="form-control" id="gamePasswordInput" disabled>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var detailModal = document.getElementById('detailModal');

        detailModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var message = button.getAttribute('data-message');
            var gameUsername = button.getAttribute('data-game-username');
            var gamePassword = button.getAttribute('data-game-password');

            var messageInput = detailModal.querySelector('#messageInput');
            var gameUsernameInput = detailModal.querySelector('#gameUsernameInput');
            var gamePasswordInput = detailModal.querySelector('#gamePasswordInput');

            messageInput.value = message;
            gameUsernameInput.value = gameUsername;
            gamePasswordInput.value = gamePassword;
        });
    });
</script>