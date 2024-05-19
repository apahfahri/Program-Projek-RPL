<?php
include 'server/connection.php';
if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $checkQuery = "SELECT * FROM users WHERE Email = '$email' and Username = '$username'";
    $result = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($result) > 0) {
        header("location: registerPage.php?failed=This Email and Username is already Exist!");
    } else {
        $query = "INSERT INTO users (Username, Email, Password) VALUES ('$username', '$email', '$password')";
        mysqli_query($conn, $query);
        header("location: registerPage.php?success=Account created Successfully");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/styleLogin.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <section>
        <?php if (isset($_GET["success"])) { ?>
            <script>
                Swal.fire({
                    title: "Success!",
                    text: "Account Created Successfully",
                    icon: "success"
                });
            </script>
        <?php } ?>
        <?php if (isset($_GET['failed'])) { ?>
            <script>
                Swal.fire({
                    title: "Failed!",
                    text: "This Account is already Exist!",
                    icon: "error"
                });
            </script>
        <?php } ?>
        <div class="box">
            <form autocomplete="off" id="register-form" method="POST" action="registerPage.php">
                <h2>Register</h2>
                <div class="input">
                    <input type="text" class="form-control" id="username" name="username" placeholder="" required>
                    <i class="fa-solid fa-user"></i>
                    <label for="username" class="form-label">Username</label>
                </div>
                <div class="input">
                    <input type="email" class="form-control" id="email" name="email" placeholder="" required>
                    <i class="fa-solid fa-envelope"></i>
                    <label for="email" class="form-label">Email</label>
                </div>
                <div class="input">
                    <input type="password" class="form-control" id="password" name="password" placeholder="" required>
                    <i class="fa-solid fa-lock"></i>
                    <label for="password" class="form-label">Password</label>
                </div>
                <button type="submit" class="btn btn-primary">Register</button>
                <div class="register">
                    <p>Already Have Account? <a href="loginPage.php">Sign In</a></p>
                </div>
            </form>
        </div>
    </section>

</body>

</html>