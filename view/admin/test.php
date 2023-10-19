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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sceditor@3/minified/themes/default.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/sceditor@3/minified/sceditor.min.js"></script>
</head>

<body>

    <header>
        <?php include 'component/header.php' ?>
    </header>

    <?php
    if (isset($_GET['v'])) :
        $v = dekripsi($_GET['v']);
        if ($v === "data sudah ada") :

    ?>
            <div class="alert alert-info alert-dismissible mb-0 fade show" role="alert">
                <strong>Data Sudah Ada</strong> kamu sudah memiliki data simulasi.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
    <?php
        endif;
    endif;
    ?>

    <header class="bg-primary">
        <div class="py-3 container ">
            <ul class="nav justify-content-end">
                <li>
                    <button type="button" class="btn text-bg-light btn-sm me-3 " data-bs-toggle="modal" data-bs-target="#modalAddQuestion">Soal <i class="bi bi-plus-lg"></i></button>

                    <div class="modal fade" id="modalAddQuestion" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Soal</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="../../app/config/modelTest.php" method="post">

                                        <textarea class="form-control mb-3" name="question" cols="30" rows="10" placeholder="Pertanyaan" required></textarea>

                                        <input class="form-control mb-3" type="text" name="option_a" placeholder="option_a" required>
                                        <input class="form-control mb-3" type="text" name="option_b" placeholder="option_b" required>
                                        <input class="form-control mb-3" type="text" name="option_c" placeholder="option_c" required>
                                        <input class="form-control mb-3" type="text" name="option_d" placeholder="option_d" required>

                                        <label for="key">Kunci jawaban</label>
                                        <select id="key" name="key_test" class="form-select mb-3">
                                            <?php
                                            $arrayValueKey = ['option_a', 'option_b', 'option_c', 'option_d'];
                                            foreach ($arrayValueKey as $valueKey) :
                                            ?>
                                                <option value="<?= $valueKey ?>"><?= $valueKey ?></option>
                                            <?php endforeach; ?>
                                        </select>


                                        <select name="id_topics" class="form-select mb-3">
                                            <?php
                                            $sqlGetLessons = mysqli_query($setDbConfiguration, "SELECT * FROM topics");
                                            while ($getLessons = mysqli_fetch_assoc($sqlGetLessons)) :
                                            ?>
                                                <option value="<?= $getLessons['id_topics'] ?>"> <?= $getLessons['name_topics'] ?></option>
                                            <?php endwhile; ?>
                                        </select>

                                        <button name="postAddQuestions" type="submit" class="btn btn-primary btn-sm">Tambah</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <button type="button" class="btn text-bg-light btn-sm " data-bs-toggle="modal" data-bs-target="#modalAddSimulation">Simulasi <i class="bi bi-plus-lg"></i></button>

                    <div class="modal fade" id="modalAddSimulation" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Simulasi</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="../../app/config/modelSimulation.php">
                                        <label class="badge text-bg-primary rounded-0">Petunjuk </label>
                                        <textarea class="form-control rounded-0 mb-3" name="question_simulation" id="myTextarea" cols="30" rows="10" required></textarea>

                                        <label class="badge text-bg-dark rounded-0">Jawaban </label>
                                        <textarea class="form-control text-bg-dark rounded-0 mb-3" name="code" cols="30" rows="10" required></textarea>

                                        <select name="id_topics" class="form-select mb-3">
                                            <?php
                                            $sqlGetLessons = mysqli_query($setDbConfiguration, "SELECT * FROM topics");
                                            while ($getLessons = mysqli_fetch_assoc($sqlGetLessons)) :
                                            ?>
                                                <option value="<?= $getLessons['id_topics'] ?>"> <?= $getLessons['name_topics'] ?></option>
                                            <?php endwhile; ?>
                                        </select>

                                        <button class="btn btn-primary btn-sm" name="postAddSimulation" type="submit">Tambah</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>

                </li>
            </ul>
        </div>
    </header>

    <section class="container">
        <div class="row g-0 ">
            <div class="col table-responsive  p-3 ">
                <text class="fs-5"><i class="bi bi-ui-radios"></i> Pretest & Postest </text>
                <hr>
                <table class="table">
                    <thead>
                        <th style="width:2rem;">No</th>
                        <th style="width:10rem;">Materi</th>
                        <th style="width:5rem;">Soal</th>
                        <th style="width:5rem;">Simulasi</th>
                        <th style="width:5rem;">Nilai</th>

                    </thead>
                    <?php
                    $no = 1;
                    $sqlGetTopics = mysqli_query($setDbConfiguration, "SELECT * FROM topics  ");
                    foreach ($sqlGetTopics as $lessons) :
                    ?>
                        <tbody>

                            <td><?= $no++ ?></td>
                            <td><?= $lessons['name_topics'] ?></td>
                            <td>
                                <button type="button" class="btn btn-primary btn-sm  " data-bs-toggle="modal" data-bs-target="#modalViewQuestionsTest<?= $lessons['id_topics'] ?>">
                                    <i class="bi bi-ui-radios"></i> Soal
                                </button>

                                <div class="modal fade" id="modalViewQuestionsTest<?= $lessons['id_topics'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                        <div class="modal-content ">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Soal</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body ">
                                                <div class="shadow p-3 mb-3">
                                                    <form action="../../app/config/modelTest.php" method="post">
                                                        <div>
                                                            <?php
                                                            $sqlGetQuestionsDelete = mysqli_query($setDbConfiguration, "SELECT * FROM questions ");
                                                            $deleteArray = mysqli_fetch_assoc($sqlGetQuestionsDelete);
                                                            ?>
                                                            <input type="hidden" name="id_topics" value="<?= $deleteArray['id_topics'] ?>">
                                                            <button name="postDeleteQuestionsAll" type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin menghapus semua data data ini?')"><i class="bi bi-trash3-fill"></i> Hapus Semua Soal</button>
                                                        </div>
                                                    </form>
                                                </div>

                                                <?php
                                                $sqlGetQuestions = mysqli_query($setDbConfiguration, "SELECT * FROM questions 
                                                WHERE id_topics = '$lessons[id_topics]'");
                                                while ($questions = mysqli_fetch_assoc($sqlGetQuestions)) :
                                                ?>
                                                    <form action="../../app/config/modelTest.php" method="post">
                                                        <div class="shadow p-5 mb-3">
                                                            <div class="mb-3">
                                                                <label class="badge text-bg-primary rounded-0">Soal</label>
                                                                <div class="p-2 border text-bg-light"><?= $questions['question'] ?></div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="badge text-bg-primary rounded-0">A</label>
                                                                <div class="p-2 border text-bg-light"><?= $questions['option_a'] ?></div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="badge text-bg-primary rounded-0">B</label>
                                                                <div class="p-2 border text-bg-light"><?= $questions['option_b'] ?></div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="badge text-bg-primary rounded-0">C</label>
                                                                <div class="p-2 border text-bg-light"><?= $questions['option_c'] ?></div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="badge text-bg-primary rounded-0">D</label>
                                                                <div class="p-2 border text-bg-light"><?= $questions['option_d'] ?></div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="badge text-bg-primary rounded-0">Jawaban</label>
                                                                <div class="p-2 border text-bg-light">
                                                                    <?php
                                                                    $optionArray = ['option_a', 'option_b', 'option_c', 'option_d'];
                                                                    $optionArrayView = ['A', 'B', 'C', 'D'];

                                                                    if (in_array($questions['key_test'], $optionArray)) {
                                                                        $index = array_search($questions['key_test'], $optionArray);
                                                                        echo $optionArrayView[$index];
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                            <div class="d-flex justify-content-end">
                                                                <input type="hidden" name="id_test" value="<?= $questions['id_test'] ?>">
                                                                <a class="btn btn-warning btn-sm me-1" href="questions.php?v=<?= rawurlencode(enkripsi($questions['id_test'])) ?>">Ubah</a>
                                                                <button name="postDeleteQuestions" type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin menghapus data ini?')">Hapus</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                <?php endwhile; ?>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalViewSimulation<?= $lessons['id_topics'] ?>">
                                    <i class="bi bi-headset-vr"></i> Simulasi
                                </button>
                                <div class="modal fade" id="modalViewSimulation<?= $lessons['id_topics'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                        <div class="modal-content ">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Simulasi</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body ">
                                                <div>
                                                    <?php
                                                    $sqlGetSimulation = mysqli_query($setDbConfiguration, "SELECT * FROM simulation WHERE id_topics = '$lessons[id_topics]'");
                                                    while ($getSimulation = mysqli_fetch_assoc($sqlGetSimulation)) :
                                                    ?>
                                                        <div class="p-3 shadow mb-3"><?= $getSimulation['question_simulation'] ?></div>

                                                        <form class="d-flex justify-content-end" action="../../app/config/modelSimulation.php" method="post">
                                                            <input type="hidden" name="id_simulation" value="<?= $getSimulation['id_simulation'] ?>">
                                                            <button name="postDeleteSimulation" class="btn btn-danger btn-sm" type="submit"> Hapus</button>
                                                        </form>

                                                    <?php endwhile; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </td>
                            <td>
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalViewTestValue<?= $lessons['id_topics'] ?>">
                                    <i class="bi bi-ui-radios"></i> Nilai
                                </button>

                                <div class="modal fade" id="modalViewTestValue<?= $lessons['id_topics'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-lg">
                                        <div class="modal-content ">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Nilai</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body ">
                                                <div class="shadow p-3 mb-3">

                                                    <div>
                                                        <?php
                                                        $sqlGetAnswerDelete = mysqli_query($setDbConfiguration, "SELECT * FROM answer ");
                                                        $deleteArray = mysqli_fetch_assoc($sqlGetAnswerDelete);
                                                        ?>
                                                        <form action="../../app/config/modelTest.php" method="post">
                                                            <input type="hidden" name="id_topics" value="<?= $deleteArray['id_topics'] ?>">
                                                            <button name="postDeleteAnswerAll" type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin menghapus semua data data ini?')"><i class="bi bi-trash3-fill"></i> Hapus Semua Soal</button>
                                                        </form>
                                                    </div>

                                                </div>
                                                <div class="shadow p-5 mb-3">
                                                    <table class="table">
                                                        <tr>
                                                            <th>No</th>
                                                            <th>Nama</th>
                                                            <th>Pretest</th>
                                                            <th>Postest</th>
                                                            <th>Simulasi</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                        <?php
                                                        $no = 1;
                                                        $sqlGetAnswer = mysqli_query($setDbConfiguration, "SELECT * FROM answer
                                                        INNER JOIN topics ON answer.id_topics = topics.id_topics
                                                        INNER JOIN users ON answer.id_users = users.id_users 
                                                        WHERE topics.id_topics = '$lessons[id_topics]'
                                                        ");
                                                        $answerArray = mysqli_fetch_all($sqlGetAnswer, MYSQLI_ASSOC);
                                                        foreach ($answerArray as $answer) :
                                                        ?>
                                                            <tr>
                                                                <td><?= $no++ ?></td>
                                                                <td><?= $answer['name'] ?></td>
                                                                <td><?= $answer['point_pretest'] ?></td>
                                                                <td><?= $answer['point_postest'] ?></td>
                                                                <td>
                                                                    <?php
                                                                    $status =  $answer['simulation_status'];
                                                                    if ($status === 'selesai') :
                                                                    ?>
                                                                        <span class="badge text-bg-primary rounded-0">selesai</span>
                                                                    <?php else : ?>
                                                                        <span class="badge text-bg-danger rounded-0">Belum Selesai</span>
                                                                    <?php endif; ?>
                                                                <td>
                                                                    <form action="../../app/config/modelTest.php" method="post">
                                                                        <input type="hidden" name="id_answer" value="<?= $answer['id_answer'] ?>">
                                                                        <button name="postDeleteAnswer" class="btn btn-danger btn-sm" type="submit"> Hapus</button>
                                                                    </form>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tbody>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </section>


    <script>
        var textarea = document.getElementById('myTextarea');
        sceditor.create(textarea, {
            format: 'xhtml',
            style: 'minified/themes/content/default.min.css'
        });
    </script>
</body>

</html>