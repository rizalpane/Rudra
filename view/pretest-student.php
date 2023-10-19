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
    <?php
    $id_topics = dekripsi($_SESSION['id_topics']);
    $id_users = $_SESSION['id_users'];

    $sqlCheckQuestion = mysqli_query($setDbConfiguration, "SELECT * FROM questions 
    WHERE id_topics = '$id_topics' ");
    $numCheck = mysqli_num_rows($sqlCheckQuestion);
    minDataOnTable($numCheck, 1);

    $sqlGetAnswer = mysqli_query($setDbConfiguration, "SELECT * FROM answer 
    WHERE id_users='$id_users' AND point_pretest != 'NULL' AND id_topics = '$id_topics'");
    $data = mysqli_num_rows($sqlGetAnswer);
    if ($data === 0) : ?>

        <section>
            <form action="../app/config/modelTest.php" method="post">
                <div class="container">
                    <div class="shadow my-5 p-3 rounded-3">
                        <h4 class="fw-bold"><i class="bi bi-activity"></i> Pre-Test</h4>
                        <p>Kerjakan Soal dibawah ini dengan benar</p>
                    </div>
                    <div>
                        <?php

                        $sqlGetQuestions = mysqli_query($setDbConfiguration, "SELECT * FROM questions WHERE  id_topics = '$id_topics'  ");
                        foreach ($sqlGetQuestions as $pretest) :
                        ?>
                            <div class=" shadow my-3 p-4 rounded-3">

                                <text class="fw-bold"><?= $pretest['question'] ?></text>
                                <input name="id_test" type="hidden" value="<?= $pretest['id_test'] ?>">
                                <input name="id_topics" type="hidden" value="<?= $id_topics ?>">
                                <input name="id_users" type="hidden" value="<?= $id_users ?>">
                                <hr>
                                <div class="row g-0">
                                    <div class="col-lg-6 col-sm-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="option_a" name="record_answer[<?= $pretest['id_test'] ?>]" id="a" required>
                                            <label class="form-check-label" for="a">
                                                A. <?= $pretest['option_a'] ?>
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="option_b" name="record_answer[<?= $pretest['id_test'] ?>]" id="b">
                                            <label class="form-check-label" for="b">
                                                B. <?= $pretest['option_b'] ?>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-sm-12 ">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="option_c" name="record_answer[<?= $pretest['id_test'] ?>]" id="c">
                                            <label class="form-check-label" for="c">
                                                C. <?= $pretest['option_c'] ?>
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" value="option_d" name="record_answer[<?= $pretest['id_test'] ?>]" id="d">
                                            <label class="form-check-label" for="d">
                                                D. <?= $pretest['option_d'] ?>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#kirimPretest">
                            Kirim
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="kirimPretest" tabindex=-1 aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body ">
                                        Yakin dengan jawaban Pretest anda?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tidak</button>
                                        <button name="postAnswerPretest" class="btn btn-primary btn-sm">Ya</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    <?php else : ?>
        <section class="text-bg-primary">
            <div class="py-5 container ">
                Anda Sudah Mengerjakan Pretest <span class="fw-bold"><?= $_SESSION['name'] ?></span> Klik <a class="text-light fw-bold " href="material-student.php"> Lanjutkan <i class="bi bi-arrow-right"></i></a>
            </div>
        </section>
    <?php endif; ?>

</body>

</html>