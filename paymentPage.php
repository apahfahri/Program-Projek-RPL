<?php
session_start();
include('layout/header.php');
include('server/connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['order_id'])) {
    $order_id = $_POST['order_id'];

    $query = "SELECT o.Id_Order, u.Username, g.Nama_Game, g.Image, r1.rank as Initial_Rank, r2.rank as Final_Rank, o.Total_Price, o.Status
              FROM `order` o
              INNER JOIN workers w ON o.Id_Worker = w.Id_Worker
              INNER JOIN users u ON w.Id_User = u.Id_User
              INNER JOIN game g ON o.Id_Game = g.Id_Game
              INNER JOIN rank r1 ON o.initial_rank = r1.Point AND g.Id_Game = r1.Id_Game
              INNER JOIN rank r2 ON o.final_rank = r2.Point AND g.Id_Game = r2.Id_Game
              WHERE o.Id_Order = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $order_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $order = $result->fetch_assoc();
    } else {
        $order = null;
    }
} else {
    // Redirect to a different page or show an error message
    echo "No order ID provided.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="text-white" style="background-color: #37496F;">
    <section class="mb-2">
        <div class="container">
            <div class="card bg-dark text-white">
                <div class="card-body">
                    <form action="payment.php" method="POST" enctype="multipart/form-data">
                        <div class="row d-flex justify-content-center pb-3">
                            <div class="col-md-7 col-xl-5 mb-4 mb-md-0">
                                <div class="py-4 d-flex flex-row">
                                    <h5><span class="far fa-check-square pe-2"></span><b>Smurfer</b> |</h5>
                                    <span class="ps-2">Payment</span>
                                </div>
                                <h4 class="text-success">Rp. <?php echo $order ? number_format($order['Total_Price'], 0) : ''; ?></h4>
                                <h4><?php echo $order ? htmlspecialchars($order['Nama_Game']) : 'No order found'; ?></h4>
                                <hr class="border-light" />

                                <div class="pt-2">
                                    <div class="d-flex pb-2">
                                        <div>
                                            <p><b>Please Choose One Payment Method</b></p>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row pb-3">
                                        <div class="d-flex align-items-center pe-2">
                                            <input class="form-check-input" type="radio" name="payment_method" id="radioNoLabel1" value="Gopay" aria-label="..." checked />
                                        </div>
                                        <div class="rounded border d-flex w-100 p-3 align-items-center">
                                            <p class="mb-0"><i class="fab fa-cc-visa fa-lg text-primary pe-2"></i>Gopay</p>
                                            <div class="ms-auto">1234567890123</div>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row pb-3">
                                        <div class="d-flex align-items-center pe-2">
                                            <input class="form-check-input" type="radio" name="payment_method" id="radioNoLabel2" value="Dana" aria-label="..." />
                                        </div>
                                        <div class="rounded border d-flex w-100 p-3 align-items-center">
                                            <p class="mb-0"><i class="fab fa-cc-mastercard fa-lg text-body pe-2"></i>Dana</p>
                                            <div class="ms-auto">1234567890123</div>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row pb-3">
                                        <div class="d-flex align-items-center pe-2">
                                            <input class="form-check-input" type="radio" name="payment_method" id="radioNoLabel3" value="BCA" aria-label="..." />
                                        </div>
                                        <div class="rounded border d-flex w-100 p-3 align-items-center">
                                            <p class="mb-0"><i class="fab fa-cc-mastercard fa-lg text-body pe-2"></i>BCA</p>
                                            <div class="ms-auto">1234567890123</div>
                                        </div>
                                    </div>
                                    <div class="mb-0">
                                        <label for="transaction_proof" class="form-label">Upload Proof of Transaction</label>
                                        <input class="form-control" type="file" id="transaction_proof" name="transaction_proof" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-5 col-xl-4 offset-xl-1">
                                <div class="py-4 d-flex justify-content-end">
                                    <h6><a href="/myOrder.php" class="text-white">Cancel and return to website</a></h6>
                                </div>

                                <div class="mb-3">
                                    <label for="game_username" class="form-label">Game Username</label>
                                    <input type="text" class="form-control" id="game_username" name="game_username" required>
                                </div>
                                <div class="mb-3">
                                    <label for="game_password" class="form-label">Game Password</label>
                                    <input type="password" class="form-control" id="game_password" name="game_password" required>
                                </div>
                                <hr class="border-light" />

                                <div class="rounded d-flex flex-column p-2 bg-secondary text-white">
                                    <div class="p-2 me-3">
                                        <h4>Order Recap</h4>
                                    </div>
                                    <div class="p-2 d-flex">
                                        <div class="col-8"><?php echo $order['Initial_Rank']; ?> -> <?php echo $order['Final_Rank']; ?></div>
                                        <div class="ms-auto">Rp.<?php echo $order ? number_format($order['Total_Price'], 0) : ''; ?></div>
                                    </div>
                                    <div class="border-top border-light px-2 mx-2"></div>
                                    <div class="p-2 d-flex pt-3">
                                        <div class="col-8"><b>Total</b></div>
                                        <div class="ms-auto"><b class="text">Rp.<?php echo $order ? number_format($order['Total_Price'], 0) : ''; ?></b></div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary mt-3">Submit Payment</button>
                            </div>
                        </div>
                        <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
