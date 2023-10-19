<nav class="navbar bg-body-tertiary">
    <div class="  container ">
        <a href="dashboard-teacher.php" class="navbar-brand">Dashboard</a>
        <ul class="nav justify-content-center">
            <li class="nav-item">
                <?php
                $sql = mysqli_query($setDbConfiguration, "SELECT * FROM users");
                $data =  mysqli_num_rows($sql);
                ?>
                <a class="nav-link" href="users.php"><i class="bi bi-people-fill"></i> Pengguna (<?= $data ?>) </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="test.php"><i class="bi bi-ui-radios"></i> Test</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="topics.php"><i class="bi bi-braces-asterisk"></i> Materi</a>
            </li>
        </ul>
        <div>
            <button type="button" class="btn " data-bs-toggle="modal" data-bs-target="#modal">
                Profil <i class="bi bi-person-fill"></i>
            </button>
            <a class="btn btn-dark btn-sm" href="../../app/config/modelLogout.php"><i class="bi bi-power"></i></a>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Profil</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <img style="width: 200px;" class="rounded-circle border mx-auto" src="../../assets/img/profil/default.png" alt="">
                        <table class="table table-borderless my-3">
                            <tr>
                                <td><i class="bi bi-person-fill"></i> Nama Lengkap</td>
                                <td>:</td>
                                <td><?= $_SESSION['name'] ?></td>
                            </tr>
                            <tr>
                                <td><i class="bi bi-envelope-fill"></i> Email</td>
                                <td>:</td>
                                <td><?= $_SESSION['email'] ?></td>
                            </tr>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>