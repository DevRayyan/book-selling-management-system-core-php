
<?php
session_start();
if(!isset($_SESSION['adminloggedin']) ||$_SESSION['adminloggedin']!=true ){
    header('location: ../login.php');
    exit;
}
?>

<?php

if(isset($_SESSION['message']))
{
?>
<div class="row justify-content-center mt-5">
            <div class="col-6">
                <div class="alert alert-success alert-dismissible fade show shadow" role="alert">
                <strong>Hey! </strong><?php echo $_SESSION['message']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>

<?php
    unset($_SESSION['message']);    
}
include '../conn.php';
$sql = "SELECT * FROM `tbl_add_book`";
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
                <p style="background:white;" class=" rounded p-2 m-0">products on sale manage workspace</p>
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
                            <td scope="col">COVER</td>
                            <td scope="col">NAME</td>
                            <td scope="col">AUTHOR</td>
                            <td scope="col">TOTAL PRICE</td>
                            <td scope="col">DISCOUNT PRICE</td>
                            <td scope="col">DISCOUNT PERCENT</td>
                            <td scope="col">CATAGORY</td>
                            <td scope="col">TYPE</td>
                            <td scope="col">ACTIONS</td>
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
                            <td>$<?php  echo $row[4]  ?></td>
                            <td>$<?php  echo $row[5]  ?></td>
                            <td>%<?php  echo $row[6]  ?></td>
                            <td><?php  echo $row[7]  ?></td>
                            <td><?php  echo $row[8]  ?></td>
                            <td class="d-flex justify-content-evenly">
                                <a href="edit_product.php?id=<?php echo $row[0]; ?>" class="btn  text-dark btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                            <a href="delete.php?id=<?php echo $row[0]; ?>" class="btn text-dark btn-sm"><i class="fa-solid fa-trash-can"></i>
                                </a>
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

</html>