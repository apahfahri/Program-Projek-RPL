<?php
session_start();
include('./server/connection.php');

if (isset($_SESSION['logged_in'])) {
    header('location: adminPage.php');
    exit;
}

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM admin WHERE username = ? AND password = ? LIMIT 1";

    $stmt_login = $conn->prepare($query);
    $stmt_login->bind_param('ss', $username, $password);

    if ($stmt_login->execute()) {
        $stmt_login->bind_result(
            $id,
            $username,
            $password
        );
        $stmt_login->store_result();

        if ($stmt_login->num_rows() == 1) {
            $stmt_login->fetch();

            $_SESSION['id_user'] = $id;
            $_SESSION['username'] = $username;
            $_SESSION['logged_in'] = true;
                
            header('location: adminPage.php?message=Logged in succesfully');
        } else {
            header('location: loginAdmin.php?error=Cound not verify your account');
        }
    } else {
        header('location: loginAdmin.php?error=Something went wrong!');
    }
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
<body>
    <div class="container mt-4">
        <div class="container-fluid">
            <form autocomplete="off" id="login-form" method="POST" action="loginAdmin.php">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Insert Username or Email">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Insert Password">
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
        </div>
    </div>
</body>
</html>