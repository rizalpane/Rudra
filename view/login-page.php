<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'component/head.php' ?>
</head>

<body class="body">


    <div class="row row-cols-1 row-cols-lg-2 g-0 vh-100  ">
        <div class="col  shadow container my-auto  ">
            <div class="p-5">
                <h2 class="text-primary fw-bold">Login</h2>
                <p class="text-sm">Silahkan Login dengan Username dan Password yang sesuai</p>

                <form action="../app/config/controller.php" method="post">
                    <div class="mb-3">
                        <label for="login" class="form-label">Username</label>
                        <input type="email" class="form-control form-control-sm " id="login" name="email" placeholder="example@gmail.com" required>
                        <div class="valid-feedback">
                            Email Telah Sesuai
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input name="password" type="password" class="form-control form-control-sm " placeholder="*********" required>
                        <div class="valid-feedback">
                            Password Telah Sesuai
                        </div>
                    </div>

                    <button name="postLogin" type="submit" class="btn btn-primary btn-sm">Login</button>
                </form>

                <p class="mt-3 text-center"> Lupa Password? <a class="link-underline link-underline-opacity-0 fw-bold" href="auth/forgot-password.php">Klik Disini</a> </p>
            </div>

        </div>
    </div>

</body>

</html>