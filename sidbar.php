<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/side.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


</head>

<body>


    <div class="sidbar sid1">
        <div class="menu" onclick="handelsidemove()">
            <img src="imgs/menu .png" alt="" />
        </div>
        <div class="logo imgmove1">
            <img src="imgs/logoT.png" alt="" />
        </div>

        <nav>
            <ul>
                <a href="index.php">
                    <li tabindex="0" class="list_focus">
                        <span></span>
                        <i class="bi bi-house sidicons"></i>
                        <h3 class="font1">لوحة القيادة</h3>
                    </li>
                </a>
                <li onclick="handelarrowmove2()" tabindex="0" class="list_focus">
                    <span></span>
                    <i class="bi bi-basket3 sidicons"></i>

                    <h3 class="font1">طلبات</h3>
                    <img src="imgs/Creative-Arrow-PNG-Icon_b4yoq2.png" class="arrow2" alt="" />
                </li>
                <div class="commandes">
                    <a onclick="checkPageWidth()" href="commande_livrer.php">
                        <div class="inert">
                            <span></span>
                            <i class="bi bi-person-workspace"></i>
                            <h4 class="font1">الطلبات التي سيتم تسليمها</h4>
                        </div>
                    </a>

                    <a onclick="checkPageWidth()" href="commande_normale.php">
                        <div class="inert">
                            <span></span>
                            <i class="bi bi-person-video3"></i>
                            <h4 class="font1">الطلبات عادية</h4>
                        </div>
                    </a>

                    <a onclick="checkPageWidth()" href="commande_finie.php">
                        <div class="inert">
                            <span></span>
                            <h4 class="font1">الطلبات المنتهية</h4>
                        </div>
                    </a>
                </div>
                <li onclick="handelarrowmove1()" tabindex="0" class="list_focus">
                    <span></span>
                    <i class="bi bi-people sidicons"></i>
                    <h3 class="font1">الزبائن</h3>
                    <img src="imgs/Creative-Arrow-PNG-Icon_b4yoq2.png" class=" arrow1" alt="" />
                </li>
                <div class="Interventions">
                    <a onclick="checkPageWidth()" href="client_f.php">
                        <div class="inert">
                            <span></span>
                            <i class="bi bi-person-heart"></i>

                            <h4 class="font1">الزبائن أوفياء</h4>
                        </div>
                    </a>

                    <a onclick="checkPageWidth()" href="client_n.php">
                        <div class="inert">
                            <span></span>
                            <i class="bi bi-person"></i>

                            <h4 class="font1">الزبائن الجدد</h4>
                        </div>
                    </a>


                </div>
                <a onclick="checkPageWidth()" href="credit.php">
                    <li tabindex="0" class="list_focus">
                        <span></span>
                        <i class="bi bi-cash sidicons"></i>
                        <h3 class="font1">ائتمان</h3>
                    </li>
                </a>
                <a onclick="checkPageWidth()" href="users.php">
                    <li tabindex="0" class="list_focus">
                        <span></span>
                        <i class="bi bi-person-gear sidicons"></i>
                        <h3 class="font1">المستخدمين</h3>
                    </li>
                </a>
            </ul>
        </nav>
        <a href="logout.php">
            <div class="logaout">
                <span></span>
                <i class="sidicons bi bi-box-arrow-left"></i>
                <h3 class="font1">تسجيل خروج</h3>
            </div>
        </a>
    </div>

    <script src="index.js"></script>
</body>