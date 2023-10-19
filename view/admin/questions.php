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
        $id_test = dekripsi($_GET['v']);
        $sqlGetTest = mysqli_query($setDbConfiguration, "SELECT * FROM questions WHERE id_test='$id_test'");
        while ($test = mysqli_fetch_array($sqlGetTest)) :
    ?>

            <section class="container">
                <form action="../../app/config/modelTest.php" method="post">
                    <div class="my-5 shadow p-5">
                        <div class="mb-3">
                            <label class="badge rounded-0 text-bg-primary">Soal</label>
                            <input class="form-control rounded-0" name="question" value="<?= $test['question'] ?>" type="text" required>
                        </div>
                        <div class="mb-3">
                            <label class="badge rounded-0 text-bg-primary">A</label>
                            <input class="form-control rounded-0" name="option_a" value="<?= $test['option_a'] ?>" type="text" required>
                        </div>
                        <div class="mb-3">
                            <label class="badge rounded-0 text-bg-primary">B</label>
                            <input class="form-control rounded-0" name="option_b" value="<?= $test['option_b'] ?>" type="text" required>
                        </div>
                        <div class="mb-3">
                            <label class="badge rounded-0 text-bg-primary">C</label>
                            <input class="form-control rounded-0" name="option_c" value="<?= $test['option_c'] ?>" type="text" required>
                        </div>
                        <div class="mb-3">
                            <label class="badge rounded-0 text-bg-primary">D</label>
                            <input class="form-control rounded-0" name="option_d" value="<?= $test['option_d'] ?>" type="text" required>
                        </div>
                        <div class="mb-3">
                            <label class="badge rounded-0 text-bg-primary">jawaban</label>
                            <select name="key_test" class="form-select form-control rounded-0">
                                <?php
                                $optionArray = ['option_a', 'option_b', 'option_c', 'option_d'];
                                $optionArrayView = ['A', 'B', 'C', 'D'];

                                $data = $test['key_test'];

                                foreach ($optionArray as $key => $option) {
                                    $selected = ($option === $data) ? 'selected' : '';
                                ?>
                                    <option value="<?= $option ?>" <?= $selected ?>><?= $optionArrayView[$key] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <input type="hidden" name="id_test" value="<?= $test['id_test'] ?>">

                        <button name="postUpdateQuestions" type="submit" class="btn btn-warning btn-sm">Ubah</button>
                </form>

            </section>

    <?php
        endwhile;
    } else {
        header("location:test.php");
    } ?>
</body>

</html>