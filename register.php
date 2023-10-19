<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/main.css" />
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.css" />
    <script src="node_modules/bootstrap/dist/js/bootstrap.js"></script>
</head>

<body class="body">


    <div class="row row-cols-1 row-cols-lg-2 g-0 vh-100  ">
        <div class="col  shadow container my-auto  ">
            <div class="p-5">
                <h2 class="text-primary fw-bold">Register</h2>
                <p class="text-sm">Silahkan Isi Data Diri anda dengan Benar dan Lengkap</p>

                <form action="app/config/controller.php" method="post">
                    <div class="mb-3">
                        <label for="name" class="form-label">Username</label>
                        <input type="text" class="form-control form-control-sm " id="name" name="name" placeholder="nama lengkap" required>
                        <div class="valid-feedback">
                            Email Telah Sesuai
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control form-control-sm " id="email" name="email" placeholder="example@gmail.com" required>
                        <div class="valid-feedback">
                            Email Telah Sesuai
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="grade" class="form-label">Kelas</label>
                        <select class="form-control" name="id_grade" id="grade">
                            <?php
                            $grades = ['10'];
                            $gradeValues = ['1'];
                            foreach ($grades as $key => $grade) :
                            ?>
                                <option value="<?= $gradeValues[$key] ?>"><?= $grade ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="major" class="form-label">Jurusan</label>
                        <select class="form-control" name="id_major" id="major">
                            <?php
                            $majors = ['TKJ'];
                            $majorValues = ['2'];
                            foreach ($majors as $key => $major) :
                            ?>
                                <option value="<?= $majorValues[$key] ?>"><?= $major ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input name="password" type="password" class="form-control form-control-sm " placeholder="*********" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Harus berisi setidaknya satu angka dan satu huruf besar dan huruf kecil, dan setidaknya 8 karakter atau lebih" required>
                        <div class="valid-feedback">
                            Password Telah Sesuai
                        </div>
                    </div>

                    <input type="hidden" name="group" value="student">

                    <button name="postRegister" type="submit" class="btn btn-primary btn-sm">Login</button>
                </form>

                <p class="mt-3 text-center"> Lupa Password? <a class="link-underline link-underline-opacity-0 fw-bold" href="auth/forgot-password.php">Klik Disini</a> </p>
            </div>

        </div>
    </div>

</body>

</html>