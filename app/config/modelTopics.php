<?php
include 'database.php';

if (isset($_POST['postDeleteTopics'])) {
    $id_topics = $_POST['id_topics'];
    if (is_numeric($id_topics)) {
        $sqlDeleteMaterial = mysqli_query($setDbConfiguration, "DELETE FROM material WHERE id_topics = '$id_topics'");
        $sqlDeleteTopics = mysqli_query($setDbConfiguration, "DELETE FROM topics WHERE id_topics = '$id_topics'");
        $sqlDeleteAnswer = mysqli_query($setDbConfiguration, "DELETE FROM answer WHERE id_topics = '$id_topics'");
        header("location:/spb-vanila/view/admin/topics.php");
    } else {
        // die("Kueri SQL gagal: " . mysqli_error($setDbConfiguration));
        header("location:/spb-vanila/view/admin/topics.php");
    }
}

if (isset($_POST['postAddTopics'])) {
    $name_topics = $_POST['name_topics'];
    $programming_language = $_POST['programming_language'];
    $description_topics = $_POST['description_topics'];
    $objective_topics = $_POST['objective_topics'];
    $target_topics = $_POST['target_topics'];

    $stmt = mysqli_prepare($setDbConfiguration, "INSERT INTO topics (name_topics, programming_language, description_topics, objective_topics, target_topics) VALUE (?, ?, ?, ?, ?) ");
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sssss", $name_topics, $programming_language, $description_topics, $objective_topics, $target_topics);
        if (mysqli_stmt_execute($stmt)) {
            header("location:/spb-vanila/view/admin/topics.php");
        } else {
            header("location:/spb-vanila/view/admin/topics.php");
        }
    } else {
        header("location:/spb-vanila/view/admin/topics.php");
    }
}

if (isset($_POST['postAddMaterial'])) {
    $name_material = $_POST['name_material'];
    $topics_material = $_POST['topics_material'];
    $topics_video = $_POST['topics_video'];
    $id_topics = $_POST['id_topics'];


    $stmt = mysqli_prepare($setDbConfiguration, "INSERT INTO material (name_material, topics_material, topics_video, id_topics) VALUE (?, ?, ?, ?) ");
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "sssi", $name_material, $topics_material, $topics_video, $id_topics);
        if (mysqli_stmt_execute($stmt)) {
            header("location:/spb-vanila/view/admin/topics.php");
        } else {
            // header("location:/spb-vanila/view/admin/topics.php");
            die("Kueri SQL gagal: " . mysqli_error($setDbConfiguration));
        }
    } else {
        // header("location:/spb-vanila/view/admin/topics.php");
        die("Kueri SQL gagal: " . mysqli_error($setDbConfiguration));
    }
}
