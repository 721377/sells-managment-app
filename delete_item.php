<?php
include 'config.php';



if (isset($_GET['id'])) {

    $code = $_GET['id'];
    $type = $_GET['type'];

    try {
        $sql = "DELETE FROM `article` WHERE id=? ; ";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            echo ("delete article failed");
        } else {
            mysqli_stmt_bind_param($stmt, "i", $code);
            mysqli_stmt_execute($stmt);
        }
    } catch (Exception $e) {
        echo 'error';
    }
}
