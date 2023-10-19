<?php
session_start();
include '../app/config/database.php';
//filter
include '../app/config/filter.php';
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

    <section>
        <?php



        $sqlGetTopics = mysqli_query($setDbConfiguration, "SELECT * FROM topics");
        foreach ($sqlGetTopics as $topics) :
        ?>
            <div class="container">
                <div class=" my-5 shadow ">
                    <div class="row g-0 ">
                        <div class="col-md-3 col-sm-12 ">
                            <img class="img-fluid object-fit-fill " src="../assets/img/materi/default.jpg" alt="#">
                        </div>
                        <div class="col-md-6 col-sm-12  p-4">
                            <span><i class="bi bi-activity"></i> Belajar <?= $topics['programming_language'] ?></span>
                            <h3><?= $topics['name_topics'] ?></h3>
                            <span class="me-3 fw-bold"><i class="bi bi-braces-asterisk"></i> Kelas : <span class="badge text-bg-primary"><?= $_SESSION['kelas'] ?> </span> </span> <span class="fw-bold"><i class="bi bi-clock"></i> Waktu belajar : <span class="badge text-bg-primary">45 Menit</span></span>
                            <p class="py-2"><?= (str_word_count($topics['description_topics']) > 10 ? substr($topics['description_topics'], 0, 230) . "...." : $topics['description_topics']) ?></p>
                        </div>
                        <!-- kelas -->
                        <div class="col-md-3 col-sm-12 align-self-center px-4">
                            <div class="">
                                <button type="button" class="btn btn-primary btn-sm w-100" data-bs-toggle="modal" data-bs-target="#kelasInfo">
                                    Informasi Kelas
                                </button>
                                <div class="modal fade" id="kelasInfo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="container">

                                                    <div class="">
                                                        <div class="shadow p-5 mb-3">
                                                            <h4 id="deskripsi" class="fw-bold">Deskripsi</h4>

                                                            <p><?= $topics['description_topics'] ?></p>
                                                        </div>
                                                        <div class="shadow p-5 mb-3">
                                                            <h4 id="tujuan" class="fw-bold">Tujuan Belajar</h4>
                                                            <p><?= $topics['objective_topics'] ?></p>
                                                        </div>
                                                        <div class="shadow p-5 mb-3">
                                                            <h4 id="target" class="fw-bold">Targer Capaian</h4>

                                                            <p><?= $topics['target_topics'] ?></p>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- silabus -->
                                <!-- modal button -->
                                <button type="button" class="btn btn-primary btn-sm w-100 mt-3" data-bs-toggle="modal" data-bs-target="#Silabus">
                                    Langkah Belajar
                                </button>
                                <!-- modal body -->
                                <div class="modal fade" id="Silabus" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">

                                                <div id="silabus" class="container ">
                                                    <div class="accordion shadow " id="accordionExample">

                                                        <div class="accordion-item border-0 ">
                                                            <div class="accordion-header ">

                                                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                                    <div>
                                                                        <h5 class="fw-bold"> Langkah - Langkah Pembelajaran </h5>
                                                                        <p>Materi : <?= $topics['name_topics'] ?></p>
                                                                        <a class="btn btn-primary" href="#"> <i class="bi bi-text-paragraph"></i> Langkah Belajar</a>
                                                                    </div>

                                                                </button>

                                                            </div>
                                                            <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                                                                <div class="accordion-body">
                                                                    <div class="my-2">

                                                                        1. <a class="text-dark link-underline link-underline-opacity-0" href="#">Pre-Test > </a> <span class="badge text-bg-primary">15 </a> Menit</span>
                                                                    </div>
                                                                    <div class="my-2">
                                                                        2. <a class="text-dark link-underline link-underline-opacity-0" href="#"> Materi </a> <span class="badge text-bg-primary">15 </a> Menit </span>
                                                                    </div>
                                                                    <div class="my-2">
                                                                        3. <a class="text-dark link-underline link-underline-opacity-0" href="#"> Simulasi Pemrograman > </a> <span class="badge text-bg-primary">15 </a> menit</span>
                                                                    </div>
                                                                    <div class="my-2">
                                                                        4. <a class="text-dark link-underline link-underline-opacity-0" href="#">Post-Test > </a> <span class="badge text-bg-primary">15 </a> menit</span>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <form action="../app/config/Session.php" method="post">
                                    <input type="hidden" name="id_topics" value="<?= $topics['id_topics'] ?>">
                                    <button name="SessionStart" type="submit" class="btn btn-dark btn-sm w-100 mt-3">Mulai Belajar</button>
                                </form>
                            </div>
                        </div>
                        <div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
    </section>

</body>

</html>