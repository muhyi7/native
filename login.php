<?php
require('koneksi.php');

session_start();

if (isset($_POST['submit'])) {
    $email = $_POST['txt_email'];
    $pass = $_POST['txt_pass'];

    if (!empty(trim($email)) && !empty(trim($pass))) {
        $emailCheck = mysqli_real_escape_string($koneksi, $email);
        $passCheck = mysqli_real_escape_string($koneksi, $pass);

        $query = "SELECT * FROM user_detail WHERE user_email = '$emailCheck'";
        $result = mysqli_query($koneksi, $query);
        $num = mysqli_num_rows($result);

        if ($num != 0) {
            $row = mysqli_fetch_array($result);
            $userVal = $row['user_email'];
            $passVal = $row['user_password'];
            $userName = $row['user_fullname'];
            $level = $row['level'];

            if ($userVal == $emailCheck && $passVal == $passCheck && $level == '1') {
                $_SESSION['user_fullname'] = $userName;
                $_SESSION['user_level'] = $level;

                // Set cookie dengan masa berlaku 1 jam jika "ingat saya" dicentang
                if (isset($_POST['remember_me']) && $_POST['remember_me'] == '1') {
                    setcookie("user_fullname", $userName, time() + 3600, "/");
                    setcookie("user_level", $level, time() + 3600, "/");
                }
                header("Location: home.php");
                exit; // login admin
            } 
            if ($userVal == $emailCheck && $passVal == $passCheck && $level == '2') {
                $_SESSION['user_fullname'] = $userName;
                $_SESSION['user_level'] = $level;

                // Set cookie dengan masa berlaku 1 jam jika "ingat saya" dicentang
                if (isset($_POST['remember_me']) && $_POST['remember_me'] == '1') {
                    setcookie("user_fullname", $userName, time() + 3600, "/");
                    setcookie("user_level", $level, time() + 3600, "/");
                }
                header("Location: home_user.php");
                exit; // login user
            }    
        } else {
            $error = 'User tidak ditemukan!!';
        }
    } else {
        $error = 'Data tidak boleh kosong !!';
    }

    if (isset($error)) {
        echo '<div class="alert alert-danger">' . $error . '</div>';
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Login Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Login</div>
                    <div class="card-body">
                        <form action="login.php" method="POST">
                            <div class="form-group">
                                <label for="txt_email">Email:</label>
                                <input type="text" class="form-control" id="txt_email" name="txt_email">
                            </div>
                            <div class="form-group">
                                <label for="txt_pass">Password:</label>
                                <input type="password" class="form-control" id="txt_pass" name="txt_pass">
                            </div>
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="remember_me" name="remember_me" value="1">
                                <label class="form-check-label" for="remember_me">Ingat Saya</label>
                            </div>
                            <button type="submit" class="btn btn-primary" name="submit">Log In</button>
                        </form>
                    </div>
                    <div class="card-footer">
                        <p class="mb-0">Belum punya akun? <a href="register.php">Daftar</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
