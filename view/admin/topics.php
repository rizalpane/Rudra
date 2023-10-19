<?php
include '../../app/config/database.php';
include '../../app/config/hash.php';
include '../../app/config/filter.php';
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




    <header class="bg-primary">
        <div class="py-3 container ">
            <ul class="nav justify-content-end">
                <li>
                    <button type="button" class="btn text-bg-light btn-sm me-3 " data-bs-toggle="modal" data-bs-target="#modalViewLessons">
                        Materi <i class="bi bi-braces-asterisk"></i>
                    </button>
                    <div class="modal fade" id="modalViewLessons" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Materi Belajar</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <table class="table">

                                        <?php
                                        $sqlGetTopics = mysqli_query($setDbConfiguration, "SELECT * FROM topics ");
                                        while ($topics = mysqli_fetch_array($sqlGetTopics)) :
                                        ?>
                                            <tbody>
                                                <td>
                                                    <div class="accordion shadow " id="accordionExample<?= $topics['id_topics'] ?>">

                                                        <div class="accordion-item border-0 ">
                                                            <div class="accordion-header ">

                                                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                                    <div>
                                                                        <h5 class="fw-bold"> Materi : <?= $topics['name_topics'] ?> </h5>
                                                                        <p></p>
                                                                        <a class="btn btn-primary btn-sm" href="#"> <i class="bi bi-text-paragraph"></i> Lihat Bahasan</a>
                                                                    </div>

                                                                </button>

                                                            </div>
                                                            <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample<?= $topics['id_topics'] ?>">
                                                                <div class="accordion-body">
                                                                    <?php
                                                                    $id_topics = $topics['id_topics'];
                                                                    $no = 1;
                                                                    $sqlGetMaterial = mysqli_query($setDbConfiguration, "SELECT * FROM material WHERE id_topics = '$id_topics' ");
                                                                    while ($material = mysqli_fetch_array($sqlGetMaterial)) :
                                                                    ?>
                                                                        <div class="my-2">
                                                                            <p><span class="badge text-bg-primary rounded-0">Pembahasan <?= $no++ ?> : </span> <?= $material['name_material']  ?> <span class="badge text-bg-primary"><a class="text-decoration-none text-light " href="artikel.php?v=<?= rawurlencode(enkripsi($material['id_material'])) ?>">Lihat <i class="bi bi-eye-fill "></i></a></span> </p>
                                                                        </div>
                                                                    <?php endwhile; ?>

                                                                    <div class="d-flex justify-content-end">
                                                                        <form action="../../app/config/modelTopics.php" method="post">
                                                                            <input type="hidden" name="id_topics" value="<?= $topics['id_topics'] ?>">
                                                                            <button name="postDeleteTopics" type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin menghapus data ini?')"><i class="bi bi-trash3-fill"></i> Hapus</button>
                                                                        </form>
                                                                    </div>

                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tbody>
                                        <?php endwhile; ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <button type="button" class="btn text-bg-light btn-sm " data-bs-toggle="modal" data-bs-target="#modalAddTopics">
                        Materi <i class="bi bi-plus"></i>
                    </button>
                    <div class="modal fade" id="modalAddTopics" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Materi Belajar</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="../../app/config/modelTopics.php" method="post">
                                        <input class="form-control mb-3" type="text" name="name_topics" placeholder="Nama Materi" required>

                                        <label class="badge text-bg-primary rounded-0 " for="programmingLanguage">Bahasa Pemrograman</label>
                                        <select class="form-control mb-3 rounded-0" name="programming_language" id="programmingLanguage" required>
                                            <?php
                                            $programmingLanguage = ['C++', 'PHP', 'Python', 'C', 'C#', 'Javascript', 'Java'];
                                            foreach ($programmingLanguage as $language) :
                                            ?>
                                                <option value="<?= $language ?>"><?= $language ?></option>
                                            <?php endforeach; ?>
                                        </select>

                                        <textarea class="form-control mb-3" name="description_topics" cols="30" rows="10" placeholder="Deskripsi Pembelajaran" required></textarea>
                                        <textarea class="form-control mb-3" name="objective_topics" cols="30" rows="10" placeholder="Tujuan Pembelajaran" required></textarea>
                                        <textarea class="form-control mb-3" name="target_topics" cols="30" rows="10" placeholder="Target Pembelajaran" required></textarea>

                                        <button name="postAddTopics" type="submit" class="btn btn-primary btn-sm"> Tambah</button>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </header>

    <section class="container">
        <div class="shadow my-5 p-3">
            <h4 class="fw-bold"><i class="bi bi-braces-asterisk"></i> Tulis Pembahasan</h4>
            <p>Gunakan Form dibawah ini untuk menambahkan pembahasan pada materi </p>
        </div>
        <div class="shadow p-5">
            <form action="../../app/config/modelTopics.php" method="post">
                <label class="badge text-bg-primary rounded-0">Judul </label>
                <input class="form-control rounded-0 mb-3" type="text" name="name_material" id="" placeholder="Judul Materi" required>
                <label class="badge text-bg-primary rounded-0">Materi </label>
                <textarea class="form-control" name="topics_material" id="myTextarea" rows="15" placeholder="Artikel" required></textarea>
                <div class="my-3">
                    <label class="badge text-bg-primary rounded-0">Sematkan Vidio </label>
                    <input class="form-control rounded-0 " type="text" name="topics_video" placeholder="embed-link-youtube">
                </div>
                <label class="badge text-bg-primary rounded-0" for="topics">Materi</label>
                <select id="topics" name="id_topics" class="form-select rounded-0 mb-3" required>
                    <?php
                    $sqlGetTopics = mysqli_query($setDbConfiguration, "SELECT * FROM topics  ");
                    while ($getTopics = mysqli_fetch_assoc($sqlGetTopics)) :
                    ?>
                        <option value="<?= $getTopics['id_topics'] ?>"> <?= $getTopics['name_topics'] ?></option>
                    <?php endwhile; ?>
                </select>

                <button name="postAddMaterial" type="submit" class="btn btn-primary btn-sm"> Tambah</button>

            </form>

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