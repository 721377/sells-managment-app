<?php
include 'config.php';
include 'cryptfunction.php';

$stmt = mysqli_stmt_init($conn);

$item = $_POST['item'];
$id_cli = $_POST['id_cli'];
$articl = $_POST['art'];
$qun =  $_POST['qun'];

$total = $qun * $articl;

// Check if the client with the given ID exists
$sql_n = "SELECT * FROM client WHERE id = ?";
if (!mysqli_stmt_prepare($stmt, $sql_n)) {
    echo "Error: SQL prepare failed";
} else {
    mysqli_stmt_bind_param($stmt, "i", $id_cli);
    mysqli_stmt_execute($stmt);
    $result_n = mysqli_stmt_get_result($stmt);
    if (mysqli_num_rows($result_n) == 0) {
        echo "Client not found";
        exit;
    }
    $row_c = mysqli_fetch_assoc($result_n);

    // Insert the article
    $insert_art = "INSERT INTO article(prix, quantite, id_client) VALUES (?, ?, ?)";
    if (!mysqli_stmt_prepare($stmt, $insert_art)) {
        echo "Error: SQL prepare failed for article insertion";
    } else {
        mysqli_stmt_bind_param($stmt, "sss", $articl, $qun, $id_cli);
        if (mysqli_stmt_execute($stmt)) {



            if ($type == "normale") {
                // Check if there is an existing command for this client
                $sql = "SELECT * FROM `commande_local` WHERE id_client = ?";
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    echo "Error: SQL prepare failed for commande_local selection";
                } else {
                    mysqli_stmt_bind_param($stmt, "i", $id_cli);
                    mysqli_stmt_execute($stmt);
                    $result_commande = mysqli_stmt_get_result($stmt);
                    if (mysqli_num_rows($result_commande) > 0) {
                        header('location:commande_normale.php?id=' . encryptId($row_c['name']));
                    } else {
                        $insert = "INSERT INTO `commande_local`(`id_client`, `total`) VALUES (?, ?)";
                        if (!mysqli_stmt_prepare($stmt, $insert)) {
                            echo "Error: SQL prepare failed for commande_local insertion";
                        } else {
                            mysqli_stmt_bind_param($stmt, "ss", $id_cli, $total);
                            if (mysqli_stmt_execute($stmt)) {
                                if ($row_c['type_c'] == "fidele") {
                                    header('location:client_f.php');
                                } else {
                                    header('location:client_n.php');
                                }
                            } else {
                                echo "Error: Failed to insert into commande_local";
                            }
                        }
                    }
                }
            } else {
                // Check if there is an existing command for this client
                $sql = "SELECT * FROM `commande_online` WHERE id_client = ?";
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    echo "Error: SQL prepare failed for commande_online selection";
                } else {
                    mysqli_stmt_bind_param($stmt, "i", $id_cli);
                    mysqli_stmt_execute($stmt);
                    $result_commande = mysqli_stmt_get_result($stmt);
                    if (mysqli_num_rows($result_commande) > 0) {
                        header('location:commande_livrer.php?id=' . encryptId($row_c['name']));
                    } else {
                        $insert = "INSERT INTO `commande_online`(`id_client`, `etape`, `total`) VALUES (?, 'etape1', ?)";
                        if (!mysqli_stmt_prepare($stmt, $insert)) {
                            echo "Error: SQL prepare failed for commande_online insertion";
                        } else {
                            mysqli_stmt_bind_param($stmt, "ss", $id_cli, $total);
                            if (mysqli_stmt_execute($stmt)) {
                                if ($row_c['type_c'] == "fidele") {
                                    header('location:client_f.php');
                                } else {
                                    header('location:client_n.php');
                                }
                            } else {
                                echo "Error: Failed to insert into commande_online";
                            }
                        }
                    }
                }
            }
        } else {
            echo "Error: Failed to insert into article";
        }
    }
}
