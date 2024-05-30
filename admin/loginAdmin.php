<?php
session_start();
include('../server/connection.php');

if (isset($_SESSION['logged_in'])) {
    header('Location: dashboard.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $query = "SELECT id_admin, username FROM admin WHERE username = ? AND password = ? LIMIT 1";

        if ($stmt = $conn->prepare($query)) {
            $stmt->bind_param('ss', $username, $password);

            if ($stmt->execute()) {
                $stmt->store_result();

                if ($stmt->num_rows == 1) {
                    $stmt->bind_result($id, $username);
                    $stmt->fetch();

                    $_SESSION['id_user'] = $id;
                    $_SESSION['username'] = $username;
                    $_SESSION['logged_in'] = true;

                    header('Location: dashboard.php?message=Logged in successfully');
                } else {
                    header('Location: loginAdmin.php?error=Could not verify your account');
                }
            } else {
                header('Location: loginAdmin.php?error=Something went wrong!');
            }
            $stmt->close();
        } else {
            header('Location: loginAdmin.php?error=Failed to prepare statement!');
        }
    } else {
        header('Location: loginAdmin.php?error=Please fill both fields');
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Mazer Admin Dashboard</title>
    <link rel="shortcut icon" href="/Smurfer/dist/assets/compiled/svg/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon" href="data:image/png;base64,...(long data uri truncated for brevity)" type="image/png">
    <link rel="stylesheet" href="/Smurfer/dist/assets/compiled/css/app.css">
    <link rel="stylesheet" href="/Smurfer/dist/assets/compiled/css/app-dark.css">
    <link rel="stylesheet" href="/Smurfer/dist/assets/compiled/css/auth.css">
</head>

<body>
    <script src="assets/static/js/initTheme.js"></script>
    <div id="auth">
        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="auth-logo">
                        <a href="index.html"><img src="/Smurfer/asset/smurfer/logo.png" alt="Logo"></a>
                    </div>
                    <h1 class="auth-title">Log in.</h1>
                    <p class="auth-subtitle mb-5">Log in with your data that you entered during registration.</p>
                    <form action="loginAdmin.php" method="POST">
                        <div class="form-group position-relative has-icon-left mb-3">
                            <input type="text" name="username" class="form-control form-control-xl" placeholder="Username" required>
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-2">
                            <input type="password" name="password" class="form-control form-control-xl" placeholder="Password" required>
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-4">Log in</button>
                    </form>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">
                </div>
            </div>
        </div>
    </div>
</body>
</html>
