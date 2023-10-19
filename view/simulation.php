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
<?php
$status = 'selesai';
$id_users = $_SESSION['id_users'];
$sqlGetAnswerSimulation = mysqli_query($setDbConfiguration, "SELECT * FROM answer WHERE id_users ='$id_users' AND simulation_status = '$status'  ");
$data = mysqli_num_rows($sqlGetAnswerSimulation);
if ($data === 0) : ?>
    <section>
        <div class="container">
            <div class="shadow my-5 p-3 ">
                <h4 class="fw-bold"><i class="bi bi-braces-asterisk"></i> Simulasi Coding</h4>
                <p>Pastikan sebelum kamu melanjutkan ke tahap berikutnya kamu sudah benar benar memahami materi sebelumnya, kerjakan simulasi dibawah ini untuk memvalidasi :</p>
            </div>

            <label class="badge text-bg-primary rounded-0">Instruksi</label>
            <?php
            $id_topics = dekripsi($_SESSION['id_topics']);
            $sqlGetSimulation = mysqli_query($setDbConfiguration, ("SELECT * FROM simulation WHERE id_topics = '$id_topics' "));
            while ($simulation = mysqli_fetch_assoc($sqlGetSimulation)) :
            ?>
                <div class="p-3 shadow mb-3">
                    <?= $simulation['question_simulation'] ?>
                </div>
            <?php endwhile; ?>
            <label class="badge text-bg-primary rounded-0">coding</label>
            <div>
                <div class="row g-0">
                    <div class="col">
                        <form action="../app/config/modelSimulation.php" method="post">
                            <input type="hidden" value="<?= $_SESSION['id_users'] ?>" name="id_users">
                            <input type="hidden" value="<?= $id_topics ?>" name="id_topics">
                            <textarea class="form-control text-bg-dark p-3 rounded-0" name="code" id="editor" cols="1" rows="10" required></textarea>
                            <button name="postSimulation" class="btn btn-primary btn-sm my-3">Tambah Data</button>
                        </form>
                    </div>
                </div>
            </div>
    </section>
<?php else : ?>
    <section class="text-bg-primary">
        <div class="py-5 container ">
            Anda Sudah Mengerjakan Simulasi <span class="fw-bold"><?= $_SESSION['name'] ?></span> Klik <a class="text-light fw-bold " href="postest-student.php"> Lanjutkan <i class="bi bi-arrow-right"></i></a>
        </div>
    </section>
<?php endif; ?>

</html>