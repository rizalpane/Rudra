<?php
include '../../app/config/database.php';
include '../../app/config/filter.php';
session_start();
filterLoginToTeacher($_SESSION['group']);


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

    <section class="">

        <div class="row g-0">
            <div class="col">

                <div class="text-bg-primary p-5">
                    <div class="container">
                        Selamat Datang <strong><?= $_SESSION['name']; ?></strong>
                    </div>
                </div>
            </div>

    </section>

</body>

</html>