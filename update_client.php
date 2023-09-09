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


    $select = "SELECT * FROM `client` WHERE `name` = ?";
    if (!mysqli_stmt_prepare($stmt, $select)) {
        $error = "select is failed";
    } else {
        mysqli_stmt_bind_param($stmt, "s", $name);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $row_c = mysqli_fetch_assoc($result);

        $sql = "UPDATE client SET name = ?, address=?,ville=? ,tele=?  ,avance=? where id=?";

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            echo "error";
        } else {
            mysqli_stmt_bind_param($stmt, "sssssi", $name, $adr, $ville, $tele, $prix, $code);
            mysqli_stmt_execute($stmt);

            if ($row_c['type_c'] == "fidele") {
                header('location:client_f.php');
            } else {
                header('location:client_n.php');
            }
        }
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

<<<<<<< HEAD
=======
          
>>>>>>> 2c19ebdf6967f8205741907bf7744da755699b48

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