<?php
include 'config.php';
$stmt = mysqli_stmt_init($conn);

$name = $_POST['name'];
$totale = $_POST['totale'];
$tele = $_POST['tele'];
$date = date('Y-m-d');



$insert = "INSERT INTO `credit`(`name`, `montant`, `tele`, `dat`) VALUES(?,?,?,?)";
if (!mysqli_stmt_prepare($stmt, $insert)) {
    echo "Error: SQL prepare failed for article insertion";
} else {
    mysqli_stmt_bind_param($stmt, "ssis", $name, $totale, $tele, $date);
    mysqli_stmt_execute($stmt);
    header('location:credit.php');
}
