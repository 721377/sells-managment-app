<?php
include 'config.php';
include 'cryptfunction.php';
$stmt = mysqli_stmt_init($conn);

$art = $_POST['art'];
$qun =  $_POST['qun'];
$type = $_POST['type'];
$id_cli = $_POST['id_cli'];
$totale = $qun * $art;


//select the client for the header 
$sql = "SELECT * FROM client WHERE id=?";
if (!mysqli_stmt_prepare($stmt, $sql)) {
    echo "error";
} else {
    mysqli_stmt_bind_param($stmt, "i", $id_cli);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row_c = mysqli_fetch_assoc($result);
}







//creat the sql commande
if ($type == "normale") {

    //select the commandes for the header 
    $sql = "SELECT * FROM `commande_local` WHERE id_client	=?";
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "error";
    } else {
        mysqli_stmt_bind_param($stmt, "i", $id_cli);
        mysqli_stmt_execute($stmt);
        $result_commande = mysqli_stmt_get_result($stmt);
        if (mysqli_num_rows($result_commande) > 0) {
            header('location:commande_normale.php?id=' . encryptId($row_c['name']));
        } else {
            $insert = "INSERT INTO `commande_local`(`id_client`, `etape`, `total`, `avance`) VALUES (?,'etape1',?,0);";
        }
    }
} else {

    //select the commandes for the header 
    $sql = "SELECT * FROM `commande_online` WHERE id_client	=?";
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "error";
    } else {
        mysqli_stmt_bind_param($stmt, "i", $id_cli);
        mysqli_stmt_execute($stmt);
        $result_commande = mysqli_stmt_get_result($stmt);
        if (mysqli_num_rows($result_commande) > 0) {
            header('location:commande_livrer.php?id=' .  encryptId($row_c['name']));
        } else {
            $insert = "INSERT INTO `commande_online`(`id_client`, `etape`, `total`, `avance`) VALUES (?,'etape1',?,0);";
        }
    }
}


if ($insert) {
    if (!mysqli_stmt_prepare($stmt, $insert)) {
        $error[] = "insert is failed";
    } else {
        mysqli_stmt_bind_param($stmt, "ss", $id_cli, $totale);
        mysqli_stmt_execute($stmt);

        if ($row_c['type_c'] == "fidele") {
            header('location:client_f.php');
        } else {
            header('location:client_n.php');
        }
    }
}
