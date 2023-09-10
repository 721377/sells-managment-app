<?php
include 'config.php';
$stmt = mysqli_stmt_init($conn);

$item = $_POST['item'];
$qty = $_POST['qty'];
$client = $_POST['client'];
$type_comm = $_POST['type_comm'];



$insert_art = "INSERT INTO article(prix, quantite, id_client) VALUES (?,?,?)";
if (!mysqli_stmt_prepare($stmt, $insert_art)) {
    echo "Error: SQL prepare failed for article insertion";
} else {
    mysqli_stmt_bind_param($stmt, "ssi", $item, $qty, $client);
    mysqli_stmt_execute($stmt);
    if ($type_comm  == "livrer") {
        header('location:commande_livrer.php');
    } else {
        header('location:commande_normale.php');
    }
}
