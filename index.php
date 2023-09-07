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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/shet.css">
    <title>Dashboard</title>
</head>


<body>

    <div class="main">
        <div class="main-card">

            <a href="client.php" class="box cardcolor">
                <i class="bi bi-person"></i>
                <h2>les clients</h2>
                <h1><?php //echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM client")) 
                    ?> 7</h1>
            </a>



            <a href="client_non_payer.php" class="box cardcolor">
                <i class="bi bi-person-x"></i>
                <h2>clients non paye</h2>
                <h1><?php
                    // $expire_date = date("Y-m-d", strtotime("-30 days"));
                    // $expire = mysqli_query($conn, "SELECT * FROM `client` WHERE dat_ins <= '" . $expire_date . "'");
                    // echo mysqli_num_rows($expire);
                    ?></h1>
            </a>

            <a class="box">
                <i class="bi bi-person-up"></i>
                <h2>clients de ce mois</h2>
                <h1><?php
                    // $date = date("Y-m-d");
                    // $month = date('m', strtotime($date));
                    // $expire = mysqli_query($conn, "SELECT * FROM `client` WHERE MONTH(dat_ins) = '$month'");
                    // echo mysqli_num_rows($expire);
                    ?></h1>
            </a>

            <a class="box">
                <i class="bi bi-person-slash"></i>
                <h2>client d'esactiver</h2>
                <h1><?php
                    // $expire_date = date("Y-m-d", strtotime("-60 days"));
                    // $expire = mysqli_query($conn, "SELECT * FROM `client` WHERE dat_ins <= '" . $expire_date . "'");
                    // echo mysqli_num_rows($expire);
                    ?>

                </h1>
            </a>


        </div>
    </div>




    </div>
    <script src="./myjs/index.js"></script>


    <script>
        flatpickr(".date", {});
    </script>


    <script>
        const search = document.getElementById("t1");
        const rows = document.querySelectorAll("#tb tr");

        search.addEventListener("keyup", function(event) {
            const q = event.target.value;
            rows.forEach(row => {
                row.querySelector('td').textContent.toLowerCase().startsWith(q) ?
                    row.style.display = '' :
                    (row.style.display = 'none');
            });
        });
    </script>

    <script>
        const tb_non = document.getElementById("table-two");
        const red = document.getElementById("point")
        var count = tb_non.rows.length - 1;
        if (count > 0) {
            red.style.display = "block";
        }
        red.innerHTML = count;
    </script>






</body>

</html>