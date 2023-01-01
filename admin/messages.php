
<?php
session_start();
if(!isset($_SESSION['adminloggedin']) ||$_SESSION['adminloggedin']!=true ){
    header('location: ../login.php');
    exit;
}
?>

<?php

include '../conn.php';
$sql = "SELECT * FROM `message`";
$run = mysqli_query($con, $sql);

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>create book</title>
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../assets/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.1.2/css/all.css">
</head>
<body>
<?php require '_asider.php'; ?>
    <main class="">
    <?php require '_header.php'; ?>
        <div class="row col-11 mx-auto d-flex justify-content-center pt-3">
            <div class="w-100 p-2   fs-6">
                <p style="background:white;" class=" rounded p-2 m-0">Customers Messages</p>
            </div>
            </div>
<!-- table -->      
    <div class=" m-2  " >


        <div class="col-12  border  pt-5">

            <div class="col-12 border bg-light" style="max-height: 90vh;overflow-y:scroll;">
            <p class=" rounded p-2 my-2 fs-3 fw-bolder text-center">Manage Your sale Products </p>
                <table class="table border-bottom">
                    <thead>
                        <tr class="" style="font-weight: 600;font-size:.9rem;">
                            <td scope="col">Id</td>
                            <td scope="col">Customer name</td>
                            <td scope="col">Customer Email</td>
                            <td scope="col">Message</td>

                        </tr>
                    </thead>
                    <tbody style="font-size: .9rem;">
                        <?php
                        while($row = mysqli_fetch_array($run))
                        {
                            ?>
                        <tr>
                            <td><?php  echo $row[0]  ?></td>
                            <td><?php  echo $row[1]  ?></td>
                            <td><?php  echo $row[2]  ?></td>
                            <td><?php  echo $row[3]  ?></td>
       
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

</html>