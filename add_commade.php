<?php
include 'config.php';
$stmt = mysqli_stmt_init($conn);
$art = $_POST['art'];
$qun =  $_POST['qun'];
$type = $_POST['type'];
$id_cli = $_POST['id_cli'];


$totale = $qun * $art;


if ($type == "normale") {
    $insert = "INSERT INTO `commande_local`(`id_client`, `etape`, `total`, `avance`) VALUES (?,'etape1',?,0);";
} else {
    $insert = "INSERT INTO `commande_online`(`id_client`, `etape`, `total`, `avance`) VALUES (?,'etape1',?,0);";
}


if (!mysqli_stmt_prepare($stmt, $insert)) {
    $error[] = "insert is failed";
} else {
    mysqli_stmt_bind_param($stmt, "ss", $id_cli, $totale);
    mysqli_stmt_execute($stmt);
    header('location:client_f.php');
}
