<?php
include 'config.php';
$stmt = mysqli_stmt_init($conn);

if (isset($_GET['id'])) {


    $code = $_GET['id'];

    $sql = "SELECT * FROM `fornisseur` WHERE id=?";
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
        $tele = $_POST['tele'];
        $total= $_POST['total'];
        $avance = $_POST['avance'];
  

        $sql = "UPDATE `fornisseur` SET name = ?, tele =?, total=?  ,avance=? where id=?";

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            echo "error";
        } else {
            mysqli_stmt_bind_param($stmt, "sssss", $name, $tele, $total, $avance , $code);
            mysqli_stmt_execute($stmt);
            header('location:transactions_pr.php');
        
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
         
            

                <div class="icon-form">
                    <i class="bi bi-person-add"></i>

                </div>

                <div class="txt_field">
                    <input type="text" required id="" name="name" value="<?= $row['name'] ?>" />
                    <span></span>
                    <label for=""> *الاسم الكامل</label>
                </div>
                <div class="txt_field">
                    <input type="text" required id="" name="tele" value="<?= $row['tele'] ?>" />
                    <span></span>
                    <label for=""> *رقم الهاتف </label>
                </div>

                <div class="txt_field">
                    <input type="text" required id="" name="total" value="<?= $row['total'] ?>" />
                    <span></span>
                    <label for="">*مبلغل اجمالي </label>
                </div>



                <div class="txt_field">
                    <input type="text" name="avance" required id="" value="<?= $row['avance'] ?>"/>
                    <span></span>
                    <label for="">*تسبيق</label>
                </div>
                


                <button class="btn" type="submit" name="save">
                    حفظ
                </button>
            </form>
        </div>
    </div>

</body>

</html>