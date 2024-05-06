<!DOCTYPE html>
<html lang="en">

<head>
  <title>Website Saya</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>

  <nav class="navbar navbar-expand-lg bg-dark navbar-dark mb-3">
    <a class="navbar-brand ml-4" href="#">Smurfer</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav mt-1">
        <li class="nav-item">
          <a class="nav-link" href="#">Game</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Worker</a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item mr-3">
          <?php
          if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) { ?>
            <div class="d-flex align-items-center">
              <div class="flex-shrink-0 dropdown">
                <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                  <img src="https://github.com/mdo.png" alt="mdo" width="32" height="32" class="rounded-circle">
                </a>
                <ul class="dropdown-menu dropdown-menu-end bg-dark text-small shadow">
                  <li><a class="dropdown-item text-light" href="#">New project...</a></li>
                  <li><a class="dropdown-item text-light" href="#">Settings</a></li>
                  <li><a class="dropdown-item text-light" href="../profilePage.php">Profile</a></li>
                  <li>
                    <hr class="dropdown-divider">
                  </li>
                  <li><a class="dropdown-item text-light" href="#">Sign out</a></li>
                </ul>
              </div>
            </div>
          <?php } else {
            echo '<a class="btn btn-primary" href="loginPage.php">Login</a>';
          }
          ?>
        </li>
      </ul>
    </div>
  </nav>

  <div class="container-fluid pb-3">
    <div class="d-grid gap-3" style="grid-template-columns: 1fr 2fr;">
      <div class="bg-body-tertiary border rounded-3">
        <br><br><br><br><br><br><br><br><br><br>
      </div>
      <div class="bg-body-tertiary border rounded-3">
        <br><br><br><br><br><br><br><br><br><br>
      </div>
    </div>
  </div>


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>