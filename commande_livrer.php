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

    <title> الطلبات التي سيتم تسليمها</title>
</head>

<body>



    <div class="bl font1" id="form_add">
        <div class="form-cont">
            <form action="" method="post">
                <i class="bi bi-x-circle close-icon"></i>

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
            <div class="titel"> الطلبات التي سيتم تسليمها</div>
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
            <div class="add">
                <i class="bi bi-plus-circle"></i>
                اضافة طلبية
            </div>
        </div>
        <div class="body">

            <div class="table">
                <table>
                    <Thead>
                        <th colspan="3">العمليات</th>
                        <th>عنوان</th>
                        <th>مدينة</th>
                        <th>مبلغ سلف</th>
                        <th> رقم الهاتف</th>
                        <th> الاسم الكامل</th>


                    </Thead>

                    <tbody>

                        <tr>


                            <td><a href=""><i class="bi bi-pen"></i></a>
                            <td><a href=""><i class="bi bi-trash"></i></a></td>
                            <td><a href=""><i class="bi bi-bag-plus"></i></a></td>

                            <td>BK123425</td>
                            <td>BK123425</td>
                            <td>20028</td>
                            <td>محمد لبيد</td>
                            <td>تانوية الكيندي</td>

                        </tr>

                        <tr>


                            <td><a href=""><i class="bi bi-pen"></i></a>
                            <td><a href=""><i class="bi bi-trash"></i></a></td>
                            <td><a href=""><i class="bi bi-bag-plus"></i></a></td>

                            <td>BK123425</td>
                            <td>BK123425</td>
                            <td>20028</td>
                            <td>محمد لبيد</td>
                            <td>تانوية الكيندي</td>

                        </tr>

                        <tr>


                            <td><a href=""><i class="bi bi-pen"></i></a>
                            <td><a href=""><i class="bi bi-trash"></i></a></td>
                            <td><a href=""><i class="bi bi-bag-plus"></i></a></td>

                            <td>BK123425</td>
                            <td>BK123425</td>
                            <td>20028</td>
                            <td>محمد لبيد</td>
                            <td>تانوية الكيندي</td>

                        </tr>

                        <tr>


                            <td><a href=""><i class="bi bi-pen"></i></a>
                            <td><a href=""><i class="bi bi-trash"></i></a></td>
                            <td><a href=""><i class="bi bi-bag-plus"></i></a></td>

                            <td>BK123425</td>
                            <td>BK123425</td>
                            <td>20028</td>
                            <td>محمد لبيد</td>
                            <td>تانوية الكيندي</td>

                        </tr>

                        <tr>


                            <td><a href=""><i class="bi bi-pen"></i></a>
                            <td><a href=""><i class="bi bi-trash"></i></a></td>
                            <td><a href=""><i class="bi bi-bag-plus"></i></a></td>

                            <td>BK123425</td>
                            <td>BK123425</td>
                            <td>20028</td>
                            <td>محمد لبيد</td>
                            <td>تانوية الكيندي</td>

                        </tr>

                        <tr>


                            <td><a href=""><i class="bi bi-pen"></i></a>
                            <td><a href=""><i class="bi bi-trash"></i></a></td>
                            <td><a href=""><i class="bi bi-bag-plus"></i></a></td>

                            <td>BK123425</td>
                            <td>BK123425</td>
                            <td>20028</td>
                            <td>محمد لبيد</td>
                            <td>تانوية الكيندي</td>

                        </tr>

                        <tr>


                            <td><a href=""><i class="bi bi-pen"></i></a>
                            <td><a href=""><i class="bi bi-trash"></i></a></td>
                            <td><a href=""><i class="bi bi-bag-plus"></i></a></td>

                            <td>BK123425</td>
                            <td>BK123425</td>
                            <td>20028</td>
                            <td>محمد لبيد</td>
                            <td>تانوية الكيندي</td>

                        </tr>

                        <tr>


                            <td><a href=""><i class="bi bi-pen"></i></a>
                            <td><a href=""><i class="bi bi-trash"></i></a></td>
                            <td><a href=""><i class="bi bi-bag-plus"></i></a></td>

                            <td>BK123425</td>
                            <td>BK123425</td>
                            <td>20028</td>
                            <td>محمد لبيد</td>
                            <td>تانوية الكيندي</td>

                        </tr>

                        <tr>


                            <td><a href=""><i class="bi bi-pen"></i></a>
                            <td><a href=""><i class="bi bi-trash"></i></a></td>
                            <td><a href=""><i class="bi bi-bag-plus"></i></a></td>

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

</html>