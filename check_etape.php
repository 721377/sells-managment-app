<?php
include 'config.php';

$id = $_GET['id'];
$select = mysqli_query($conn, "SELECT * FROM commande_online WHERE id = '$id';");
$row = mysqli_fetch_assoc($select);

$responseData = array(
    'var' => $row['etape'],
);

header('Content-Type: application/json');
echo json_encode($responseData);
