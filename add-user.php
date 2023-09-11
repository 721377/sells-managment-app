<?php
include 'config.php';


$stmt = mysqli_stmt_init($conn);


$nom = $_POST['name'];
$email =  $_POST['email'];
$pass = $_POST['pass'];
$rol = $_POST['rol'];





$select = "SELECT * FROM `users` WHERE `nom` = ?";
if (!mysqli_stmt_prepare($stmt, $select)) {
    $error[] = "select is failed";
} else {
    mysqli_stmt_bind_param($stmt, "s", $nom);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
}



if (mysqli_num_rows($result) > 0) {
    $error[] = "! المستخدم الموجود سابقا ";
} else {

    $insert = "INSERT INTO `users`(`nom`, `email`, `pass`, `role`) VALUES (?,?,?,?);";
    if (!mysqli_stmt_prepare($stmt, $insert)) {
        $error[] = "insert is failed";
    } else {
        mysqli_stmt_bind_param($stmt, "ssss", $nom, $email, $pass, $rol);
        mysqli_stmt_execute($stmt);
        header('location:users.php');
    }
}
