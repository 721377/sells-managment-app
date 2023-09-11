<?php
include 'config.php';
$date = date('Y M D');

$id_c = $_GET['id_c'];
$id_comm = $_GET['id_comm'];
$type = $_GET['type'];
$totale = 0;

$select_articles = mysqli_query($conn, "SELECT * FROM `article` WHERE id_client = '$id_c'");
while ($row_art = mysqli_fetch_assoc($select_articles)) {
    $totale += $row_art['prix'] * $row_art['quantite'];
}

if ($type == "normale") {
    $insert_N = mysqli_query($conn, "INSERT INTO `command_fini`(`id_client`, `type`, `total`, `date`) VALUES ('$id_c' , '$type' , '$totale' , '$date')");
    if ($insert_N) {
        mysqli_query($conn, "DELETE FROM `article` WHERE id_client='$id_c'");
        mysqli_query($conn, "DELETE FROM `commande_local` WHERE id_client='$id_c'");
        $select_client = mysqli_query($conn, "SELECT * FROM client WHERE id = '$id_c'");
        $row_c = mysqli_fetch_assoc($select_client);
        $tele = $row_c['tele'];
        mysqli_query($conn, "DELETE FROM `credit` WHERE tele='$tele'");
    }
}
