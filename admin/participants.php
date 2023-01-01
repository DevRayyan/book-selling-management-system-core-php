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
   
                                            <table class="table border-bottom  w-100">
                                                <thead>
                                                    <tr class="" style="font-weight: 600;font-size:.9rem;">
                                                        <td scope="col">Competition ID</td>
                                                        <td scope="col">User ID</td>
                                                        <td scope="col">Username</td>
                                                        <td scope="col">Content</td>
                                                        <td scope="col">status</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php

                                                    $query = "SELECT * FROM `tbl_contest_participants`";
                                                    $run = mysqli_query($con, $query);

                                                    while ($fetch = mysqli_fetch_array($run)) {

                                                    ?>
                                                        <tr class="w-100 text-wrap">
                                                            <td><?php echo $fetch[0]  ?></td>
                                                            <td><?php echo $fetch[1]  ?></td>
                                                            <td><?php echo $fetch[2]  ?></td>
                                                            <td><p class="row"><?php  echo( $fetch[3]) ?></p></td>
                                                            <td ><?php
                                                                if ($fetch[4] == 'looser') {
                                                                    echo '<p><a class="text-light text-decoration-none bg-danger p-1 rounded" href="status.php?userid=' . $fetch[1] .'&statuscheck=winner">looser</a></p>';
                                                                }else{
                                                                    echo '<p><a class="text-light text-decoration-none bg-success p-1 rounded" href="status.php?userid=' . $fetch[1] . '&statuscheck=looser">winner</a></p>';
                                                                } ?></td>
                                                            
                                                        </tr>
                                                    <?php
                                                    } ?>
                                                </tbody>
                                            </table>
        
                    </div>

                </div>

            </div>
    </main>
</body>
<script src="../assets/bootstrap/js/bootstrap.min.js"></script>

</html