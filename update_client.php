<?php
include 'config.php';
$stmt = mysqli_stmt_init($conn);

if (isset($_GET['id'])) {


    $code = $_GET['id'];

    $sql = "SELECT * FROM client WHERE id=?";
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "error";
    } else {
        mysqli_stmt_bind_param($stmt, "i", $code);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);
    }
}


//partie modification
if (isset($_POST['save'])) {



    $name = $_POST['name'];
    $ville = $_POST['ville'];
    $adr = $_POST['adr'];
    $tele = $_POST['tele'];
    $prix = $_POST['prix'];;

    $sql = "UPDATE client SET name = ?, address=?,ville=? ,tele=?  ,avance=? where id=?";

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        echo "error";
    } else {
        mysqli_stmt_bind_param($stmt, "sssssi", $name, $adr, $ville, $tele, $prix, $code);
        mysqli_stmt_execute($stmt);
        header('location:client_f.php');
    }
}





?>