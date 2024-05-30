<?php
session_start();
include('layout/header.php');
include('server/connection.php');
include('Server/worker.php');
include('Server/ranks.php');
include('Server/price.php');
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
            <h5>Game: <?php echo $game ?></h5>
        </div>
        <div class="row">
            <?php while ($row = $workers->fetch_assoc()) { ?>
                <div class="col-sm-4 mb-4">
                    <div class="card text-bg-dark shadow scale">
                        <img src="image/<?php echo $row['Foto'] ?>" class="card-img-top" alt="gambar">
                        <div class="card-body">
                            <h5 class="card-title mb-3"><?php echo $row['Username'] ?></h5>
                            <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) { ?>
                                <button type="button" class="btn btn-primary orderButton" data-bs-toggle="modal" data-bs-target="#orderModal" data-idWorker="<?= $row['Id_Worker'] ?>" data-idGame="<?php echo $_GET['game'] ?>" data-idUser='<?php echo $_SESSION['id_user'] ?>'><i class="fa-solid fa-file-contract"></i> Order</button>
                            <?php } else { ?>
                                <button type="button" class="btn btn-primary" onclick="showAlert()"> <i class="fa-solid fa-file-contract"></i> Order</button>
                            <?php } ?>
                            <a href="profileWorkerPage.php?id=<?php echo $row['Id_Worker'] ?>" class="btn btn-warning"> <i class="fa-regular fa-address-card"></i> Profile</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <?php
    $initialRanks = $ranks->fetch_all(MYSQLI_ASSOC);
    $ranks->data_seek(0);
    $finalRanks = $ranks->fetch_all(MYSQLI_ASSOC);
    ?>

    <!-- Modal Order -->
    <div class="modal fade" id="orderModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="orderModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="orderModalLabel">Order</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="orderForm" action="orderAction.php" method="POST">
                        <input type="hidden" name="id_worker" id="Id_Worker">
                        <input type="hidden" name="id_game" id="Id_Game">
                        <input type="hidden" name="id_user" id="Id_User">
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Name:</label>
                            <input type="text" class="form-control" id="Username" value='<?php echo $_SESSION['username'] ?>' disabled>
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Game:</label>
                            <input type="text" class="form-control" id="Game" value='<?php echo $game ?>' disabled>
                        </div>

                        <!-- Select Rank Game Tier -->
                        <div class="row rank-tier">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="initialRank" class="col-form-label">Initial Rank:</label>
                                    <select class="form-select" aria-label="Default select example" name="initial" id="initialRank">
                                        <option selected value="">Select Rank</option>
                                        <?php foreach ($initialRanks as $row) { ?>
                                            <option value="<?php echo $row['Point'] ?>"><?php echo $row['Rank'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="finalRank" class="col-form-label">Final Rank:</label>
                                    <select class="form-select" aria-label="Default select example" name="final" id="finalRank">
                                        <option selected value="">Select Rank</option>
                                        <?php foreach ($finalRanks as $row) { ?>
                                            <option value="<?php echo $row['Point'] ?>"><?php echo $row['Rank'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Select Rank Game Rating -->
                        <div class="row rank-rating">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="initialRating" class="col-form-label">Initial Rating:</label>
                                    <input type="range" class="form-range" min="0" max="20000" step="1000" id="initialRange">
                                    <span id="initialRangeValue">0</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="finalRating" class="col-form-label">Final Rating:</label>
                                    <input type="range" class="form-range" min="0" max="20000" step="1000" id="finalRange">
                                    <span id="finalRangeValue">0</span>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="priceInput" class="col-form-label">Price:</label>
                            <input type="text" class="form-control" id="priceInput" name="price" disabled>
                        </div>

                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Message:</label>
                            <textarea class="form-control" id="message-text" name="message"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" onclick="submitOrderForm()">Order</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<script>
    // notifikasi belum login//
    function showAlert() {
        Swal.fire({
            title: "Not logged in yet?",
            text: "Need to login for order",
            icon: "question"
        });
    }

    // memindahkan data id worker, game, user //
    $(document).on('click', '.orderButton', function() {
        const idWorker = $(this).data('idworker');
        const idGame = $(this).data('idgame');
        const idUser = $(this).data('iduser');
        $('#Id_Worker').val(idWorker);
        $('#Id_Game').val(idGame);
        $('#Id_User').val(idUser);
        if (idGame == 3 || idGame == 4) {
            $('.rank-tier').hide();
            $('.rank-rating').show();
        } else {
            $('.rank-tier').show();
            $('.rank-rating').hide();
        }
        $('#orderModal').modal('show');
    });

    // menghapus data jika tidak jadi mengisi form//
    function resetForm() {
        document.getElementById('initialRank').selectedIndex = 0;
        document.getElementById('finalRank').selectedIndex = 0;
        document.getElementById('priceInput').value = '';
    }

    // untuk mengecek apakah sudah benar sebelum submit order//
    function submitOrderForm() {
        const initialRank = document.getElementById('initialRank').value;
        const finalRank = document.getElementById('finalRank').value;
        const price = document.getElementById('priceInput').value;

        if (!initialRank || !finalRank || !price) {
            Swal.fire({
                title: "Error!",
                text: "Please fill all required fields",
                icon: "error"
            });
            return;
        }

        document.getElementById('priceInput').disabled = false;
        document.getElementById('orderForm').submit();
    }

    const orderModal = new bootstrap.Modal(document.getElementById('orderModal'));
    document.getElementById('orderModal').addEventListener('hidden.bs.modal', resetForm);

    // perhitungan harga//
    const perubahanRank = <?php echo json_encode($perubahanRank); ?>;
    const initialRankSelect = document.getElementById('initialRank');
    const finalRankSelect = document.getElementById('finalRank');

    initialRankSelect.addEventListener('change', calculatePrice);
    finalRankSelect.addEventListener('change', calculatePrice);

    function calculatePrice() {
        const initialRank = parseInt(initialRankSelect.value);
        const finalRank = parseInt(finalRankSelect.value);

        if (!initialRank || !finalRank) {
            document.getElementById('priceInput').value = '';
            return;
        }

        const rankDifference = Math.abs(finalRank - initialRank);
        let totalPrice = 0;

        for (let i = Math.min(initialRank, finalRank) + 1; i <= Math.max(initialRank, finalRank); i++) {
            if (perubahanRank[i]) {
                totalPrice += parseInt(perubahanRank[i]);
            }
        }

        document.getElementById('priceInput').value = totalPrice;
    }

    document.addEventListener('DOMContentLoaded', (event) => {
        const initialRange = document.getElementById('initialRange');
        const initialRangeValue = document.getElementById('initialRangeValue');
        const finalRange = document.getElementById('finalRange');
        const finalRangeValue = document.getElementById('finalRangeValue');

        // Set initial values
        initialRangeValue.textContent = initialRange.value;
        finalRangeValue.textContent = finalRange.value;

        // Update values on input change
        initialRange.addEventListener('input', function() {
            initialRangeValue.textContent = this.value;
        });

        finalRange.addEventListener('input', function() {
            finalRangeValue.textContent = this.value;
        });
    });
</script>