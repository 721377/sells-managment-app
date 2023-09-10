<?php
session_start();

include 'config.php';
include 'cryptfunction.php';

if (!isset($_SESSION['user_name'])) {
    header('location:login_form.php');
}


if (isset($_GET['id'])) {
    $name_client_form_commandes_add = decryptId($_GET['id']);
}



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
                        <option value="" disabled selected>sport</option>
                        <option value="K1">K1</option>
                        <option value="aikido">aikido</option>
                        <option value="Box">Box</option>
                        <option value="musculation">musculation</option>

                    </select>
                </div>
            </div>

        </div>
        <div class="body">

            <div class="table">
                <table>
                    <Thead>
                        <th colspan="6">العمليات</th>
                        <th>عنوان</th>
                        <th>مدينة</th>
                        <th>مبلغ سلف</th>
                        <th> رقم الهاتف</th>
                        <th>صاحب الطلبية</th>


                    </Thead>

                    <tbody>

                        <tr>


                            <td>
                                <div onclick="open_form()" class="a"><i class="bi bi-plus-circle"></i></div>
                            </td>
                            <td>
                                <div onclick="open_min()" class="at"><i class="bi bi-dash-circle"></i></div>
                            </td>
                            <td><a href=""><i class="bi bi-pen"></i></a></td>
                            <td><a href=""><i class="bi bi-trash"></i></a></td>
                            <td><a href=""><i class="bi bi-check2"></i></a></td>
                            <td><a href=""><i class="bi bi-printer"></i></a></td>

                            <td>BK123425</td>
                            <td>BK123425</td>
                            <td>20028</td>
                            <td>محمد لبيد</td>
                            <td>تانوية الكيندي</td>

                        </tr>






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
                    <tbody>
                        <tr>
                            <td>300dh</td>
                            <td>2</td>
                            <td><a href=""><i class="bi bi-trash"></i></a></td>

                        </tr>

                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <!--and form-minis-item -->

    <!-- form-add -->

    <div class="bl font1" id="form_add">
        <div class="form-cont">
            <form action="" method="post">
                <i class="bi bi-x-circle close-icon"></i>
                <div class="icon-form">
                    <i class="bi bi-basket2-fill"></i>
                </div>
                <div class="client-n"><i class="bi bi-person-bounding-box"></i>Nom du client : Mohamed labide</div>
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
    </script>


</body>

</html>