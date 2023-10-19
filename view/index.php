<?php
session_start();

if ($_SESSION['email'] && $_SESSION['password']) {
    if ($_SESSION['group'] == "student") {
        header("location:dashboard-student.php");
    } elseif ($_SESSION['group'] == "teacher") {
        header("location:dashboard-teacher.php");
    } else {
        header("location:login-page.php");
    }
} else {
    header("location:login-page.php");
}
