<?php
include 'hash.php';
include 'database.php';

if (isset($_POST['postAnswerPretest'])) {

    if (empty($_POST['record_answer'])) {
        header("Location: /spb-vanila/view/pretest-student.php");
        exit();
    }

    $answer = $_POST['record_answer'];
    $stringAnswer = implode(' ', $answer);

    $id_test = $_POST['id_test'];
    $id_users = $_POST['id_users'];
    $id_topics = $_POST['id_topics'];


    $score  = 0;
    $true   = 0;
    $false  = 0;
    $empty  = 0;

    $sqlSelectPretestValue = mysqli_query($setDbConfiguration, "SELECT * FROM questions WHERE id_topics = '$id_topics' ");
    $numrow = mysqli_num_rows($sqlSelectPretestValue);

    for ($i = 0; $i < $numrow; $i++) {
        $row = mysqli_fetch_assoc($sqlSelectPretestValue);

        $id_test = $row['id_test'];

        if (isset($answer[$id_test])) {

            $answers = $answer[$id_test];

            $sqlSelectPretestKey = mysqli_query($setDbConfiguration, "SELECT * FROM questions WHERE id_test = '$id_test' AND key_test = '$answers'");
            $checkAnswer = mysqli_num_rows($sqlSelectPretestKey);

            if ($checkAnswer) {
                $true++;
            } else {
                $false++;
            }
        } else {
            $empty++;
        }
    }

    $pointPretest = ($true / $numrow) * 100;

    $point_pretest  = $pointPretest;
    $true_pretest   = $true;
    $false_pretest  = $false;
    $empty_pretest  = $empty;

    $stmt = mysqli_prepare($setDbConfiguration, "INSERT INTO answer (answer_pretest, point_pretest, true_pretest, false_pretest, id_users, id_topics) VALUES (?, ?, ?, ?, ?, ?)");
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "siiiii", $stringAnswer, $point_pretest, $true_pretest, $false_pretest, $id_users, $id_topics);
        if (mysqli_stmt_execute($stmt)) {
            header("location:/spb-vanila/view/pretest-student.php?view=$_SESSION[id_topics]");
        } else {
            header("location:/spb-vanila/view/pretest-student.php?view=$_SESSION[id_topics]");
        }
    } else {
        header("location:/spb-vanila/view/pretest-student.php?view=$_SESSION[id_topics]");
    }
}

if (isset($_POST['postAnswerPostest'])) {

    if (empty($_POST['record_answer'])) {
        header("Location: /spb-vanila/view/postest-student.php");
        exit();
    }

    $answer = $_POST['record_answer'];
    $stringAnswer = implode(' ', $answer);
    $id_test = $_POST['id_test'];
    $id_users = $_POST['id_users'];
    $id_topics = $_POST['id_topics'];

    $score  = 0;
    $true   = 0;
    $false  = 0;
    $empty  = 0;

    $sqlSelectpostestValue = mysqli_query($setDbConfiguration, "SELECT * FROM questions WHERE id_topics = '$id_topics' ");
    $numrow = mysqli_num_rows($sqlSelectpostestValue);

    for ($i = 0; $i < $numrow; $i++) {
        $row = mysqli_fetch_assoc($sqlSelectpostestValue);

        $id_test = $row['id_test'];

        if (isset($answer[$id_test])) {
            $answers = $answer[$id_test];

            $sqlSelectpostestKey = mysqli_query($setDbConfiguration, "SELECT * FROM questions WHERE id_test = '$id_test' AND key_test = '$answers'");
            $checkAnswer = mysqli_num_rows($sqlSelectpostestKey);

            if ($checkAnswer) {
                $true++;
            } else {
                $false++;
            }
        } else {
            $empty++;
        }
    }

    $pointpostest = ($true / $numrow) * 100;

    $point_postest  = $pointpostest;
    $true_postest   = $true;
    $false_postest  = $false;
    $empty_postest  = $empty;

    $stmt = mysqli_prepare($setDbConfiguration, "UPDATE answer SET answer_postest=?, point_postest=?, true_postest=?, false_postest=? WHERE id_users = ?");
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "siiii", $stringAnswer, $point_postest, $true_postest, $false_postest, $id_users);
        if (mysqli_stmt_execute($stmt)) {
            header("location:/spb-vanila/view/postest-student.php");
        } else {
            header("location:/spb-vanila/view/postest-student.php");
        }
    } else {
        header("location:/spb-vanila/view/postest-student.php");
    }
}


if (isset($_POST['postAddQuestions'])) {
    $questions = $_POST['question'];
    $a = $_POST['option_a'];
    $b = $_POST['option_b'];
    $c = $_POST['option_c'];
    $d = $_POST['option_d'];
    $key = $_POST['key_test'];
    $id_topics = $_POST['id_topics'];

    $stmt = mysqli_prepare($setDbConfiguration, "INSERT INTO questions (question, option_a, option_b, option_c, option_d, key_test, id_topics) VALUES (?, ?, ?, ?, ?, ?, ?)");
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssssssi", $questions, $a, $b, $c, $d, $key, $id_topics);
        if (mysqli_stmt_execute($stmt)) {
            header("location:/spb-vanila/view/admin/test.php");
        } else {
            die("Kueri SQL gagal: " . mysqli_error($setDbConfiguration));
            // header("location:/spb-vanila/view/admin/test.php");
        }
    } else {
        die("Kueri SQL gagal: " . mysqli_error($setDbConfiguration));
        // header("location:/spb-vanila/view/admin/test.php");
    }
}

if (isset($_POST['postUpdateQuestions'])) {
    $id_test = $_POST['id_test'];
    $questions = $_POST['question'];
    $a = $_POST['option_a'];
    $b = $_POST['option_b'];
    $c = $_POST['option_c'];
    $d = $_POST['option_d'];
    $key = $_POST['key_test'];


    $stmt = mysqli_prepare($setDbConfiguration, "UPDATE questions SET question=?, option_a=?, option_b=?, option_c=?, option_d=?, key_test=? WHERE id_test=?");
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssssssi", $questions, $a, $b, $c, $d, $key, $id_test);
        if (mysqli_stmt_execute($stmt)) {
            $v = rawurldecode(enkripsi('tambah data berhasil'));
            header("location:/spb-vanila/view/admin/test.php?v=$v");
        } else {
            die("Kueri SQL gagal: " . mysqli_error($setDbConfiguration));
        }
    } else {
        die("Kueri SQL gagal: " . mysqli_error($setDbConfiguration));
    }
}


if (isset($_POST['postDeleteQuestions'])) {
    $id_test = $_POST['id_test'];
    if (is_numeric($id_test)) {
        $sqlDeletQuestions = mysqli_query($setDbConfiguration, "DELETE FROM questions WHERE id_test = '$id_test'");
        header("location:/spb-vanila/view/admin/test.php");
    } else {
        die("Kueri SQL gagal: " . mysqli_error($setDbConfiguration));
        // header("location:/spb-vanila/view/admin/test.php");
    }
}

if (isset($_POST['postDeleteQuestionsAll'])) {
    $id_topics = $_POST['id_topics'];
    $sqlQuestionsCheck = mysqli_query($setDbConfiguration, "SELECT * FROM questions 
    WHERE id_topics = '$id_topics' ");
    $checkQuestions = mysqli_num_rows($sqlQuestionsCheck);

    if ($checkQuestions === 0) {
        header("location:/spb-vanila/view/admin/test.php");
        exit();
    }

    if (is_numeric($id_topics)) {
        $sqlDeletQuestionsAll = mysqli_query($setDbConfiguration, "DELETE FROM questions WHERE id_topics = '$id_topics'");
        header("location:/spb-vanila/view/admin/test.php");
    } else {
        die("Kueri SQL gagal: " . mysqli_error($setDbConfiguration));
        // header("location:/spb-vanila/view/admin/test.php");
    }
}

if (isset($_POST['postDeleteAnswer'])) {
    $id_answer = $_POST['id_answer'];
    if (is_numeric($id_answer)) {
        $sqlDeletAnswer = mysqli_query($setDbConfiguration, "DELETE FROM answer WHERE id_answer = '$id_answer'");
        header("location:/spb-vanila/view/admin/test.php");
    } else {
        die("Kueri SQL gagal: " . mysqli_error($setDbConfiguration));
        // header("location:/spb-vanila/view/admin/test.php");
    }
}

if (isset($_POST['postDeleteAnswerAll'])) {
    $id_topics = $_POST['id_topics'];
    $sqlTopicsCheck = mysqli_query($setDbConfiguration, "SELECT * FROM answer 
    WHERE id_topics = '$id_topics' ");
    $checkTopics = mysqli_num_rows($sqlTopicsCheck);

    if ($sqlTopicsCheck === 0) {
        header("location:/spb-vanila/view/admin/test.php");
        exit();
    }

    if (is_numeric($id_topics)) {
        $sqlDeleteAnswerAll = mysqli_query($setDbConfiguration, "DELETE FROM answer WHERE id_topics = '$id_topics'");
        $sqlDeleteAutoIncrement = mysqli_query($setDbConfiguration, "ALTER TABLE answer AUTO_INCREMENT = 1");
        header("location:/spb-vanila/view/admin/test.php");
    } else {
        header("location:/spb-vanila/view/admin/test.php");
    }
}
