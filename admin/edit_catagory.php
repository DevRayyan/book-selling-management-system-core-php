
<?php
session_start();
if(!isset($_SESSION['adminloggedin']) ||$_SESSION['adminloggedin']!=true ){
    header('location: ../login.php');
    exit;
}
?>
<?php

include '../conn.php';
$id = $_GET['id'];
$sql = "SELECT * FROM `tbl_category` WHERE `catagory_Id` = '$id'";
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
        <div class="container mt-5">
            <div class="row justify-content-center  pt-5">
                <div class="col-6 card shadow">
                    <form method="POST" enctype="multipart/form-data">
                        <div>
                            <h1 class="text-center text-dark">Update Category</h1>
                        </div>
                    <div class="mb-3">
                        <label class="form-label mb-0 " style="font-size:.9rem;font-weight:500;">Enter Catagory Title</label>
                        <input style="background-color: #EEEEF8;" type="text" class="form-control" value="<?php echo $row[2]?>" placeholder="Enter Book Name" name="cat_title">
                    </div>
                    <div class="mb-3">
                        <label class="form-label mb-0 " style="font-size:.9rem;font-weight:500;">Add Catagory Cover</label>
                        <input style="background-color: #EEEEF8;"  name="cat_cover" class="form-control" type="file" >
                        </div>
                        <input type="hidden" name="old_img" value="<?php echo $row[1]?>">
            
                        <button class="btn btn border  btn-md " name="update_cat" style="background:#F1F0FE;color:#1f22bd;font-weight:600;" type="submit"><i class="fas fa-book me-2"></i>Update</button>
                    </div>


                    </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
<script src="../assets/bootstrap/js/bootstrap.min.js"></script>

</html>
<?php

// session_start();
include '../conn.php';
if(isset($_POST['update_cat']))
{
    $id = $_GET['id'];
    $cat_cover = $_FILES['cat_cover']['name'];
    $cat_title = $_POST['cat_title'];
 $old_img = $_POST['old_img'];
    unlink("../images/".$old_img);

    $target = '../images/'.basename($cat_cover);
    move_uploaded_file($_FILES['cat_cover']['tmp_name'], $target);

    $query = "UPDATE `tbl_category` SET  `catagory_Id` ='$id',`catagory_cover` = '$cat_cover', `catagory_title` = '$cat_title' WHERE `catagory_Id` = '$id'";

    $run = mysqli_query($con,$query);
    if($run)
    { 
       echo "<script>alert('data updated successfully')</script>";
        header('Location:catagory.php');
    }
    
}



?>