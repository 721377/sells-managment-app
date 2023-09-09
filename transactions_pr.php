<?php
session_start();

include 'config.php';

if (!isset($_SESSION['user_name'])) {
    header('location:login_form.php');
}


$stmt = mysqli_stmt_init($conn);

if (isset($_POST['save'])) {
    $nom_f = $_POST['name'];
    $tele =  $_POST['tele'];
    $monta = $_POST['m_tot'];
    $avance = $_POST['avance'];




    $select = "SELECT * FROM `fornisseur` WHERE `name` = ?";
    if (!mysqli_stmt_prepare($stmt, $select)) {
        $error[] = "select is failed";
    } else {
        mysqli_stmt_bind_param($stmt, "s", $nom_f);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
    }
    if (mysqli_num_rows($result) > 0) {
        $error[] = "! المورد الموجود سابقا ";
    } else {

        $insert = "INSERT INTO `fornisseur`(`name`, `tele`, `total`, `avance`) VALUES (?,?,?,?);";
        if (!mysqli_stmt_prepare($stmt, $insert)) {
            $error[] = "insert is failed";
        } else {
            mysqli_stmt_bind_param($stmt, "ssss", $nom_f, $tele, $monta, $avance);
            mysqli_stmt_execute($stmt);
            header('location:transaction_pr.php');
        }
    }
}

$select = mysqli_query($conn, "SELECT * FROM `fornisseur`  ORDER BY id DESC");


include 'sidbar.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="css/client.css">


    <title>المعاملات الخاصة</title>
</head>

<body>

    <div class="bl font1" id="form_add">
        <div class="form-cont">
            <form action="" method="post">
                <i class="bi bi-x-circle close-icon"></i>
                <div class="icon-form">
                    <i class="bi bi-person-add"></i>

                </div>

                <div class="txt_field">
                    <input type="text" required id="" name="name" />
                    <span></span>
                    <label for=""> * اسم المورد</label>
                </div>
                <div class="txt_field">
                    <input type="text" required id="" name="tele" />
                    <span></span>
                    <label for=""> * رقم الهاتف</label>
                </div>
                <div class="txt_field">
                    <input type="text" required id="" name="m_tot" />
                    <span></span>
                    <label for=""> * مبلغ الاجمالي</label>
                </div>
                <div class="txt_field">
                    <input type="text" required id="" name="avance" />
                    <span></span>
                    <label for=""> * مبلغ التسبيق</label>
                </div>



                <button class="btn" type="submit" name="save">
                    حفظ
                </button>
            </form>
        </div>
    </div>



    <div class="sersh">
        <div class="group">
            <svg class="icon" aria-hidden="true" viewBox="0 0 24 24">
                <g>
                    <path d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z"></path>
                </g>
            </svg>
            <input id="searchInput" placeholder="البحث" class="input" />
        </div>
    </div>


    <div class="container">

        <div class="top">
            <div class="titel"> المعاملات الخاصة </div>

            <div class="add" id="add">
                <i class="bi bi-plus-circle"></i>
                اضافة مورد
            </div>
        </div>
        <div class="body">

            <div class="table">
                <table>
                    <Thead>
                        <th colspan="3">العمليات</th>
                        <th>مبلغ الاجمالي</th>
                        <th>مبلغ مسبق</th>
                        <th>مبلغ سلف</th>
                        <th> رقم الهاتف</th>
                        <th>اسم المورد</th>
                    </Thead>

                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($select)) { ?>
                            <tr>
                                <td><a href="delet_f.php?id=<?= $row['id'] ?>"><i class="bi bi-trash"></i></a></td>
                                <td><a href="editer_f.php?id=<?= $row['id'] ?>"><i class="bi bi-pen"></i></a></td>
                                <td><?= $row['total'] . " Dhs" ?></td>
                                <td><?= $row['avance'] . " Dhs" ?></td>
                                <td><?= $row['total'] - $row['avance'] . " Dhs" ?></td>
                                <td><?= $row['tele'] . " Dhs" ?></td>
                                <td><?= $row['name'] . " Dhs" ?></td>

                            </tr>

                        <?php } ?>
                    </tbody>
                </table>

            </div>


        </div>



    </div>


    <!-- form the sersh -->
    <script>
        $(document).ready(function() {
            $("#searchInput").on("keyup", function() {
                var searchText = $(this).val().toLowerCase(); // Get the text from the input and convert it to lowercase

                $("tbody tr ").each(function() {
                    // Loop through each row in the tbody
                    var rowText = $(this).text().toLowerCase(); // Get the text of the current row and convert it to lowercase

                    if (rowText.indexOf(searchText) === -1) {
                        // If the row text does not contain the search text, hide the row
                        $(this).hide();
                    } else {
                        // Otherwise, show the row
                        $(this).show();
                    }
                });
            });
        });



        const bl = document.querySelector("#form_add");
        const close = document.querySelector(".close-icon");
        const add = document.querySelector("#add");

        if (sessionStorage.getItem("add") === "false") {
            sessionStorage.setItem("add", false);
        }

        add.addEventListener("click", function() {
            bl.style.opacity = "1";
            bl.style.visibility = "visible";
            sessionStorage.setItem("add", true);
        });

        if (sessionStorage.getItem("add") === "true") {
            bl.style.opacity = "1";
            bl.style.visibility = "visible";
        }

        close.addEventListener("click", function() {
            bl.style.opacity = "0";
            bl.style.visibility = "hidden";
            sessionStorage.setItem("add", false);
        });
    </script>

</body>

</html>