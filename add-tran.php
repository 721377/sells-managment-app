<?php
include 'config.php';
$stmt = mysqli_stmt_init($conn);

if (isset($_POST['save'])) {
    $nom_f = $_POST['name'];
    $tele =  $_POST['tele'];
    $monta = $_POST['m_tot'];
    $avance = $_POST['avance'];




    $select = "SELECT * FROM `fornisseur` WHERE `name` = ?";
    if (!mysqli_stmt_prepare($stmt, $select)) {
        $error[] = "select is failed";
    } else {
        mysqli_stmt_bind_param($stmt, "s", $nom_f);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
    }
    if (mysqli_num_rows($result) > 0) {
        $error[] = "! المورد الموجود سابقا ";
    } else {

        $insert = "INSERT INTO `fornisseur`(`name`, `tele`, `total`, `avance`) VALUES (?,?,?,?);";
        if (!mysqli_stmt_prepare($stmt, $insert)) {
            $error[] = "insert is failed";
        } else {
            mysqli_stmt_bind_param($stmt, "ssss", $nom_f, $tele, $monta, $avance);
            mysqli_stmt_execute($stmt);
            header('location:transactions_pr.php');
        }
    }
}
