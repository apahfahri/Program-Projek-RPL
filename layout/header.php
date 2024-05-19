<!DOCTYPE html>
<html lang="en">

<head>
  <title>Website Saya</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<nav class="navbar navbar-expand-lg bg-dark navbar-dark nav-underline shadow mb-3">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="./asset/smurfer/logo.png" alt="Logo" width="125" class="d-inline-block align-text-top ml-4">
    </a>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav mt-1">
        <li class="nav-item">
          <a class="nav-link" href="index.php" style="font-size: large;">Game</a>
        </li>
      </ul>
      <ul class="navbar-nav justify-content-end">
        <li class="nav-item mr-3">
        </li>
      </ul>
      <form class="d-flex ms-auto p-2" role="profile">
        <?php
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) { ?>
          <div class="d-flex align-items-center">
            <div class="flex-shrink-0 dropdown-lg">
              <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="./image/<?php echo $_SESSION['foto'] ?>" alt="mdo" width="32" height="32" class="rounded-circle">
              </a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark text-small shadow p-2">
                <li class="d-flex flex-row align-items-center">
                  <div class="col m-2">
                    <img src="./image/<?php echo $_SESSION['foto'] ?>" alt="mdo" width="42" height="42" class="rounded-circle">
                  </div>
                  <div class="col m-2">
                    <h5 class="text-light mb-0"><?php echo $_SESSION['username'] ?></h5>
                    <p class="text-light mb-0"><?php echo $_SESSION['email'] ?></p>
                    <p class="text-light mb-0"><?php echo $_SESSION['status'] ?></p>
                  </div>
                </li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item text-light" href="#">My Order</a></li>
                <li><a class="dropdown-item text-light" href="#">Settings</a></li>
                <li><a class="dropdown-item text-light" href="profilePage.php">Profile</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item text-light" href="logout.php">Sign out</a></li>
              </ul>
            </div>
          </div>
        <?php } else {
          echo '<a class="btn btn-primary" href="loginPage.php">Login</a>';
        }
        ?>
      </form>

    </div>
  </div>
</nav>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</body>

</html>