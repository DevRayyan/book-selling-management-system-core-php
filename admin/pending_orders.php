<?php
session_start();
include '../conn.php';
if (!isset($_SESSION['adminloggedin']) || $_SESSION['adminloggedin'] != true) {
    header('location: ../login.php');
    exit;
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pending orders</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../assets/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.1.2/css/all.css">
</head>

<body>
    <?php require '_asider.php';

    ?>
    <main>
        <?php require '_header.php'; ?>
        <div class="row col-12 mx-auto d-flex justify-content-center rounded p-2">
            <div class="w-100 p-2   fs-6">
                <p style="background:white;" class=" rounded p-2 m-0">User Order Details workspace</p>
            </div>
            <!-- table -->
            <div class=" m-2  ">


                <div class="col-12  border  pt-5">

                    <p class=" rounded p-2 my-2 fs-3 fw-bolder text-center">Manage Your Orders </p>
                    <div class="col-12 border bg-light d-flex" style="max-height: 90vh;overflow-y:scroll;">
                        <table class="table table-striped   text-center">
                            <thead>
                                <tr class="" style="font-weight: 600;font-size:.9rem;">
                                    <td scope="col">orderID</td>
                                    <td scope="col">customer </td>
                                    <td scope="col">phone</td>
                                    <td scope="col">address</td>
                                    <td scope="col">payment</td>


                                    <td scope="col">orders</td>

                                </tr>
                            </thead>
                            <tbody style="font-size: .9rem;">
                                <?php
                                $sql = "SELECT * FROM `order_details`";
                                $result = mysqli_query($con, $sql);
                                while ($row = mysqli_fetch_array($result)) {
                                ?>
                                    <tr>
                                        <td><?php echo $row[0]  ?></td>
                                        <td><?php echo $row[1]  ?></td>
                                        <td><?php echo $row[4]  ?></td>
                                        <td><?php echo $row[7]  ?></td>
                                        <td><?php echo $row[9]  ?></td>

                                        <td>
                                            <table class="table border-bottom text-center">
                                                <thead>
                                                    <tr class="" style="font-weight: 600;font-size:.9rem;">
                                                        <td scope="col">items</td>
                                                        <td scope="col">price</td>
                                                        <td scope="col">quantity</td>
                                                        <td scope="col">status</td>
                                                        <td scope="col">tracking</td>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php

                                                    $query = "SELECT * FROM `tbl_orders` where `order_id` = '$row[0]'  and `status` = 'pending'";
                                                    $run = mysqli_query($con, $query);

                                                    while ($fetch = mysqli_fetch_array($run)) {

                                                    ?>
                                                        <tr>
                                                            <td><?php echo $fetch[1]  ?></td>
                                                            <td><?php echo $fetch[3]  ?></td>
                                                            <td><?php echo $fetch[4]  ?></td>
                                                            <td><?php
                                                                if ($fetch[7] == 'completed') {
                                                                    echo '<p><a class="text-light text-decoration-none bg-success p-1 rounded" href="status.php?id=' . $fetch[8] . '&status=pending">Completed</a></p>';
                                                                }else{
                                                                    echo '<p><a class="text-light text-decoration-none bg-danger p-1 rounded" href="status.php?id=' . $fetch[8] . '&status=completed">Pending</a></p>';
                                                                } ?></td>
                                                            <td><?php echo $fetch[8]  ?></td>
                                                        </tr>
                                                    <?php
                                                    } ?>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                <?php



                                }
                                ?>
                            </tbody>
                        </table>
                    </div>

                </div>

            </div>
    </main>
</body>
<script src="../assets/bootstrap/js/bootstrap.min.js"></script>

</html