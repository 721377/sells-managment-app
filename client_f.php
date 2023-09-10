<?php
session_start();
include 'config.php';
if (!isset($_SESSION['user_name'])) {
    header('location:login_form.php');
}

$stmt = mysqli_stmt_init($conn);

if (isset($_POST['save'])) {
    $name = $_POST['name'];
    $prix =  $_POST['prix'];
    $ville = $_POST['ville'];
    $adr = $_POST['adr'];
    $tele = $_POST['tele'];


    $select = "SELECT * FROM `client` WHERE `name` = ?";
    if (!mysqli_stmt_prepare($stmt, $select)) {
        $error = "select is failed";
    } else {
        mysqli_stmt_bind_param($stmt, "s", $name);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);





        if (mysqli_num_rows($result) > 0) {
            $error = "العميل موجود بالفعل!";
        } else {

            $insert = "INSERT INTO `client`(`name`, `address`, `ville`, `tele`, `type_c`, `avance`) VALUES (?,?,?,?, 'fidele',?);";
            if (!mysqli_stmt_prepare($stmt, $insert)) {
                $error = "insert is failed";
            } else {
                mysqli_stmt_bind_param($stmt, "sssss", $name, $adr, $ville, $tele, $prix);
                mysqli_stmt_execute($stmt);
                echo '<script> alert("تمت إضافة العميل بنجاح");</script>';
            }
        }
    }
}
$select = mysqli_query($conn, "SELECT * FROM `client` WHERE `type_c` ='fidele' ORDER BY id DESC");



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

    <title> العملاء الأوفياء</title>
</head>

<body>

    <div class="bl font1" id="form_add">
        <div class="form-cont">
            <form action="" method="post">
                <i class="bi bi-x-circle close-icon"></i>
                <div class="icon-form">
                    <i class="bi bi-person-add"></i>

                </div>
                <?php if (!empty($error)) : ?>
                    <div class="error">
                        <i class="bi bi-exclamation-circle"></i><?php echo $error; ?>
                    </div>

                <?php endif; ?>

                <div class="txt_field">
                    <input type="text" required id="" name="name" />
                    <span></span>
                    <label for=""> *الاسم الكامل</label>
                </div>
                <div class="txt_field">
                    <input type="text" required id="" name="tele" />
                    <span></span>
                    <label for=""> *رقم الهاتف </label>
                </div>

                <div class="txt_field">
                    <input type="text" required id="" name="ville" />
                    <span></span>
                    <label for="">*مدينة </label>
                </div>




                <div class="txt_field">
                    <input type="text" name="adr" required id="" />
                    <span></span>
                    <label for="">*عنوان </label>
                </div>
                <div class="txt_field">
                    <input type="text" name="prix" required id="" />
                    <span></span>
                    <label for="">المبلغ المقدم </label>
                </div>


                <button class="btn" type="submit" name="save">
                    حفظ
                </button>
            </form>
        </div>
    </div>

    <div class="bl font1" id="form_det">
        <div class="form-cont2">
            <form action="add_commade.php" method="post">
                <i class="bi bi-x-circle close-icon2"></i>
                <div class="icon-form">
                    <i class="bi bi-node-plus"></i>
                </div>

                <div class="flex">
                    <div class="txt_field">
                        <input type="text" required id="" name="art" />
                        <span></span>
                        <label for=""> * كمية </label>
                    </div>
                    <div class="txt_field">
                        <input type="text" required id="" name="qun" />
                        <span></span>
                        <label for=""> * سلعة</label>
                    </div>

                </div>


                <div class="container_rad">
                    <div class="form">

                        <label>
                            <input type="radio" value="normale" name="type">
                            <span> طلبية عادية </span>
                        </label>
                        <label>
                            <input type="radio" value="livrer" name="type">
                            <span> طلبية مسلمة </span>
                        </label>
                    </div>
                </div>
                <input type="hidden" id="input" name="id_cli">

                <input class="btn" type="submit" name="save" value="  حفظ">


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
            <div class="titel"> لائحة العملاء الأوفياء</div>

            <div class="add" id="add">
                <i class="bi bi-plus-circle"></i>
                اضافة زبون
            </div>
        </div>
        <div class="body">

            <div class="table">
                <table>
                    <Thead>
                        <th colspan="3">العمليات</th>
                        <th> المبلغ المقدم </th>
                        <th>عنوان</th>
                        <th>مدينة</th>
                        <th> رقم الهاتف</th>
                        <th> الاسم الكامل</th>


                    </Thead>

                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($select)) { ?>
                            <tr>


                                <td><a href="update_client.php?id=<?= $row['id'] ?>"><i class="bi bi-pen"></i></a></td>
                                <td><a onclick="deleteC(<?php echo $row['id']; ?>)"><i class="bi bi-trash"></i></a></td>
                                <td><a class="det" onclick=" hadeldetAction(<?= $row['id'] ?>)"><i class="bi bi-bag-plus "></i></a></td>

                                <td><?= $row['avance'] ?></td>
                                <td><?= $row['address'] ?></td>
                                <td><?= $row['ville'] ?></td>
                                <td><?= $row['tele'] ?> </td>
                                <td><?= $row['name'] ?> </td>

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
    </script>








    <script>
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







        const bl2 = document.querySelector("#form_det");
        const close2 = document.querySelector(".close-icon2");
        const det = document.querySelector('.det')

        bl2.style.opacity = "0";
        bl2.style.visibility = "hidden";


        function hadeldetAction(id) {
            bl2.style.opacity = "1";
            bl2.style.visibility = "visible";
            var input = document.getElementById('input');
            input.value = id;

        };


        close2.addEventListener("click", function() {
            bl2.style.opacity = "0";
            bl2.style.visibility = "hidden";


        });
    </script>

    <script>
        function deleteC(id_client) {
            alert('هل تريد حقا حذف؟');
            var xhttp = new XMLHttpRequest();
            xhttp.open("GET", "delete_client.php?id=" + id_client, true);
            xhttp.send();
            setTimeout(() => {
                location.reload();
            }, "500");
        }
    </script>


</body>

</html>