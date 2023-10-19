<?php
include '../../app/config/database.php';
include '../../app/config/filter.php';
include '../../app/config/hash.php';
session_start();
filterLoginToTeacher($_SESSION['group']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include 'component/head.php' ?>
</head>

<body>

    <?php
    if (isset($_GET['v'])) {
        $id_material = dekripsi($_GET['v']);
        $sqlGetMaterial = mysqli_query($setDbConfiguration, "SELECT * FROM material WHERE id_material='$id_material'");
        while ($material = mysqli_fetch_array($sqlGetMaterial)) :
    ?>
            <section class="container">
                <div class="my-5 shadow p-5">
                    <label class="badge rounded-0 text-bg-primary">Judul</label>
                    <h5 class="fw-bold"><?= $material['name_material'] ?></h5>
                </div>
                <div class="my-5 shadow p-5">
                    <label class="badge rounded-0 text-bg-primary">Materi</label>
                    <?= $material['topics_material'] ?>
                </div>
                <div class="my-5 shadow p-5 ">
                    <label class="badge rounded-0 text-bg-primary">Vidio</label>
                    <div class="ratio ratio-16x9">
                        <iframe src="<?= $material['topics_video'] ?>" title="<?= $material['name_material'] ?>"></iframe>
                    </div>
                </div>

                </div>
            </section>

    <?php
        endwhile;
    } else {
        header("location:topics.php");
    } ?>

</body>

</html>