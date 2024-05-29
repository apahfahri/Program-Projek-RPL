<?php
session_start();
include('../server/connection.php');

$query_users = "SELECT o.Id_Order,cus.Username as Customer,u.Username as Worker,
g.Nama_Game,o.Total_Price,r1.rank as Initial_Rank,r2.rank as Final_Rank,o.Status_Payment,o.Status, o.Payment_Method, o.Proof_Transaction, o.Game_Username, o.Game_Password, o.Message
FROM `order` o
INNER JOIN users cus ON o.Id_User = cus.Id_User
INNER JOIN workers w ON o.Id_Worker = w.Id_Worker
INNER JOIN users u ON w.Id_User = u.Id_User
INNER JOIN game g ON o.Id_Game = g.Id_Game
INNER JOIN rank r1 ON o.initial_rank = r1.Point AND g.Id_Game = r1.Id_Game
INNER JOIN rank r2 ON o.final_rank = r2.Point AND g.Id_Game = r2.Id_Game
WHERE o.Status != 'Declined' && o.Status != 'Canceled'";

$stmt_users = $conn->prepare($query_users);
$stmt_users->execute();
$users = $stmt_users->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Table - Smurfer</title>
    <link rel="stylesheet" href="../dist/assets/compiled/css/app.css">
    <link rel="stylesheet" href="../dist/assets/compiled/css/app-dark.css">
    <script src="https://kit.fontawesome.com/5f166431bc.js" crossorigin="anonymous"></script>
</head>

<body>
    <div id="app">
        <div id="sidebar">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header position-relative">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="logo">
                            <a href="dashboard.php">Smurfer</a>
                        </div>
                        <div class="theme-toggle d-flex gap-2  align-items-center mt-2">
                            <!-- Theme Toggle -->
                        </div>
                        <div class="sidebar-toggler  x">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>
                        <li class="sidebar-item"><a href="dashboard.php" class='sidebar-link'><i class="bi bi-grid-fill"></i><span>Dashboard</span></a></li>
                        <li class="sidebar-item"><a href="tableCustomer.php" class='sidebar-link'><i class="bi bi-people-fill"></i><span>Customers</span></a></li>
                        <li class="sidebar-item"><a href="tableWorker.php" class='sidebar-link'><i class="bi bi-controller"></i><span>Workers</span></a></li>
                        <li class="sidebar-item active"><a href="tableOrder.php" class='sidebar-link'><i class="bi bi-basket3-fill"></i><span>Orders</span></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none"><i class="bi bi-justify fs-3"></i></a>
            </header>
            <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Order Table</h3>
                            <p class="text-subtitle text-muted">All data orders available here</p>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Table</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <section class="section">
                    <div class="row" id="table-striped">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Orders Table</h4>
                                </div>
                                <div class="card-content">
                                    <div class="table-responsive">
                                        <table class="table table-striped mb-0">
                                            <thead>
                                                <tr>
                                                    <th>ID <br> ORDER</th>
                                                    <th>CUSTOMER</th>
                                                    <th>WORKER</th>
                                                    <th>GAME</th>
                                                    <th>TOTAL <br> PRICE</th>
                                                    <th>PAYMENT <br> METHOD</th>
                                                    <th>PAYMENT <br> STATUS</th>
                                                    <th>STATUS</th>
                                                    <th>ACTION</th>
                                                </tr>
                                            </thead>
                                            <?php while ($row = $users->fetch_assoc()) { ?>
                                                <tbody>
                                                    <tr>
                                                        <td class="text-bold-500"><?php echo $row['Id_Order'] ?></td>
                                                        <td><?php echo $row['Customer'] ?></td>
                                                        <td class="text-bold-500"><?php echo $row['Worker'] ?></td>
                                                        <td><?php echo $row['Nama_Game'] ?></td>
                                                        <td><?php echo 'Rp.' . number_format($row['Total_Price'], 0, ',', '.'); ?></td>
                                                        <td><?php echo $row['Payment_Method'] ?></td>
                                                        <td><?php echo $row['Status_Payment'] ?></td>
                                                        <td><?php echo $row['Status'] ?></td>
                                                        <td>
                                                            <?php if ($row['Status'] == 'Waiting Payment Confirmation') { ?>
                                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#confirmationModal" data-id="<?php echo $row['Id_Order']; ?>" data-proof="<?php echo $row['Proof_Transaction']; ?>">
                                                                    <i class="fa-solid fa-comments-dollar"></i>
                                                                </button>
                                                                <br> <br>
                                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#detailModal" data-message="<?php echo htmlspecialchars($row['Message']); ?>" data-game-username="<?php echo htmlspecialchars($row['Game_Username']); ?>" data-game-password="<?php echo htmlspecialchars($row['Game_Password']); ?>">
                                                                    <i class="fa-solid fa-magnifying-glass"></i>
                                                                </button>
                                                            <?php } else { ?>
                                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#detailModal" data-message="<?php echo htmlspecialchars($row['Message']); ?>" data-game-username="<?php echo htmlspecialchars($row['Game_Username']); ?>" data-game-password="<?php echo htmlspecialchars($row['Game_Password']); ?>">
                                                                    <i class="fa-solid fa-magnifying-glass"></i>
                                                                </button>
                                                            <?php } ?>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            <?php } ?>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Modal Confirmation -->
                <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Confirmation Payment</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <img id="proofImage" src="" alt="Proof of Transaction" class="img-fluid">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-primary" id="confirmPaymentButton">Confirm Payment</button>
                            </div>
                        </div>
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

                <footer>
                    <div class="footer clearfix mb-0 text-muted">
                        <div class="float-start">
                            <p>2023 &copy; Smurfer</p>
                        </div>
                        <div class="float-end">
                            <p>Crafted with <span class="text-danger"><i class="bi bi-heart-fill icon-mid"></i></span> by <a href="#">Your Team</a></p>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </div>
    <script src="../dist/assets/static/js/components/dark.js"></script>
    <script src="../dist/assets/extensions/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="../dist/assets/compiled/js/app.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var confirmationModal = document.getElementById('confirmationModal');
            var confirmPaymentButton = document.getElementById('confirmPaymentButton');
            var orderId;

            confirmationModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget;
                var proofTransaction = button.getAttribute('data-proof');
                orderId = button.getAttribute('data-id');
                var proofImage = document.getElementById('proofImage');
                proofImage.src = '/Smurfer/' + proofTransaction;
            });

            confirmPaymentButton.addEventListener('click', function() {
                fetch('actionConfirmPayment.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            id: orderId
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Payment confirmed successfully!');
                            location.reload();
                        } else {
                            alert('Failed to confirm payment. Please try again.');
                        }
                    });
            });
        });
    </script>
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