<?php
include 'config.php';
$stmt = mysqli_stmt_init($conn);

if (isset($_GET['id_client'])) {
    $id = $_GET['id_client'];


    $result = mysqli_query($conn,  "SELECT * FROM article WHERE id_client = '$id'");

    $responseData = array();

    while ($data = mysqli_fetch_assoc($result)) {
        $responseData[] = array(
            'id' => $data['id'],
            'prix' => $data['prix'],
            'quantite' => $data['quantite'],
        );
    }

    echo json_encode($responseData);
} else {
    echo "Error: id_client parameter is missing";
}
