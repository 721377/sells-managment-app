<?php
include 'config.php';

$id = $_GET['id'];
$etape = $_GET['etape'];
$totale = 0;
$date = date('Y M D');
$liv = $_GET['nlive'];

if (empty($liv)) {
    $result = mysqli_query($conn, "UPDATE `commande_online` SET `etape`='$etape' WHERE id = '$id'");
} else {
    $result = mysqli_query($conn, "UPDATE `commande_online` SET `etape`='$etape', `N_livraison`='$liv' WHERE id = '$id'");
}

if ($result) {
    if ($etape == "etape2") {
        $select = mysqli_query($conn, "SELECT c.tele FROM commande_online cm , client c  WHERE cm.id_client = c.id and cm.id = '$id';");
        $row = mysqli_fetch_assoc($select);
        $tele = $row['tele'];
        mysqli_query($conn, "DELETE FROM `credit` WHERE tele = '$tele';");
    }
    if ($etape == "etape4") {
        $select2 = mysqli_query($conn, "SELECT * FROM commande_online  WHERE id = '$id';");
        $row2 = mysqli_fetch_assoc($select2);

        $id_client = $row2['id_client'];
        $liv = $row2['N_livraison'];

        $select_articles = mysqli_query($conn, "SELECT * FROM `article` WHERE id_client = '$id_client'");
        while ($row_art = mysqli_fetch_assoc($select_articles)) {
            $totale += $row_art['prix'] * $row_art['quantite'];
        }
        $insert = mysqli_query($conn, "INSERT INTO `command_fini`(`id_client`, `N_livraison`, `type`, `total`, `date`) VALUES ('$id_client','$liv','livrer','$totale','$date')");
        if ($insert) {
            mysqli_query($conn, "DELETE FROM `commande_online` WHERE id= '$id' ");
        }
    }
}
