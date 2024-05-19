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
                        <div class="card-body ">
                            <h5 class="card-title"><?php echo $row['Username'] ?></h5>
                            <p class="card-text"> <span style="color: yellow;"><i class="fa-regular fa-star"></i></span>
                                <?php echo $row['Rating'] ?></p>
                            <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) { ?>
                                <button type="button" class="btn btn-primary orderButton" data-bs-toggle="modal" data-bs-target="#orderModal" data-idWorker="<?= $row['Id_Worker'] ?>" data-idGame="<?php $_GET['game'] ?>"><i class="fa-solid fa-file-contract"></i> Order</button>
                            <?php } else { ?>
                                <button type="button" wclass="btn btn-primary" onclick="showAlert()"> <i class="fa-solid fa-file-contract"></i> Order</button>
                            <?php } ?>
                            <a href="#" class="btn btn-warning"> <i class="fa-regular fa-address-card"></i> Profile</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <?php
    // Mendapatkan data initial rank
    $initialRanks = $ranks->fetch_all(MYSQLI_ASSOC);

    // Mengembalikan pointer baris ke awal
    $ranks->data_seek(0);

    // Mendapatkan data final rank
    $finalRanks = $ranks->fetch_all(MYSQLI_ASSOC);
    ?>

    <!-- Modal Order -->
    <div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <input type="hidden" name="id_worker" id="Id_Worker">
                <input type="hidden" name="id_game" id="Id_Game">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="orderModalLabel">Order</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Name:</label>
                            <input type="text" class="form-control" id="Username" value='<?php echo $_SESSION['username'] ?>' disabled>
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Game:</label>
                            <input type="text" class="form-control" id="Game" value='<?php echo $game ?>' disabled>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="message-text" class="col-form-label">Initial Rank:</label>
                                    <select class="form-select" aria-label="Default select example" name="initial" id="initialRank">
                                        <option selected>Select Rank</option>
                                        <?php foreach ($initialRanks as $row) { ?>
                                            <option value="<?php echo $row['Point'] ?>"><?php echo $row['Rank'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="message-text" class="col-form-label">Final Rank:</label>
                                    <select class="form-select" aria-label="Default select example" name="final" id="finalRank">
                                        <option selected>Select Rank</option>
                                        <?php foreach ($finalRanks as $row) { ?>
                                            <option value="<?php echo $row['Point'] ?>"><?php echo $row['Rank'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Price:</label>
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
                    <button type="button" class="btn btn-primary">Order</button>
                </div>
            </div>
        </div>
    </div>

</body>

</html>

<script>
    function showAlert() {
        Swal.fire({
            title: "Not logged in yet?",
            text: "Need to login for order",
            icon: "question"
        });
    }
</script>

<script>
    const perubahanRank = <?php echo json_encode($perubahanRank); ?>;
    const initialRankSelect = document.getElementById('initialRank');
    const finalRankSelect = document.getElementById('finalRank');

    // Event listener untuk menangani peristiwa saat opsi rank dipilih
    initialRankSelect.addEventListener('change', calculatePrice);
    finalRankSelect.addEventListener('change', calculatePrice);

    // Fungsi untuk menghitung harga berdasarkan rank yang dipilih
    function calculatePrice() {
        const initialRank = parseInt(initialRankSelect.value);
        const finalRank = parseInt(finalRankSelect.value);

        // Hitung perbedaan rank
        const rankDifference = Math.abs(finalRank - initialRank);

        // Hitung total harga berdasarkan perbedaan rank
        let totalPrice = 0;
        for (let i = Math.min(initialRank, finalRank) + 1; i <= Math.max(initialRank, finalRank); i++) {
            if (perubahanRank[i]) {
                totalPrice += parseInt(perubahanRank[i]);
            }
        }

        // Tampilkan harga pada input
        document.getElementById('priceInput').value = totalPrice;
    }
</script>


