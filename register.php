<?php
require('koneksi.php');
if (isset($_POST['register'])) {
    $userMail = $_POST['txt_email'];
    $userPass = $_POST['txt_pass'];
    $userName = $_POST['txt_nama'];

    $query = "INSERT INTO user_detail (user_email, user_password, user_fullname, level) VALUES (?, ?, ?, 2)";
    $stmt = mysqli_prepare($koneksi, $query);
    mysqli_stmt_bind_param($stmt, "sss", $userMail, $userPass, $userName);
    
    if (mysqli_stmt_execute($stmt)) {
        header('Location: login.php');
        exit;
    } else {
        $error = 'Gagal melakukan registrasi: ' . mysqli_error($koneksi);
    }
}
?>

?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Register</div>
                    <div class="card-body">
                        <form action="register.php" method="POST">
                            <div class="form-group">
                                <label for="txt_email">Email:</label>
                                <input type="text" class="form-control" id="txt_email" name="txt_email" required>
                            </div>
                            <div class="form-group">
                                <label for="txt_pass">Password:</label>
                                <input type="password" class="form-control" id="txt_pass" name="txt_pass" required>
                            </div>
                            <div class="form-group">
                                <label for="txt_nama">Nama:</label>
                                <input type="text" class="form-control" id="txt_nama" name="txt_nama" required>
                            </div>
                            <button type="submit" class="btn btn-primary" name="register">Register</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <p class="text-center mt-3"><a href="login.php">Sudah punya akun? Login di sini.</a></p>
</body>
</html>
