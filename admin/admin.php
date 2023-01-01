<?php
session_start();

if (!isset($_SESSION['adminloggedin']) || $_SESSION['adminloggedin'] != true) {
  header('location: ../login.php');
  exit;
}
include '../conn.php';
$query = "SELECT * from `user_register` where `roles` = 'user'";
$run = mysqli_query($con, $query);
$count = mysqli_num_rows($run);
$query2 = "SELECT * from `user_register` where `roles` = 'admin'";
$run2 = mysqli_query($con, $query2);
$count2 = mysqli_num_rows($run2);

$sql1 = "SELECT * FROM `tbl_category`";
$result = mysqli_query($con, $sql1);
$run = mysqli_num_rows($result);

$sql2 = "SELECT * FROM    `tbl_add_book`";
$result2 = mysqli_query($con, $sql2);
$run2 = mysqli_num_rows($result2);

$sql3 = "SELECT * FROM    `competitions`";
$result3 = mysqli_query($con, $sql3);
$run3 = mysqli_num_rows($result3);

$comp_winner = "SELECT * FROM    `tbl_contest_participants` where `status` = 'winner' ";
$comp_winner_res = mysqli_query($con, $comp_winner);
$winner= mysqli_num_rows($comp_winner_res);

$sql4 = "SELECT * FROM `tbl_orders` where `status` = 'pending'";
$result4 = mysqli_query($con, $sql4);
$run4 = mysqli_num_rows($result4);


$sql5 = "SELECT * FROM `tbl_orders` where `status` = 'completed'";
$result5 = mysqli_query($con, $sql5);
$run5 = mysqli_num_rows($result5);

$sql6 = "SELECT * FROM `message`";
$result6 = mysqli_query($con, $sql6);
$run6 = mysqli_num_rows($result6);
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Hello, world!</title>
  <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
  <link rel="stylesheet" href="../assets/fontawesome/css/fontawesome.min.css">
  <link rel="stylesheet" href="admin.css">
  <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.1.2/css/all.css">
</head>

<style>
  body {
    width: 100%;
    height: 100vh;
    background-color: #eeeef8;

  }
</style>

<body>
  <?php require '_asider.php'; ?>
  <main>
    <?php require '_header.php'; ?>
    <div class="row col-11 mx-auto d-flex justify-content-center pt-3">
      <div class="w-100 p-2   fs-6">
        <p style="background:white;" class=" rounded p-2 m-0">E-book selling workspace</p>
      </div>
      <div class="total-user col-12 col-md-3 p-2">
        <div class="  rounded" style="height:342px;">
          <div class="alert alert-primary h-50 mb-1">
            <div class="row fs-4 ps-4">Total Users</div>
            <span class="d-block text-center user-value fw-bolder fs-1 "><?php echo $count  ?></span>
            <span class="d-block text-center user-name">
              <div style="border:none !important;" class="" value="user">users</div>
            </span>
          </div>
          <div class="alert alert-success  h-50  ">
            <div class="row fs-4 ps-4 ">Total Admins</div>
            <span class="d-block text-center user-value fw-bolder fs-1"><?php echo $count2  ?></span>
            <span class="d-block text-center user-name">
              <div style="border:none !important;" class="" value="user">admins</div>
            </span>
          </div>
          
        </div>
        
      </div>
      <div class="col-12 col-md-9 p-1 rounded">
        <div class="rounded " style="height:350px;">
          <div class="row w-100  m-0">
            <div style="height:175px;" class="col-12 col-md-6  rounded p-0">
              <div class="user-report-grid m-1  p-2" style="background-color:WHITE;height:96%;">
                <p>Total Categories</p>
                <p class="fw-bold fs-3 "><span>
                    <?php
                 echo $run;
                    ?>
                  </span></p>
                <a href="catagory.php" class="btn border fw-bold btn-sm" style="background:#F1F0FE;color:#1f22bd ;"><i class="far fa-clock me-2"></i>Total Categories</a>

              </div>
            </div>
            <div style="height:175px;" class="col-12 col-md-6  rounded  p-0 ">
              <div class="user-report-grid m-1  p-2" style="background-color:WHITE;height:96%;">
                <p>Total Products</p>
                <p class="fw-bold fs-3 "> <?php
                                       echo $run2;
                                          ?></p>
                <a href="manage_product.php" class="btn border fw-bold btn-sm" style="background:#F1F0FE;color:#1f22bd ;"><i class="fas fa-usd me-2"></i>Total Products</a>

              </div>
            </div>
          </div>
          <div class="row w-100  m-0 ">

            <div style="height:175px;" class="col-12 col-md-6  rounded  p-0 ">
              <div class="user-report-grid m-1 p-2" style="background-color:WHITE;height:96%;">
                <p>Total Competitions</p>
                <p class="fw-bold fs-3 "><?php
                                       echo $run3;
                                          ?></p>
                <a href="competitions.php" class="btn border fw-bold btn-sm" style="background:#F1F0FE;color:#1f22bd ;"><i class="far fa-clock me-2"></i>View Details</a>

              </div>
            </div>
            <div style="height:175px;" class="col-12 col-md-6  rounded  p-0 ">
            <div class="user-report-grid m-1  p-2" style="background-color:WHITE;height:96%;">
                <p>Customer Messages</p>
                <p class="fw-bold fs-3 "><?php
                                       echo $run6;
                                          ?></p>
                <a href="messages.php" class="btn border fw-bold btn-sm" style="background:#F1F0FE;color:#1f22bd ;"><i class="far fa-check-circle me-2"></i>View Details</a>

              </div>
            </div>
            <div style="height:175px;" class="col-12 col-md-6  rounded  p-0 ">
              <div class="user-report-grid m-1  p-2" style="background-color:WHITE;height:96%;">
                <p>Pending Orders</p>
                <p class="fw-bold fs-3 "><?php
                                       echo $run4;
                                          ?></p>
                <a href="pending_orders.php" class="btn border fw-bold btn-sm" style="background:#F1F0FE;color:#1f22bd ;"><i class="far fa-check-circle me-2"></i>View Details</a>

              </div>
            </div>
            <div style="height:175px;" class="col-12 col-md-6  rounded  p-0 ">
              <div class="user-report-grid m-1  p-2" style="background-color:WHITE;height:96%;">
                <p>Completed Orders</p>
                <p class="fw-bold fs-3 "><?php
                                       echo $run5;
                                          ?></p>
                <a href="completed_orders.php" class="btn border fw-bold btn-sm" style="background:#F1F0FE;color:#1f22bd ;"><i class="far fa-check-circle me-2"></i>View Details</a>

              </div>
       
            </div>
          </div>
        </div>
      </div>
    </div>

  </main>

</body>
<script src="../assets/bootstrap/js/bootstrap.min.js"></script>

</html>