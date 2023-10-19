<?php
include 'database.php';
include 'hash.php';

if (isset($_POST['postSimulation'])) {

    $code = htmlspecialchars($_POST['code']);
    $id_users = $_POST['id_users'];
    $id_topics = $_POST['id_topics'];
    $simulation_status = 'selesai';

    $codeTrimAnswer = trim($code);
    $codeStringAnswer = preg_replace('/\s+/', '', $codeTrimAnswer);

    $sqlSelectSimulationValue = mysqli_query($setDbConfiguration, "SELECT * FROM simulation WHERE id_topics='$id_topics'");
    $data = mysqli_fetch_assoc($sqlSelectSimulationValue);

    if (!$codeStringAnswer) {
        die("Kueri SQL gagal 1: " . mysqli_error($setDbConfiguration));
    }
    echo $data['code_key'];
    echo ' <br>';
    echo $codeStringAnswer;



    if ($data['code_key'] === $codeStringAnswer) {
        $stmt = mysqli_prepare($setDbConfiguration, "UPDATE answer SET simulation_status = ? WHERE id_users = ? ");
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "si", $simulation_status, $id_users);
            if (mysqli_stmt_execute($stmt)) {
                header("location:/spb-vanila/view/simulation.php");
            } else {
                die("Kueri SQL gagal 2: " . mysqli_error($setDbConfiguration));
                // header("location:/spb-vanila/view/simulation.php");
            }
        }
    } else {
        die("Kueri SQL gagal 3: " . mysqli_error($setDbConfiguration));
        // header("location:/spb-vanila/view/simulation.php");e

    }
}

if (isset($_POST['postAddSimulation'])) {
    $code = htmlspecialchars($_POST['code']);
    $question_simulation = $_POST['question_simulation'];
    $id_topics = $_POST['id_topics'];

    $sqlGetSimulation = mysqli_query($setDbConfiguration, "SELECT * FROM simulation 
    WHERE id_topics = '$id_topics' ");
    $checkSimulation = mysqli_num_rows($sqlGetSimulation);
    $v = enkripsi("data sudah ada");

    if ($checkSimulation !== 0) {
        header("location:/spb-vanila/view/admin/test.php?v=$v");
        exit();
    }

    $codeTrim = trim($code);
    $codeString = preg_replace('/\s+/', '', $codeTrim);

    $stmt = mysqli_prepare($setDbConfiguration, "INSERT INTO simulation (code_key, question_simulation, id_topics) VALUES (?, ?, ?)");
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssi", $codeString, $question_simulation, $id_topics);
        if (mysqli_stmt_execute($stmt)) {
            header("location:/spb-vanila/view/admin/test.php");
        } else {
            // header("location:/spb-vanila/view/simulation.php");
            die("Kueri SQL gagal: " . mysqli_error($setDbConfiguration));
        }
    } else {
        // header("location:/spb-vanila/view/simulation.php");
        die("Kueri SQL gagal: " . mysqli_error($setDbConfiguration));
    }
}

if (isset($_POST['postDeleteSimulation'])) {
    $id_simulation = $_POST['id_simulation'];
    if (is_numeric($id_simulation)) {
        $sqlDeletSimulation = mysqli_query($setDbConfiguration, "DELETE FROM simulation WHERE id_simulation = '$id_simulation'");
        header("location:/spb-vanila/view/admin/test.php");
    } else {
        die("Kueri SQL gagal: " . mysqli_error($setDbConfiguration));
        // header("location:/spb-vanila/view/admin/test.php");
    }
}
