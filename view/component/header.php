<header>
    <nav class="navbar bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand"></a>
            <ul class="nav">
                <li>

                    <button type="button" class="btn btn-sm me-3" data-bs-toggle="modal" data-bs-target="#modalView">
                        <?= $_SESSION['name'] ?>
                    </button>

                    <div class="modal fade" id="modalView" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-md">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-center">
                                    <img style="width: 200px;" class="rounded-circle border mx-auto" src="../assets/img/profil/default.png" alt="">
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
                                        <tr>
                                            <td><i class="bi bi-buildings-fill"></i> Kelas</td>
                                            <td>:</td>
                                            <td><?= $_SESSION['kelas'] ?></td>
                                        </tr>
                                        <tr>
                                            <td><i class="bi bi-braces-asterisk"></i> Jurusan</td>
                                            <td>:</td>
                                            <td><?= $_SESSION['jurusan'] ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li><a class="btn btn-dark btn-sm" href="../app/config/modelLogout.php"><i class="bi bi-power"></i></a></li>
            </ul>
        </div>
    </nav>
</header>