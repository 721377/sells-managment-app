<?php

include 'config.php';


session_start();
if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = $_POST['pass'];

    $sql = "SELECT * FROM users WHERE email = ? && pass = ?";

    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header('location:login_form.php');
        $error = 'Erreur de préparation de la requête.';
    } else {
        mysqli_stmt_bind_param($stmt, "ss", $email, $pass);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($result);

        if (!$row) {
            $error = 'Votre mot de passe ou email est incorrect.';
        } else {
            $_SESSION['user_name'] = $row['nom'];
            header('location:index.php');
        }
    }
}




?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login form</title>


   <link rel="stylesheet" href="styl.css">

</head>
<body>
<div class="container">

        <div class="box">
            <div class="left">
                <div class="img"></div>
            </div>
            <form class="right" action="" method="post">
                <h2>Log-in</h2>
               
                <?php if (!empty($error)): ?>
                    <div class="error" >
                        <i class="bi bi-exclamation-circle"></i><?php echo $error; ?>
                    </div>
             
                    <?php endif; ?>

                <div class="email">
                    <label for="email">Email</label>
                    <input type="email" class="text" name="email" placeholder="email" id="email">
                </div>
                <div class="pass">
                    <label for="pass">Mot de passe</label>
                    <input type="password" class="text" placeholder="mot de passe" name="pass" id="pss">
                </div>


                <div id="ajou"> <input name="submit" type="submit" class="submit" value="connecter"></div>


            </form>

        </div>
    </div>


</body>
</html>