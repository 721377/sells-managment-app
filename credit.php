<?php

include 'config.php';
include 'sidbar.php';

if (!isset($_SESSION['user_name'])) {
    header('location:login_form.php');
}
$date = date('Y M D');
$select_dis = mysqli_query($conn, "SELECT DISTINCT id_client FROM `article`;");

while ($row_dis = mysqli_fetch_assoc($select_dis)) {
    $montant = 0;
    $id_client = $row_dis['id_client'];
    $total = 0; // Initialize total outside of the inner loop
    $avance = 0; // Initialize avance outside of the inner loop

    $select = mysqli_query($conn, "SELECT `prix`, `quantite`,`name`, `tele`, `avance` FROM `article` a , `client` c WHERE c.id = a.id_client and c.id = '$id_client';");

    while ($row_client = mysqli_fetch_assoc($select)) {
        // Calculate the total for each client
        $total += $row_client['prix'] * $row_client['quantite'];
        $name = $row_client['name'];
        $tele = $row_client['tele'];
        $avance = $row_client['avance']; // Update avance for each client
    }

    if (mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `credit` WHERE name = '$name'")) == 0) {
        if ($total > $avance) {
            $montant = $total - $avance;
            echo ($montant);
            mysqli_query($conn, "INSERT INTO `credit`(`name`, `montant`, `tele`, `dat`) VALUES('$name' , '$montant' , '$tele', '$date')");
        }
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="css/client.css">


    <title>ائتمان</title>
</head>

<body>


    <div class="bl font1" id="form_add">
        <div class="form-cont">
            <form action="add_credit.php" method="post">
                <i class="bi bi-x-circle close-icon"></i>
                <div class="icon-form">
                    <i class="bi bi-person-add"></i>

                </div>


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
                    <input type="text" required id="" name="totale" />
                    <span></span>
                    <label for="">*المبلغ </label>
                </div>


                <button class="btn" type="submit">
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
            <div class="titel"> ائتمان </div>

            <div class="add" id="add">
                <i class="bi bi-plus-circle"></i>
                اضافة زبون
            </div>
        </div>
        <div class="body">

            <div class="table">
                <table>
                    <Thead>
                        <th>العمليات</th>
                        <th>تاريخ</th>
                        <th>مبلغ سلف</th>
                        <th> رقم الهاتف</th>
                        <th> اسم الزبون</th>
                    </Thead>

                    <tbody>
                        <?php
                        $select_credit = mysqli_query($conn, "SELECT * FROM `credit`");
                        while ($row = mysqli_fetch_assoc($select_credit)) {
                        ?>
                            <tr>
                                <td><a onclick="deleteC(<?php echo $row['id']; ?>)"><i class="bi bi-trash"></i></a></td>
                                <td><?= $row['dat'] ?> </td>
                                <td><?= $row['montant'] ?> </td>
                                <td> <?= $row['tele'] ?> </td>
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

</body>



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
</script>

<script>
    function deleteC(id_client) {
        alert('هل تريد حقا حذف؟');
        var xhttp = new XMLHttpRequest();
        xhttp.open("GET", "delete_Credit.php?id=" + id_client, true);
        xhttp.send();
        setTimeout(() => {
            location.reload();
        }, "500");
    }
</script>

</html>