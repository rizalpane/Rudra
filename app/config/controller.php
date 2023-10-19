<?php
include 'database.php';
session_start();


if (isset($_POST['postLogin'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!empty($email) && !empty($password)) {
        $sql = "SELECT * FROM users 
            INNER JOIN major ON users.id_major = major.id_major 
            INNER JOIN grade ON users.id_grade = grade.id_grade 
            WHERE email=?";

        $stmt = mysqli_prepare($setDbConfiguration, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($row = mysqli_fetch_assoc($result)) {
                $hashed_password = $row['password'];

                // Verifikasi password
                if (password_verify($password, $hashed_password)) {
                    // Password cocok
                    if ($row['group'] == "student") {
                        session_start();
                        $_SESSION['id_users'] = $row['id_users'];
                        $_SESSION['name'] = $row['name'];
                        $_SESSION['group'] = $row['group'];
                        $_SESSION['email'] = $row['email'];
                        $_SESSION['kelas'] = $row['name_grade'];
                        $_SESSION['jurusan'] = $row['name_major'];

                        header("location:../../view/dashboard-student.php");
                    } elseif ($row['group'] == "teacher") {
                        session_start();
                        $_SESSION['id_users'] = $row['id_users'];
                        $_SESSION['name'] = $row['name'];
                        $_SESSION['email'] = $row['email'];
                        $_SESSION['group'] = $row['group'];
                        $_SESSION['kelas'] = $row['name_grade'];
                        $_SESSION['jurusan'] = $row['name_major'];

                        header("location:../../view/admin/dashboard-teacher.php");
                    } else {
                        // Group tidak sesuai
                        header("location:../../view/login-page.php");
                    }
                } else {
                    // Password salah
                    header("location:../../view/login-page.php");
                }
            } else {
                // Email tidak ditemukan
                header("location:../../view/login-page.php");
            }
        } else {
            // Error dalam prepared statement
            header("location:../../view/login-page.php");
        }
    } else {
        // Email atau password kosong
        header("location:../../view/login-page.php");
    }
}




if (isset($_POST['postAddUser'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $group = $_POST['group'];
    $id_grade = $_POST['id_grade'];
    $id_major = $_POST['id_major'];

    $stmt = mysqli_prepare($setDbConfiguration, "INSERT INTO users (name, email, password, `group`, id_grade, id_major) VALUES (?, ?, ?, ?, ?, ?)");

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssssii", $name, $email, $password, $group, $id_grade, $id_major);

        if (mysqli_stmt_execute($stmt)) {
            header("location:/spb-vanila/view/admin/users.php");
        } else {
            header("location:/spb-vanila/view/admin/users.php");
        }
    } else {
        header("location:/spb-vanila/view/admin/users.php");
    }
}

if (isset($_POST['postRegister'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $group = $_POST['group'];
    $id_grade = $_POST['id_grade'];
    $id_major = $_POST['id_major'];

    $stmt = mysqli_prepare($setDbConfiguration, "INSERT INTO users (name, email, password, `group`, id_grade, id_major) VALUES (?, ?, ?, ?, ?, ?)");

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssssii", $name, $email, $password, $group, $id_grade, $id_major);

        if (mysqli_stmt_execute($stmt)) {
            header("location:/spb-vanila/index.php");
        } else {
            header("location:/spb-vanila/index.php");
        }
    } else {
        header("location:/spb-vanila/index.php");
    }
}


if (isset($_POST['postUpdateUser'])) {
    $id_users = $_POST['id_users'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $newPassword = $_POST['new_password'];
    $id_major = $_POST['id_major'];
    $id_grade = $_POST['id_grade'];

    if ($newPassword) {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        $stmt = mysqli_prepare($setDbConfiguration, "UPDATE users SET name=?, email=?, password=?, id_major=?, id_grade=? WHERE id_users=?");

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "sssiii", $name, $email, $hashedPassword, $id_major, $id_grade, $id_users);

            if (mysqli_stmt_execute($stmt)) {
                header("location:/spb-vanila/view/admin/users.php");
            } else {
                header("location:/spb-vanila/view/admin/users.php");
            }
        } else {
            header("location:/spb-vanila/view/admin/users.php");
        }
    } else {
        $stmt = mysqli_prepare($setDbConfiguration, "UPDATE users SET name=?, email=?, id_major=?, id_grade=? WHERE id_users=?");

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ssiii", $name, $email, $id_major, $id_grade, $id_users);

            if (mysqli_stmt_execute($stmt)) {
                header("location:/spb-vanila/view/admin/users.php");
            } else {
                header("location:/spb-vanila/view/admin/users.php");
            }
        } else {
            header("location:/spb-vanila/view/admin/users.php");
        }
    }
}


if (isset($_POST['deleteUser'])) {
    $id_users = $_POST['id_users'];
    if (is_numeric($id_users)) {
        $sqlDeleteUser = mysqli_query($setDbConfiguration, "DELETE FROM users WHERE id_users = '$id_users'");
        header("location:/spb-vanila/view/admin/users.php");
    } else {
        header("location:/spb-vanila/view/admin/users.php?hapus=gagal");
    }
}
