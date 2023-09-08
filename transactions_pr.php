<?php
session_start();

include 'config.php';

if (!isset($_SESSION['user_name'])) {
    header('location:login_form.php');
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


    <title>المعاملات الخاصة</title>
</head>

<body>
    <div class="bl font1" id="form_det">
        <div class="form-cont2">
            <div class="icon-form">
                <i class="bi bi-person-lines-fill"></i>

            </div>
            <div class="iformations">
                <h1 id="nom_cli">
                </h1>
                <h3 id="age"></h3>
                <h3 id="tele"></h3>
                <h3 id="prix"></h3>
                <h3 id="date"></h3>
            </div>
            <i class="bi bi-x-circle close-icon2"></i>

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


        </div>
        <div class="body">

            <div class="table">
                <table>
                    <Thead>
                        <th colspan="2">العمليات</th>
                        <th>مبلغ سلف</th>
                        <th> رقم الهاتف</th>
                        <th> اسم الزبون</th>
                    </Thead>

                    <tbody>

                        <tr>
                            <td><a href=""><i class="bi bi-trash"></i></a></td>
                            <td><a onclick="aff_det(<?php echo $row['id']; ?>);  handeldettactio() ;" class="det"> <i class="bi bi-eye "></i></a></td>
                            <td>20028</td>
                            <td>محمد لبيد</td>
                            <td>تانوية الكيندي</td>

                        </tr>


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











        const bl2 = document.querySelector("#form_det");
        const close2 = document.querySelector(".close-icon2");
        const det = document.querySelector('.det')

        bl2.style.opacity = "0";
        bl2.style.visibility = "hidden";
        if (sessionStorage.getItem("det") === "false") {
            sessionStorage.setItem("det", false);
        }

        function handeldettactio() {
            bl2.style.opacity = "1";
            bl2.style.visibility = "visible";
            sessionStorage.setItem("det", true);
        }

        if (sessionStorage.getItem("det") === "true") {
            bl2.style.opacity = "1";
            bl2.style.visibility = "visible";
        }

        close2.addEventListener("click", function() {
            bl2.style.opacity = "0";
            bl2.style.visibility = "hidden";
            sessionStorage.setItem("det", false);


        });
    </script>

</body>

</html>