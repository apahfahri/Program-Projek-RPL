<?php
session_start();
include('server/connection.php');

if (isset($_SESSION['logged_in'])) {
    header('location: index.php');
    exit;
}

if (isset($_POST['username']) && isset($_POST['password'])) {
    $email = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT u.Id_User, u.username, u.email, u.password, u.status, u.foto, w.Id_Worker 
              FROM users u 
              LEFT JOIN workers w ON w.Id_User = u.Id_User 
              WHERE (u.username = ? OR u.email = ?) AND u.password = ? 
              LIMIT 1";

    $stmt_login = $conn->prepare($query);
    $stmt_login->bind_param('sss', $email, $email, $password);

    if ($stmt_login->execute()) {
        $stmt_login->store_result();

        if ($stmt_login->num_rows() == 1) {
            $stmt_login->bind_result($id_user, $username, $email, $password, $status, $foto, $id_worker);
            $stmt_login->fetch();

            $_SESSION['id_user'] = $id_user;
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            $_SESSION['status'] = $status;
            $_SESSION['foto'] = $foto;
            $_SESSION['logged_in'] = true;

            if ($id_worker !== null) {
                $_SESSION['id_worker'] = $id_worker;
            }

            if ($status == 'Customer') {
                header('location: landingPage.php?message=Logged in successfully');
            } else {
                header('location: workerPage.php?message=Logged in successfully');
            }
            exit;
        } else {
            header('location: loginPage.php?error=Could not verify your account');
            exit;
        }
    } else {
        header('location: loginPage.php?error=Something went wrong!');
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="css/styleLogin.css">
    <script src="https://kit.fontawesome.com/5f166431bc.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <section>
        <?php if (isset($_GET["error"])) { ?>
            <script>
                Swal.fire({
                    title: "Failed!",
                    text: "Could Not Verify Your Account!",
                    icon: "error"
                });
            </script>
        <?php } ?>
        <div class="box">
            <div class="form-value">
                <form autocomplete="off" id="login-form" method="POST" action="loginPage.php">
                    <h2>Login</h2>
                    <div class="input">
                        <input type="text" class="form-control" id="username" name="username" placeholder="" required>
                        <i class="fa-solid fa-envelope"></i>
                        <label for="username" class="form-label">Username or Email</label>
                    </div>
                    <div class="input">
                        <input type="password" class="form-control" id="password" name="password" placeholder="" required>
                        <i class="fa-solid fa-lock"></i>
                        <label for="password" class="form-label">Password</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                    <div class="register">
                        <p>Don't Have an Account? <a href="registerPage.php">Sign Up</a></p>
                    </div>
                </form>
            </div>
        </div>
    </section>
</body>

</html>