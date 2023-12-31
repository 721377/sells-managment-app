<?php

include 'config.php';
include 'sidbar.php';
if (!isset($_SESSION['user_name'])) {
    header('location:login_form.php');
}

$select = mysqli_query($conn, "SELECT cm.id as id_comm, c.id as id_c, c.name,  cm.type , cm.N_livraison FROM command_fini cm, client c WHERE c.id = cm.id_client ");


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="css/client.css">


    <title> الطلبات المنتهية</title>
</head>

<body>

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
            <div class="titel"> الطلبات المنتهية</div>
            <div class="combo_icon">
                <i class="bi bi-filter-circle"></i>
                <div class="combobox">
                    <select id="sportFilter" name="" id="" class="select font3">
                        <option value="" disabled selected> نوع الطلبية</option>
                        <option value="تم تسليمها">تم تسليمها</option>
                        <option value="عادية">عادية</option>


                    </select>
                </div>
            </div>

        </div>
        <div class="body">

            <div class="table">
                <table>
                    <Thead>
                        <th>العمليات</th>
                        <th> نوع الطلبية</th>
                        <th> شركة توصيل</th>
                        <th> اسم الزبون</th>

                    </Thead>

                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($select)) { ?>
                            <tr>
                                <td><a onclick="deleteC(<?php echo $row['id_comm']; ?>)"><i class="bi bi-trash"></i></a></td>
                                <td><?php
                                    if ($row['type'] == "normale") {
                                        echo "عادية";
                                    } else {
                                        echo "تم تسليمها";
                                    } ?></td>
                                <td><?php

                                    if ($row['N_livraison'] == "") {
                                        echo "__";
                                    } else {
                                        echo $row['N_livraison'];
                                    } ?></td>
                                <td> <?= $row['name'] ?></td>

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

    <!-- for the select filter -->

    <script>
        $(document).ready(function() {
            $("#sportFilter").on("change", function() {
                var selectedSport = $(this).val(); // Get the selected sport from the select element

                $("tbody tr").each(function() {
                    // Loop through each row in the tbody
                    var rowSport = $(this).find("td:eq(1)").text(); // Get the text of the "sport" td in the current row

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
        function deleteC(id) {
            alert('هل تريد حقا حذف؟');
            var xhttp = new XMLHttpRequest();
            xhttp.open("GET", "delete_commande_fini.php?id=" + id, true);
            xhttp.send();
            setTimeout(() => {
                location.reload();
            }, "500");
        }
    </script>

</body>

</html>