<?php

include 'config.php';
include 'sidbar.php';

if (!isset($_SESSION['user_name'])) {
    header('location:login_form.php');
}

$select = mysqli_query($conn, "SELECT * FROM `users`  ORDER BY id DESC");


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="css/client.css">

    <title> المستخدمين</title>
</head>

<body>
    <div class="bl font1" id="form_add">
        <div class="form-cont">
            <form action="add-user.php" method="post">
                <i class="bi bi-x-circle close-icon"></i>
                <div class="icon-form">
                    <i class="bi bi-person-add"></i>

                </div>

                <div class="txt_field">
                    <input type="text" required id="" name="name" />
                    <span></span>
                    <label for=""> *الاسم المستخدم</label>
                </div>
                <div class="txt_field">
                    <input type="email" required id="" name="email" />
                    <span></span>
                    <label for=""> *بريد الكتروني</label>
                </div>

                <div class="txt_field">
                    <input type="password" required id="" name="pass" />
                    <span></span>
                    <label for="">*كلمة السر</label>
                </div>
                <div class="select">
                    <select name="rol" id="">
                        <option value="" disabled selected>دور</option>
                        <option value="admin">admin</option>
                        <option value="user">user</option>
                    </select>

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
            <div class="titel">المستخدمين </div>

            <div class="add" id="add">
                <i class="bi bi-plus-circle"></i>
                اضافة المستخدم
            </div>
        </div>
        <div class="body">

            <div class="table">
                <table>
                    <Thead>
                        <th>العمليات</th>
                        <th>دور </th>
                        <th> بريد إلكتروني</th>
                        <th> كلمة السر</th>
                        <th> الاسم الكامل</th>


                    </Thead>

                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($select)) { ?>
                            <tr>

                                <td><a onclick="deleteC(<?= $row['id'] ?>)"> <i class="bi bi-trash"></i></a></td>
                                <td><?= $row['role'] ?></td>
                                <td><?= $row['email']  ?></td>
                                <td><?= $row['pass'] ?></td>
                                <td><?= $row['nom'] ?></td>


                            </tr>

                        <?php } ?>
                    </tbody>
                </table>

            </div>


        </div>



    </div>

    <!-- form the sersh -->
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
        function deleteC(id_client) {
            alert('هل تريد حقا حذف؟');
            var xhttp = new XMLHttpRequest();
            xhttp.open("GET", "delete-use.php?id=" + id_client, true);
            xhttp.send();
            setTimeout(() => {
                location.reload();
            }, "500");
        }
    </script>


</body>

</html>