<?php
session_start();
include('server/connection.php');
include('layout/header.php');

$id = $_SESSION['id_user'];

$query = "SELECT o.Id_Order,cus.Username as Customer,u.Username as Worker,
g.Nama_Game,o.Total_Price,r1.rank as Initial_Rank,r2.rank as Final_Rank,o.Message,o.Status,g.Image
FROM `order` o
INNER JOIN users cus ON o.Id_User = cus.Id_User
INNER JOIN workers w ON o.Id_Worker = w.Id_Worker
INNER JOIN users u ON w.Id_User = u.Id_User
INNER JOIN game g ON o.Id_Game = g.Id_Game
INNER JOIN rank r1 ON o.initial_rank = r1.Point AND g.Id_Game = r1.Id_Game
INNER JOIN rank r2 ON o.final_rank = r2.Point AND g.Id_Game = r2.Id_Game";

$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->get_result();
$stmt->close();

$query2 =
    "SELECT 'Customer' AS Status, COUNT(*) AS count FROM users WHERE Status = 'Customer'
    UNION ALL
    SELECT 'Worker', COUNT(*) FROM users WHERE Status = 'Worker'
    UNION ALL
    SELECT 'Order', COUNT(*) FROM `Order` where Id_User = $id";
$stmt2 = $conn->prepare($query2);
$stmt2->execute();
$stmt2->bind_result($status, $count);

$counts = [];
while ($stmt2->fetch()) {
    $counts[$status] = $count;
}
$stmt2->close();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Profil Pengguna</title>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styleIndex.css">
    <style>
        .img-fluid {
            max-width: 100%;
            height: auto;
        }

        .card {
            margin-bottom: 30px;
        }

        .overflow-hidden {
            overflow: hidden !important;
        }

        .p-0 {
            padding: 0 !important;
        }

        .mt-n5 {
            margin-top: -3rem !important;
        }

        .linear-gradient {
            background-image: linear-gradient(#50b2fc, #354265);
        }

        .rounded-circle {
            border-radius: 50% !important;
        }

        .align-items-center {
            align-items: center !important;
        }

        .justify-content-center {
            justify-content: center !important;
        }

        .d-flex {
            display: flex !important;
        }

        .rounded-2 {
            border-radius: 7px !important;
        }

        /* .bg-light-info {
            --bs-bg-opacity: 1;
            background-color: rgba(235, 243, 254, 1) !important;
        } */

        .card {
            margin-bottom: 30px;
        }

        .position-relative {
            position: relative !important;
        }

        .shadow-none {
            box-shadow: none !important;
        }

        .overflow-hidden {
            overflow: hidden !important;
        }

        .border {
            border: 0px solid #ebf1f6 !important;
        }

        .fs-6 {
            font-size: 1.25rem !important;
        }

        .mb-2 {
            margin-bottom: 0.5rem !important;
        }

        .d-block {
            display: block !important;
        }

        a {
            text-decoration: none;
        }

        .user-profile-tab .nav-item .nav-link.active {
            color: #5d87ff;
            border-bottom: 2px solid #5d87ff;
        }

        .mb-9 {
            margin-bottom: 20px !important;
        }

        .fw-semibold {
            font-weight: 600 !important;
        }

        .fs-4 {
            font-size: 1rem !important;
        }

        .card,
        .bg-light {
            box-shadow: 0 20px 27px 0 rgb(0 0 0 / 5%);
        }

        .fs-2 {
            font-size: .75rem !important;
        }

        .rounded-4 {
            border-radius: 4px !important;
        }

        .ms-7 {
            margin-left: 30px !important;
        }
    </style>
</head>

<body>
    <div class="container bg-dark p-0 border rounded">
        <div class="card border overflow-hidden shadow">
            <div class="card-body bg-dark p-0">
                <img src="image/crsl03.jpg" alt="" class="img-fluid">
                <div class="row align-items-center">
                    <div class="col-lg-4 order-lg-1 order-2">
                        <div class="mt-n5">
                            <div class="d-flex align-items-center justify-content-center mb-2">
                                <div class="linear-gradient d-flex align-items-center justify-content-center rounded-circle" style="width: 110px; height: 110px;" ;="">
                                    <div class="d-flex align-items-center justify-content-center rounded-circle overflow-hidden" style="width: 100px; height: 100px;" ;="">
                                        <img src="image/profile.jpeg" alt="" class="w-100 h-100">
                                    </div>
                                </div>
                            </div>
                            <div class="text-center text-light">
                                <h5 class="fs-5 mb-2 mt-3 fw-bold"><?php echo $_SESSION['username'] ?></h5>
                                <p class="mb-0 fs-4"><?php echo $_SESSION['email'] ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 mt-n3 order-lg-2 order-1">
                        <div class="d-flex align-items-center justify-content-around m-4">
                            <div class="text-center text-white">
                                <i class="fa fa-file fs-6 d-block mb-2"></i>
                                <h4 class="mb-0 fw-semibold lh-1"><?php echo $counts['Order'] ?></h4>
                                <p class="mb-0 fs-4">Orders</p>
                            </div>
                            <button class="btn btn-primary">Join to be Worker</button>
                        </div>
                    </div>
                    <div class="col-lg-4 order-first d-flex justify-content-center">
                    </div>
                </div>
                <ul class="nav nav-pills user-profile-tab justify-content-start mt-2 bg-light-info rounded-2" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link position-relative rounded-0 active d-flex align-items-center justify-content-center bg-transparent fs-3 py-6" id="pills-order-tab" data-bs-toggle="pill" data-bs-target="#pills-order" type="button" role="tab" aria-controls="pills-order" aria-selected="true">
                            <i class="fa fa-user me-2 fs-6"></i>
                            <span class="d-none d-md-block">Order</span>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-6" id="pills-review-tab" data-bs-toggle="pill" data-bs-target="#pills-review" type="button" role="tab" aria-controls="pills-review" aria-selected="false" tabindex="-1">
                            <i class="fa fa-heart me-2 fs-6"></i>
                            <span class="d-none d-md-block">Review</span>
                        </button>
                    </li>
                </ul>
            </div>
        </div>

        <div class="container">
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-order" role="tabpanel" aria-labelledby="pills-order-tab" tabindex="0">
                    <div class="d-sm-flex align-items-center justify-content-between mt-3 mb-4">
                        <h3 class="mb-3 mb-sm-0 fw-semibold text-white d-flex align-items-center">Order<span class="badge text-bg-secondary fs-2 rounded-4 py-1 px-2 ms-2"><?php echo $counts['Order'] ?></span></h3>
                        
                    </div>
                    <div class="row">
                        <?php while ($row = $result->fetch_assoc()) { ?>
                        <div class=" col-md-6 col-xl-4">
                            <div class="card bg-secondary shadow">
                                <div class="card-body p-4 d-flex align-items-center gap-3">
                                    <img src="asset/logo_game/<?php echo $row['Image'] ?>" alt="" class="object-fit-sm-cover border rounded" width="100px" height="100px">
                                    <div>
                                        <h5 class="fw-bold mb-2 text-white"><?php echo $row['Nama_Game'] ?></h5>
                                        <p class="fw-light text-white mb-0">Worker: <?php echo $row['Worker'] ?></p>
                                        <p class="fw-light text-white mb-0">Price: <?php echo $row['Total_Price'] ?></p>
                                        <p class="fw-light text-white mb-0">Message: <?php echo $row['Message'] ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade show active" id="pills-review" role="tabpanel" aria-labelledby="pills-review-tab" tabindex="0">
                <div class="d-sm-flex align-items-center justify-content-between mt-3 mb-4">
                <h3 class="mb-3 mb-sm-0 fw-semibold text-white d-flex align-items-center">Review<span class="badge text-bg-secondary fs-2 rounded-4 py-1 px-2 ms-2"><?php echo $counts['Order'] ?></span></h3>
                    <form class="position-relative">
                        <input type="text" class="form-control search-chat py-2 ps-5" id="text-srh" placeholder="Search Review">
                        <i class="ti ti-search position-absolute top-50 start-0 translate-middle-y text-dark ms-3"></i>
                    </form>
                </div>
                <div class="row">
                    <div class=" col-md-6 col-xl-4">
                        <div class="card">
                            <div class="card-body p-4 d-flex align-items-center gap-3">
                                <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="" class="rounded-circle" width="40" height="40">
                                <div>
                                    <h5 class="fw-semibold mb-0 text-black">Betty Adams</h5>
                                    <span class="fs-2 d-flex align-items-center"><i class="ti ti-map-pin text-dark fs-3 me-1"></i>Sint Maarten</span>
                                </div>
                                <button class="btn btn-outline-primary py-1 px-2 ms-auto">Follow</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- JS Bootstrap -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>