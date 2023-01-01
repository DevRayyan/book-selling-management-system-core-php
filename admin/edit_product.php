
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
$sql = "SELECT * FROM `tbl_add_book` WHERE `book_Id` = '$id'";
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
                    <form method="POST" enctype="multipart/form-data" >
                        <div>
                            <h1 class="text-center text-primary">Update Form</h1>
                        </div>
                    <div class="mb-3">
                        <label class="form-label mb-0 " style="font-size:.9rem;font-weight:500;">Enter Book Name</label>
                        <input style="background-color: #EEEEF8;" type="text" class="form-control" value="<?php echo $row[2]?>" placeholder="Enter Book Name" name="book_name">
                    </div>
                    <div class="mb-3">
                        <label class="form-label mb-0 " style="font-size:.9rem;font-weight:500;">Enter Book Author Name</label>
                        <input style="background-color: #EEEEF8;" type="text" class="form-control"  value="<?php echo $row[3]?>" placeholder="Enter Book Author Name" name="book_author">
                    </div>
                    <div class="mb-3">
                        <label class="form-label mb-0 " style="font-size:.9rem;font-weight:500;">Enter Book price</label>
                        <input value="<?php echo $row[4]?>" style="background-color: #EEEEF8;" type="text" class="form-control" placeholder="Enter Book price" name="book_price">
                    </div>
                    <div class="mb-3">
                        <label class="form-label mb-0 " style="font-size:.9rem;font-weight:500;">Discount</label>
                        <input value="<?php echo $row[6]?>" style="background-color: #EEEEF8;" type="text" class="form-control" placeholder="Enter Book price discount in percentage" name="percentage">
                    </div>
                    <div class="mb-3">
                        <label class="form-label mb-0 " style="font-size:.9rem;font-weight:500;">Add Book Cover</label>
                        <input style="background-color: #EEEEF8;" class="form-control" type="file"  name="book_cover">
                    </div>
                    <input type="text" name="old_img" value="<?php echo $row[1]?>">
                    <div class="mb-3 ">
                        <button class="btn btn border  btn-md " name="update" style="background:#F1F0FE;color:#1f22bd;font-weight:600;" type="submit"><i class="fas fa-book me-2"></i>Update</button>
                    </div>


                    </form>
                </div>
            </div>
        </div>
    </body>
<script src="../assets/bootstrap/js/bootstrap.min.js"></script>

</html>
<?php

// session_start();
include '../conn.php';
if(isset($_POST['update']))
{
    $id = $_GET['id'];
    $book_cover = $_FILES['book_cover']['name'];
    $book_name = $_POST['book_name'];
    $book_author = $_POST['book_author'];
    $book_price = $_POST['book_price'];
    $book_price_per = $_POST['percentage'];
    $price =($book_price_per / 100) * $book_price;
$book_price_disc = $book_price - $price;

$old_img = $_POST['old_img'];
unlink("../images/".$old_img);

$target = '../images/'.basename($book_cover);
move_uploaded_file($_FILES['book_cover']['tmp_name'], $target);

    $query = "UPDATE `tbl_add_book` SET  `book_Id` ='$id',`book_cover` = '$book_cover', `book_name` = '$book_name', `book_author` = '$book_author', `book_price` = '$book_price' ,`book_price_discount` = '$book_price_disc',`book_discount_percent` = '$book_price_per' WHERE `book_Id` = '$id'";

    $run = mysqli_query($con,$query);
    if($run)
    { 
       echo "<script>alert('data inserted successfully')</script>";
        header('Location:manage_product.php');
    }
}



?>