<?php

include 'config.php';
include 'cryptfunction.php';
include 'sidbar.php';
if (!isset($_SESSION['user_name'])) {
    header('location:login_form.php');
}




$select = mysqli_query($conn, "SELECT cm.id as id_comm, c.id as id_c, c.name, c.tele, c.avance, c.ville, c.address, c.type_c FROM commande_local cm, client c WHERE c.id = cm.id_client;");


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="css/client.css">

    <title> الطلبات عادية</title>
</head>

<body>



    <div class="sersh">
        <div class="group">
            <svg class="icon" aria-hidden="true" viewBox="0 0 24 24">
                <g>
                    <path d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z"></path>
                </g>
            </svg>
            <input id="searchInput" value="<?php
                                            if (!empty($name_client_form_commandes_add)) {
                                                echo $name_client_form_commandes_add;
                                            }
                                            ?>" placeholder="البحث" class="input" />
        </div>
    </div>


    <div class="container">

        <div class="top">
            <div class="titel"> الطلبات عادية</div>
            <div class="combo_icon">
                <i class="bi bi-filter-circle"></i>
                <div class="combobox">
                    <select id="sportFilter" name="" id="" class="select font3">
                        <option value="" disabled selected>نوع العميل</option>
                        <option value="جديد">جديد</option>
                        <option value="مخلص">مخلص</option>


                    </select>
                </div>
            </div>

        </div>
        <div class="body">

            <div class="table">
                <table>
                    <Thead>
                        <th colspan="5">العمليات</th>

                        <th> المبلغ الاجمالي </th>
                        <th> المبلغ الباقي </th>
                        <th>نوع العميل</th>
                        <th>عنوان</th>
                        <th>مدينة</th>
                        <th>مبلغ المقدم</th>
                        <th> رقم الهاتف</th>
                        <th>صاحب الطلبية</th>


                    </Thead>

                    <tbody>

                        <?php while ($row = mysqli_fetch_assoc($select)) { ?>

                            <tr>


                                <td>
                                    <div onclick="open_form() ; sendIdoforAdd(<?= $row['id_c'] ?>)" class="a"><i class="bi bi-plus-circle"></i></div>
                                </td>
                                <td>
                                    <div onclick="open_min() ; sendClientId(<?= $row['id_c'] ?>)" class="at"><i class="bi bi-dash-circle"></i></div>
                                </td>
                                <td><a onclick="deleteC(<?php echo $row['id_c']; ?>)"><i class="bi bi-trash"></i></a></td>
                                <td><a onclick="validerCommande(<?= $row['id_c'] ?>,<?= $row['id_comm'] ?>, 'normale')"><i class="bi bi-check2"></i></a></td>
                                <td><a href=""><i class="bi bi-printer"></i></a></td>

                                <td><?php
                                    $client = $row['id_c'];
                                    $totale = 0;
                                    $selet_articels = mysqli_query($conn, "SELECT * FROM `article` WHERE id_client = '$client'");
                                    while ($prices = mysqli_fetch_assoc($selet_articels)) {
                                        $totale = $totale + $prices['prix'] * $prices['quantite'];
                                    }
                                    $_SESSION['totale_nor'] = $totale;
                                    echo  $totale;
                                    ?></td>
                                <td><?php echo $totale - $row['avance']  ?></td>

                                <td><?php if ($row['type_c'] == "nouveau") {
                                        echo ('جديد');
                                    } else {
                                        echo ('مخلص');
                                    } ?></td>
                                <td><?= $row['address'] ?></td>
                                <td><?= $row['ville'] ?></td>
                                <td><?= $row['avance'] ?></td>
                                <td><?= $row['tele'] ?> </td>
                                <td> <?= $row['name'] ?></td>

                            </tr>

                        <?php } ?>
                    </tbody>
                </table>

            </div>


        </div>



    </div>


    <!-- form-minis-item -->

    <div class="bl-2" id="form_minis">
        <div class="table-contain">
            <i class="bi bi-x-circle close-icon2"></i>
            <div class="icon-contain">
                <i class="bi bi-dash-circle"></i>
            </div>
            <div class="client-n"></i>نقص طلب</div>

            <div class="tab">
                <table>
                    <thead>
                        <th>item</th>
                        <th>qty</th>
                        <th>action</th>
                    </thead>
                    <tbody id="t_article">


                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <!--and form-minis-item -->

    <!-- form-add -->

    <div class="bl font1" id="form_add">
        <div class="form-cont">
            <form action="add_com.php" method="post">
                <i class="bi bi-x-circle close-icon"></i>
                <div class="icon-form">
                    <i class="bi bi-basket2-fill"></i>
                </div>
                <!-- <div class="client-n"><i class="bi bi-person-bounding-box"></i>Nom du client : Mohamed labide</div> -->
                <div class="text-submit">
                    <div class="txt_field">
                        <input type="text" required id="" name="item" />
                        <span></span>
                        <label for="">طلب</label>
                    </div>


                    <div class="txt_field">
                        <input type="text" required id="" name="qty" />
                        <span></span>
                        <label for="">العدد</label>
                    </div>


                    <input type="hidden" id="input" name="client">
                    <input type="hidden" value="normale" name="type_comm">
                    <button class="btn" type="submit" name="save">
                        إضافة الطلب
                    </button>
                </div>

            </form>
        </div>




    </div>


    <!-- and-form-add -->

    <script>
        const bl = document.querySelector("#form_add");
        const close = document.querySelector(".close-icon");
        bl.style.opacity = "0";
        bl.style.visibility = "hidden";

        function open_form() {
            if (bl.style.opacity == "0" && bl.style.visibility == "hidden") {
                bl.style.opacity = "1";
                bl.style.visibility = "visible";
            }
        }
        close.onclick = function() {
            bl.style.opacity = "0";
            bl.style.visibility = "hidden";
        }
    </script>
    <script>
        const bl2 = document.querySelector("#form_minis");
        const close2 = document.querySelector(".close-icon2");
        bl2.style.opacity = "0";
        bl2.style.visibility = "hidden";

        function open_min() {
            if (bl2.style.opacity == "0" && bl2.style.visibility == "hidden") {
                bl2.style.opacity = "1";
                bl2.style.visibility = "visible";
                console.log("true");
            }
        }
        close2.onclick = function() {
            bl2.style.opacity = "0";
            bl2.style.visibility = "hidden";
        }
    </script>

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

    <!-- for the select filter -->

    <script>
        $(document).ready(function() {
            $("#sportFilter").on("change", function() {
                var selectedSport = $(this).val(); // Get the selected sport from the select element

                $("tbody tr").each(function() {
                    // Loop through each row in the tbody
                    var rowSport = $(this).find("td:eq(7)").text(); // Get the text of the "sport" td in the current row

                    if (selectedSport === "" || rowSport === selectedSport) {
                        // If no sport is selected or the row's sport matches the selected sport, show the row
                        $(this).show();
                    } else {
                        // Otherwise, hide the row
                        $(this).hide();
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {

            var searchText = document.getElementById("searchInput").value;

            if (searchText.trim() !== "") {

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
            } else {

                $("tbody tr ").show();
            }
        });







        function sendClientId(id_client) {
            console.log(id_client);
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    const responseData = JSON.parse(this.responseText); // Parse the response
                    const table = document.querySelector('table #t_article');
                    table.innerHTML = "";
                    responseData.forEach(item => {
                        const row = document.createElement('tr');
                        row.innerHTML = `
                    <td>${item.prix}</td>
                    <td>${item.quantite}</td>
                    <td><a onclick="deleteitem(${item.id})"><i class="bi bi-trash"></i></a></td>
                `;
                        table.appendChild(row);
                    });
                }
            };
            xhttp.open("GET", "select_article.php?id_client=" + id_client, true);
            xhttp.send();
        }



        function sendIdoforAdd(id) {
            var input = document.getElementById('input');
            input.value = id;
        }
    </script>


    <script>
        function validerCommande(id_client, id_comm, type) {
            alert('هل تريد حقا تأكيد الطلبية و حفظها؟');
            var xhttp = new XMLHttpRequest();
            xhttp.open("GET", "validerCommande.php?id_c=" + id_client + "&id_comm=" + id_comm + "&type=" + type, true);
            xhttp.send();
            setTimeout(() => {
                location.reload();
            }, 500); // Removed quotes around 500
        }
    </script>
    <script>
        function deleteC(id_client) {
            alert('هل تريد حقا حذف؟');
            var xhttp = new XMLHttpRequest();
            xhttp.open("GET", "delete_commande_locale.php?id=" + id_client, true);
            xhttp.send();
            setTimeout(() => {
                location.reload();
            }, "500");
        }
    </script>


    <script>
        function deleteitem(id_client) {
            alert('هل تريد حقا حذف؟');
            var xhttp = new XMLHttpRequest();
            xhttp.open("GET", "delete_item.php?id=" + id_client, true);
            xhttp.send();
            setTimeout(() => {
                location.reload();
            }, "500");
        }
    </script>

</body>

</html>