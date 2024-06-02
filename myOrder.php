<?php
session_start();
include('layout/header.php');
include('server/connection.php');

$query = "SELECT o.Id_Order, u.Username, g.Nama_Game, g.Image, r1.rank as Initial_Rank, r2.rank as Final_Rank, o.Total_Price, o.Status, o.Status_Payment, o.Result, o.Rating
          FROM `order` o
          INNER JOIN workers w ON o.Id_Worker = w.Id_Worker
          INNER JOIN users u ON w.Id_User = u.Id_User
          INNER JOIN game g ON o.Id_Game = g.Id_Game
          INNER JOIN rank r1 ON o.initial_rank = r1.Point AND g.Id_Game = r1.Id_Game
          INNER JOIN rank r2 ON o.final_rank = r2.Point AND g.Id_Game = r2.Id_Game
          WHERE o.Id_User = ?";
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
    <?php if (isset($_GET["success"])) { ?>
        <script>
            Swal.fire({
                title: "Success!",
                text: "<?php echo $_GET["success"]?>",
                icon: "success"
            });
        </script>
    <?php } else if (isset($_GET["failed"])) { ?>
        <script>
            Swal.fire({
                title: "Failed!",
                text: "<?php echo $_GET["failed"]?>",
                icon: "error"
            });
        </script>
    <?php } ?>

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
                                    <p class="card-text">Worker: <?php echo $row['Username']; ?></p>
                                    <p class="card-text">Rank: <?php echo $row['Initial_Rank']; ?> -> <?php echo $row['Final_Rank']; ?></p>
                                    <p class="card-text">Status: <?php echo $row['Status']; ?></p>
                                    <div class="mt-auto d-flex justify-content-between align-items-center w-100">
                                        <div>
                                            <?php if ($row['Status'] == 'Pending') { ?>
                                                <form action="cancelOrder.php" method="POST" style="display:inline;">
                                                    <input type="hidden" name="order_id" value="<?php echo $row['Id_Order']; ?>">
                                                    <button type="submit" class="btn btn-danger btn-sm">Cancel</button>
                                                </form>
                                            <?php } else if ($row['Status'] == 'Accepted' && $row['Status_Payment'] == 'Unpaid') { ?>
                                                <form action="paymentPage.php" method="POST" style="display:inline;">
                                                    <input type="hidden" name="order_id" value="<?php echo $row['Id_Order']; ?>">
                                                    <button type="submit" class="btn btn-primary btn-sm">Make Payment</button>
                                                </form>
                                                <form action="cancelOrder.php" method="POST" style="display:inline;">
                                                    <input type="hidden" name="order_id" value="<?php echo $row['Id_Order']; ?>">
                                                    <button type="submit" class="btn btn-danger btn-sm">Cancel</button>
                                                </form>
                                            <?php } else if ($row['Status'] == 'Done' && $row['Rating'] == 0) { ?>
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalReview" data-result="<?php echo $row['Result']; ?>" data-id="<?php echo $row['Id_Order']; ?>">Review</button>
                                            <?php } ?>
                                        </div>
                                        <p class="card-text mb-0">Total Price: Rp.<?php echo $row ? number_format($row['Total_Price'], 0) : ''; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <div class="modal fade" id="modalReview" tabindex="-1" data-bs-backdrop="static" aria-labelledby="modalReviewLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="ReviewLabel">Review Order</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="reviewForm" action="reviewOrder.php" method="POST">
                        <input type="hidden" id="orderId" name="order_id">
                        <img id="resultImage" src="" alt="Result Order" class="img-fluid mb-3">
                        <div class="mb-3">
                            <label for="reviewText" class="form-label">Testimony</label>
                            <textarea class="form-control" id="reviewText" name="review" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="rating" class="form-label">Rating</label>
                            <div class="star-rating" id="rating">
                                <input id="star-5" type="radio" name="rating" value="5" required>
                                <label for="star-5" title="5 stars">
                                    <i class="fas fa-star"></i>
                                </label>
                                <input id="star-4" type="radio" name="rating" value="4" required>
                                <label for="star-4" title="4 stars">
                                    <i class="fas fa-star"></i>
                                </label>
                                <input id="star-3" type="radio" name="rating" value="3" required>
                                <label for="star-3" title="3 stars">
                                    <i class="fas fa-star"></i>
                                </label>
                                <input id="star-2" type="radio" name="rating" value="2" required>
                                <label for="star-2" title="2 stars">
                                    <i class="fas fa-star"></i>
                                </label>
                                <input id="star-1" type="radio" name="rating" value="1" required>
                                <label for="star-1" title="1 star">
                                    <i class="fas fa-star"></i>
                                </label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var modalReview = document.getElementById('modalReview');

        modalReview.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var result = button.getAttribute('data-result');
            var orderId = button.getAttribute('data-id');

            document.getElementById('orderId').value = orderId;
            document.getElementById('resultImage').src = '/Smurfer/' + result;
        });

        var reviewForm = document.getElementById('reviewForm');

        reviewForm.addEventListener('submit', function(event) {
            var ratingChecked = document.querySelector('input[name="rating"]:checked');
            if (!ratingChecked) {
                event.preventDefault();
                alert('Please select a rating.');
            }
        });
    });
</script>

</html>