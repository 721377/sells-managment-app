<?php
include 'config.php';



if (isset($_GET['id'])) {

    $code = $_GET['id'];

    try {
        $sql = "DELETE FROM `users` WHERE id=? ; ";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            echo ("delete client failed");
        } else {
            mysqli_stmt_bind_param($stmt, "i", $code);
            mysqli_stmt_execute($stmt);
            header('location:users.php');
        }
    } catch (Exception $e) {
        echo 'error';
    }
}
