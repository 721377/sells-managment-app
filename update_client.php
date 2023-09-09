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


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>update</title>
    <link rel="stylesheet" href="css/update_form.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />

</head>

<body>
    <div class="bl font1" id="form_add">
        <div class="form-cont">
            <form action="" method="post">

                <?php
                if (isset($error)) {
                    foreach ($error as $error) {

                        echo '<div class="error" id="acc">
                 <i class="fa-solid fa-circle-exclamation"></i>
                <p>' . $error . '</p>
                 </div>';
                    };
                };

                ?>

                <div class="icon-form">
                    <i class="bi bi-person-add"></i>

                </div>

                <div class="txt_field">
                    <input type="text" required id="" value="<?= $row['name'] ?>" name="name" />
                    <span></span>
                    <label for=""> *الاسم الكامل</label>
                </div>
                <div class="txt_field">
                    <input type="text" required id="" value="<?= $row['tele'] ?>" name="tele" />
                    <span></span>
                    <label for=""> *رقم الهاتف </label>
                </div>

                <div class="txt_field">
                    <input type="text" required id="" value="<?= $row['ville'] ?>" name="ville" />
                    <span></span>
                    <label for="">*مدينة </label>
                </div>




                <div class="txt_field">
                    <input type="text" name="adr" value="<?= $row['address'] ?>" required id="" />
                    <span></span>
                    <label for="">*عنوان </label>
                </div>
                <div class="txt_field">
                    <input type="text" name="prix" value="<?= $row['avance'] ?>" required id="" />
                    <span></span>
                    <label for="">المبلغ المقدم </label>
                </div>


                <button class="btn" type="submit" name="save">
                    حفظ
                </button>
            </form>
        </div>
    </div>

</body>

</html>