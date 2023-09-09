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

            <a href="client_f.php" class="box cardcolor">
                <i class="bi bi-person-heart"></i>
                <h2>الزبناء أوفياء</h2>
                <h1><?php echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM client WHERE `type_c` ='fidele'")) ?></h1>
            </a>



            <a href="client_n.php" class="box cardcolor">
                <i class="bi bi-person"></i>
                <h2>الزبناء الجدد</h2>
                <h1><?php echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM client WHERE `type_c` ='nouveau'")) ?></h1>
            </a>

            <a class="box" href="etape_livraison.php">
                <i class="bi bi-truck"></i>
                <h2>الطلبات قيد الشحن</h2>
                <h1><?php echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM commande_online WHERE `etape` ='etap2'")) ?></h1>

            </a>

            <a class="box" href="transactions_pr.php">
                <i class="bi bi-person-fill-lock"></i>
                <h2>معاملات الخاصة</h2>
                <h1><?php echo mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `fornisseur`")) ?></h1>

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