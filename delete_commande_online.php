<?php
include 'config.php';

if (isset($_GET['id'])) {
    $code = $_GET['id'];

    // First Query
    $sql1 = "DELETE FROM `article` WHERE id_client=?;";
    $stmt1 = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt1, $sql1)) {
        echo ("delete article failed");
    } else {
        mysqli_stmt_bind_param($stmt1, "i", $code);
        mysqli_stmt_execute($stmt1);

        // Second Query
        $sql2 = "DELETE FROM `commande_online` WHERE id_client=?;";
        $stmt2 = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt2, $sql2)) {
            echo ("delete client failed");
        } else {
            mysqli_stmt_bind_param($stmt2, "i", $code);
            mysqli_stmt_execute($stmt2);
            header('location:commande_livrer.php');
        }
    }
}
