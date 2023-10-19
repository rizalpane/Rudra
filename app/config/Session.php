<?php
include 'hash.php';
session_start();

if (isset($_POST['SessionStart'])) {
    $session = $_SESSION['id_topics'] = enkripsi($_POST['id_topics']);
    header("Location: ../../view/pretest-student.php");
}

// if (isset($_GET['id_lessons'])) {
//     $_SESSION['id_lessons'] = enkripsi($_GET['id_lessons']);
//     header("Location: ../../view/pretest-student.php");
// } else 
// } else {
//     header("Location: ../../view/material-student.php?view=tampilkan");
// }
