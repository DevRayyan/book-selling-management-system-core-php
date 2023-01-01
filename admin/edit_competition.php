
<?php
session_start();
if(!isset($_SESSION['adminloggedin']) ||$_SESSION['adminloggedin']!=true ){
    header('location: ../login.php');
    exit;
}
?>
<?php

include '../conn.php';
$id = $_GET['comp_id'];
$sql = "SELECT * FROM `competitions` WHERE `competition_id` = '$id'";
$query = mysqli_query($con, $sql);
$row = mysqli_fetch_array($query);
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
    <body>
    <?php require '_asider.php'; ?>
    <main class="">
    <?php require '_header.php'; ?>
    <div class="row col-12 mx-auto d-flex justify-content-center rounded p-2">
            <div class="w-100 p-2   fs-6">
                <p style="background:white;" class=" rounded p-2 m-0">update competition workspace</p>
            </div>

    <div class="form-container col-12 col-md-6 col-lg-6  " style="background:white;">
                <h4 class="text-dark fw-bold text-center my-3">Create New Competition</h4>
                <form method="post"  enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label mb-0 " style="font-size:.9rem;font-weight:500;">Competition Topic</label>
                        <input  value="<?php echo $row[2]?>"  style="background-color: #EEEEF8;" type="text" class="form-control" placeholder="write an essay on myself" name="comp_topic">
                    </div>
                    <div class="mb-3">
                        <label class="form-label mb-0 " style="font-size:.9rem;font-weight:500;">Competition Title</label>
                        <input  value="<?php echo $row[3]?>"  style="background-color: #EEEEF8;" class="form-control" type="text" name="comp_title" placeholder="essay writing">
                    </div>
                    <div class="mb-3">
                        <label class="form-label mb-0 " style="font-size:.9rem;font-weight:500;">Start Date</label>
                        <input  value="<?php echo $row[4]?>"  style="background-color: #EEEEF8;" class="form-control" type="date" name="comp_start_date">
                    </div>
                    <div class="mb-3">
                        <label class="form-label mb-0 " style="font-size:.9rem;font-weight:500;">End Date</label>
                        <input  value="<?php echo $row[5]?>"  style="background-color: #EEEEF8;" class="form-control" type="date" name="comp_end_date">
                    </div>
                    <div class="mb-3">
                        <label class="form-label mb-0 " style="font-size:.9rem;font-weight:500;">Winning Prize</label>
                        <input  value="<?php echo $row[6]?>"  style="background-color: #EEEEF8;" class="form-control" type="text" name="comp_prize" placeholder="$100">
                    </div>
                    <div class="mb-3">
                        <label class="form-label mb-0 " style="font-size:.9rem;font-weight:500;">Cover Image</label>
                        <input style="background-color: #EEEEF8;" class="form-control" type="file" name="comp_cover" placeholder="$100">
                    </div>
                    <input type="hidden" name="old_img" value="<?php echo $row[1]?>" >
                    <div class="mb-3 ">
                        <button class="btn btn border  btn-md " style="background:#F1F0FE;color:#1f22bd;font-weight:600;" name="update" type="submit"><i class="fa-solid fa-plus me-2"></i>Update</button>
                    </div>

                </form>
            </div>
            </div>
            </main>
    </body>
<script src="../assets/bootstrap/js/bootstrap.min.js"></script>

</html>
<?php

// session_start();
include '../conn.php';
if(isset($_POST['update']))
{
    $title = $_POST['comp_title'];
    $topic = $_POST['comp_topic'];
    $start_date = $_POST['comp_start_date'];
    $end_date = $_POST['comp_end_date'];
    $prize = $_POST['comp_prize'];
    $comp_cover = $_FILES['comp_cover']['name'];
    $target = '../images/'.basename($comp_cover);
    move_uploaded_file($_FILES['comp_cover']['tmp_name'], $target);

$old_img = $_POST['old_img'];
unlink("../images/".$old_img);


    $query = "UPDATE `competitions` SET  `competition_id` ='$id',`competition_cover` = '$comp_cover', `competition_topic` = '$topic', `competition_title` = '$title', `competition_start_date` = '$start_date' ,`competition_end_date` = '$end_date',`competition_prize` = '$prize' WHERE `competition_id` = '$id'";

    $run = mysqli_query($con,$query);
    if($run)
    { 
       echo "<script>alert('data updated successfully')</script>";
        header('Location:competitions.php');
    }
}



?>