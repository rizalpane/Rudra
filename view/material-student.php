<?php
include '../app/config/database.php';
include '../app/config/hash.php';
include '../app/config/filter.php';
session_start();
filterLoginToStudent($_SESSION['group']);
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
</body>

<section>
    <div class="container">
        <div class="shadow my-5 p-3 rounded-3">
            <h4 class="fw-bold"><i class="bi bi-braces-asterisk"></i> Materi</h4>
            <p>Dibawah ini merupakan materi yang akan di pelajari, baca dan pahami materi dibawah ini !!!</p>
        </div>
        <div class="row g-0 d-flex justify-content-between  ">
            <div class="col-sm-12 col-md-8 order-2 ">
                <?php
                if (isset($_GET['v'])) {
                    $view = dekripsi($_GET['v']);
                    $sqlGetMaterial = mysqli_query($setDbConfiguration, "SELECT * FROM material WHERE name_material = '$view' ");
                    $numCheck = mysqli_num_rows($sqlGetMaterial);
                }
                if (!empty($sqlGetMaterial)) {
                    foreach ($sqlGetMaterial as $view) {
                        if (!empty($view['topics_material'])) {
                ?>

                            <div class="shadow mb-5 p-3"><span class="fs-2 fw-bold"><?= $view['name_material'] ?></span></div>
                            <label class="badge text-bg-primary rounded-0">Materi</label>
                            <div class="shadow mb-5 p-3"><?= $view['topics_material'] ?></div>
                            <label class="badge text-bg-primary rounded-0">Vidio</label>
                            <div class="shadow mb-5 p-3">
                                <div class="ratio ratio-16x9"><iframe src="<?= $view['topics_video'] ?>" title="YouTube video" allowfullscreen></iframe></div>
                            </div>
                <?php
                        } else {
                            echo " Pilih Materi ";
                        }
                    }
                } else {
                    echo " Pilih Materi ";
                }
                ?>

            </div>
            <div style="height:30rem;" class=" d-none d-md-block col-md-3 order-1">

                <div class="p-3 shadow mb-3 text-bg-dark"><span class="fw-bold fs-6">Daftar Materi</span></div>

                <div class="p-3 shadow mb-5">
                    <form method="post">
                        <?php
                        $no = 1;
                        $id_topics = dekripsi($_SESSION['id_topics']);
                        $sqlGetMaterialView = mysqli_query($setDbConfiguration, "SELECT * FROM material WHERE id_topics = '$id_topics' ");
                        $getNumRow = mysqli_num_rows($sqlGetMaterialView);
                        foreach ($sqlGetMaterialView as $view) : ?>
                            <div class=" my-2 px-2">
                                <span class="badge text-bg-primary"><?= $no++ ?></span><a class="link-menu" href="material-student.php?v=<?= enkripsi($view['name_material']) ?>"> <?= $view['name_material'] ?></a>
                            </div>
                        <?php endforeach; ?>
                    </form>
                </div>
                <div class="p-3 shadow">
                    <a class="btn btn-primary btn-sm w-100 fw-bold" href="simulation.php">Selesai</i></a>
                </div>

            </div>
        </div>

        <div class="d-md-none d-sm-block mb-3 ">
            <label class="badge text-bg-primary rounded-0"> Daftar Materi </label>
            <div class="btn-toolbar w-100 shadow p-3" role="toolbar" aria-label="Toolbar with button groups">
                <div class="btn-group me-2" role="group" aria-label="First group">
                    <?php
                    $no = 1;
                    $sqlGetMaterialView = mysqli_query($setDbConfiguration, "SELECT * FROM material WHERE id_topics = '$id_topics' ");
                    $getNumRow = mysqli_num_rows($sqlGetMaterialView);
                    foreach ($sqlGetMaterialView as $view) : ?>
                        <a class="btn btn-primary btn-sm" href="material-student.php?view=<?= enkripsi($view['name_material']) ?>"> <?= $no++ ?></a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

    </div>
</section>

</html>