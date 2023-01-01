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
    <title>Payment Details</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../assets/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.1.2/css/all.css">
</head>

<body>
    <?php require '_asider.php'; ?>
    <main>
        <?php require '_header.php'; ?>
        <div class="row col-12 mx-auto d-flex justify-content-center rounded p-2">
            <div class="w-100 p-2   fs-6">
                <p style="background:white;" class=" rounded p-2 m-0">User Payment Details workspace</p>
            </div>



            <!-- user table -->

            <div class="col-12 border bg-light" style="max-height: 90vh;overflow-y:scroll;">
                <p class=" rounded p-2 my-2 fs-3 fw-bolder text-center">Payment Details</p>
                <table class="table border-bottom">
                    <thead>
                        <tr class="" style="font-weight: 600;font-size:.9rem;">
                            <td scope="col">ORDER ID</td>
                            <td scope="col">FULLNAME</td>
                            <td scope="col">USERNAME</td>
                            <td scope="col">EMAIL</td>
                            <td scope="col">PHONE</td>
                            <td scope="col">COUNTRY</td>
                            <td scope="col">CITY</td>
                            <td scope="col">ADDRESS</td>
                            <td scope="col">POSTAL CODE</td>
                            <td scope="col">METHOD</td>
                        </tr>
                    </thead>
                    <tbody style="font-size: .9rem; overflow-y:scroll;">
                        <?php
                        $sql = "SELECT * FROM `order_details`";
                        $run = mysqli_query($con, $sql);
                        while ($row = mysqli_fetch_array($run)) {
                        ?>
                            <tr>
                                <td><?php echo $row[0]  ?></td>
                                <td><?php echo $row[1]  ?></td>
                                <td><?php echo $row[2]  ?></td>
                                <td><?php echo $row[3]  ?></td>
                                <td><?php echo $row[4]  ?></td>
                                <td><?php echo $row[5]  ?></td>
                                <td><?php echo $row[6]  ?></td>
                                <td><?php echo $row[7]  ?></td>
                                <td><?php echo $row[8]  ?></td>
                                <td><?php echo $row[9]  ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>

        </div>
    </main>
</body>
<script src="../assets/bootstrap/js/bootstrap.min.js"></script>

</html