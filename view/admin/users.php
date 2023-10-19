<?php
include '../../app/config/database.php';
include '../../app/config/filter.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'component/head.php' ?>
</head>

<body>

    <header>
        <?php include 'component/header.php' ?>
    </header>

    <header class="bg-primary">
        <div class="py-3 container ">
            <ul class="nav justify-content-end">
                <li>
                    <button type="button" class="btn text-bg-light btn-sm  me-3 " data-bs-toggle="modal" data-bs-target="#modalAddGrade">
                        Pengguna <i class="bi bi-plus-lg"></i>
                    </button>

                    <div class="modal fade" id="modalAddGrade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Pengguna</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="../../app/config/controller.php" method="post">

                                        <input class="form-control mb-3" type="text" name="name" placeholder="Nama" required>

                                        <input class="form-control mb-3" type="email" name="email" placeholder="Email" required>

                                        <select name="id_grade" class="form-select mb-3">
                                            <?php
                                            $sqlViewGrade = mysqli_query($setDbConfiguration, "SELECT * FROM grade ");
                                            while ($viewGrade = mysqli_fetch_assoc($sqlViewGrade)) :
                                            ?>
                                                <option value="<?= $viewGrade['id_grade'] ?>"> <?= $viewGrade['name_grade'] ?></option>
                                            <?php endwhile; ?>
                                        </select>

                                        <select name="id_major" class="form-select mb-3">
                                            <?php
                                            $sqlViewMajor = mysqli_query($setDbConfiguration, "SELECT * FROM major ");
                                            while ($viewMajor = mysqli_fetch_assoc($sqlViewMajor)) :
                                            ?>
                                                <option value="<?= $viewMajor['id_major'] ?>"> <?= $viewMajor['name_major'] ?></option>
                                            <?php endwhile; ?>
                                        </select>

                                        <input value="student" type="text" name="group" hidden>

                                        <input class="form-control mb-3" type="password" name="password" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Harus berisi setidaknya satu angka dan satu huruf besar dan huruf kecil, dan setidaknya 8 karakter atau lebih" required>

                                        <button name="postAddUser" type="submit" class="btn btn-primary btn-sm">Tambah</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                </li>
                <li><button type="button" class="btn text-bg-light btn-sm me-3 " data-bs-toggle="modal" data-bs-target="#modalViewGrade">
                        Kelas <i class="bi bi-list-ul"></i>
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="modalViewGrade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Kelas</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <table class="table">
                                        <thead>
                                            <th>Kelas</th>
                                            <th>Jenjang</th>
                                        </thead>
                                        <?php
                                        $sqlViewGrade = mysqli_query($setDbConfiguration, "SELECT * FROM grade ");
                                        while ($viewGrade = mysqli_fetch_assoc($sqlViewGrade)) :
                                        ?>
                                            <tbody>
                                                <td><?= $viewGrade['name_grade'] ?></td>
                                                <td><?= $viewGrade['education_levels'] ?></td>

                                            </tbody>
                                        <?php endwhile; ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li><button type="button" class="btn text-bg-light btn-sm me-3 " data-bs-toggle="modal" data-bs-target="#modalViewMajor">
                        jurusan <i class="bi bi-list-ul"></i>
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="modalViewMajor" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Jurusan</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <table class="table">
                                        <thead>
                                            <th>Nama jurusan</th>
                                            <th>Deskripsi</th>
                                        </thead>
                                        <?php
                                        $sqlViewMajor = mysqli_query($setDbConfiguration, "SELECT * FROM major ");
                                        while ($viewMajor = mysqli_fetch_assoc($sqlViewMajor)) :
                                        ?>
                                            <tbody>
                                                <td><?= $viewMajor['name_major'] ?></td>
                                                <td><?= $viewMajor['description_major'] ?></td>
                                            </tbody>
                                        <?php endwhile; ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>

            </ul>
        </div>
    </header>

    <section class=" container">
        <div class="row g-0">
            <div class="col table-responsive p-3  ">
                <text class="fs-5"><i class="bi bi-people-fill"></i> Daftar Pengguna</text>
                <hr>
                <table class="table table-responsive ">
                    <thead class="">
                        <th style="width:2rem">No</th>
                        <th style="width:10rem">Nama</th>
                        <th style="width:5rem">Email</th>
                        <th style="width:5rem">Aksi</th>
                    </thead>

                    <?php
                    $no = 1;
                    $sqlGetUsers = mysqli_query($setDbConfiguration, "SELECT * FROM users INNER JOIN major ON users.id_major = major.id_major INNER JOIN grade ON users.id_grade = grade.id_grade");
                    $usersArray = mysqli_fetch_all($sqlGetUsers, MYSQLI_ASSOC);

                    foreach ($usersArray as $user) :
                    ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $user['name'] ?></td>
                            <td><?= $user['email'] ?></td>
                            <td>
                                <!-- Button modal -->
                                <button type="button" class="btn btn-primary btn-sm  " data-bs-toggle="modal" data-bs-target="#modalViewData<?= $user['id_users'] ?>">
                                    <i class="bi bi-eye-fill"></i>
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="modalViewData<?= $user['id_users'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Profil</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="../../app/config/controller.php" method="post">
                                                    <input name="id_users" type="hidden" value="<?= $user['id_users']; ?>">
                                                    <table class="table table-borderless table-responsive">
                                                        <tr>
                                                            <td style="width: 7rem;">Nama</td>
                                                            <td>:</td>
                                                            <td><input class="form-control " name="name" value="<?= $user['name'] ?>" type="text"></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="width: 7rem;">Password </td>
                                                            <td>:</td>
                                                            <td><input class="form-control" name="new_password" type="password" placeholder="Ubah Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Email</td>
                                                            <td>:</td>
                                                            <td><input class="form-control" name="email" value="<?= $user['email'] ?>" type="email"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Kelas</td>
                                                            <td>:</td>
                                                            <td>
                                                                <select name="id_grade" class="form-select">
                                                                    <?php
                                                                    $selectedGradeId = $user['id_grade'];
                                                                    $sqlSelectGrade = mysqli_query($setDbConfiguration, "SELECT * FROM grade ");

                                                                    while ($selectGrade = mysqli_fetch_assoc($sqlSelectGrade)) :
                                                                        $gradeId = $selectGrade['id_grade'];
                                                                        $gradeName = $selectGrade['name_grade'];
                                                                        $selected = ($gradeId === $selectedGradeId) ? 'selected' : '';
                                                                    ?>
                                                                        <option value="<?= $gradeId ?>" <?= $selected ?>><?= $gradeName ?></option>
                                                                    <?php endwhile; ?>
                                                                </select>

                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Jurusan</td>
                                                            <td>:</td>
                                                            <td>
                                                                <select name="id_major" class="form-select">
                                                                    <?php
                                                                    $selectedMajorId = $user['id_major'];
                                                                    $sqlSelectedMajor = mysqli_query($setDbConfiguration, "SELECT * FROM major ");

                                                                    while ($selectedMajor = mysqli_fetch_assoc($sqlSelectedMajor)) :
                                                                        $majorId = $selectedMajor['id_major'];
                                                                        $majorName = $selectedMajor['name_major'];
                                                                        $selected = ($majorId === $selectedMajorId) ? 'selected' : '';
                                                                    ?>
                                                                        <option value="<?= $majorId ?>" <?= $selected ?>><?= $majorName ?></option>
                                                                    <?php endwhile; ?>
                                                                </select>

                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <button name="postUpdateUser" type="submit" class="btn btn-warning btn-sm">Ubah</button>
                                                    <button name="deleteUser" type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin menghapus data ini?')">Hapus</button>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>



        </div>

    </section>

    <script src="../assets/js/bootstrap.js"></script>
</body>

</html>