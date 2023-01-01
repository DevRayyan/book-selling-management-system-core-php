<?php
session_start();
include '../conn.php';
if(!isset($_SESSION['adminloggedin']) ||$_SESSION['adminloggedin']!=true ){
    header('location: ../login.php');
    exit;

}
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


<!-- user table -->

             <div class="col-12 border bg-light" style="max-height: 90vh;overflow-y:scroll;">
                 <p class=" rounded p-2 my-2 fs-3 fw-bolder text-center">Manage users</p>
                 <table class="table border-bottom">
                     <thead>
                         <tr class="" style="font-weight: 600;font-size:.9rem;">
                             <td scope="col">Id</td>
                             <td scope="col">FULLNAME</td>
                             <td scope="col">USERNAME</td>
                             <td scope="col">EMAIL</td>
                             <td scope="col">PASSWORD</td>
                             <td scope="col">ACTIONS</td>
                         </tr>
                     </thead>
                     <tbody style="font-size: .9rem; overflow-y:scroll;">
                         <?php
                             $sql = "SELECT * FROM `user_register` where `roles` = 'user'";
                             $run = mysqli_query($con, $sql);
                            while ($row = mysqli_fetch_array($run)) {
                            ?>
                             <tr>
                                 <td><?php echo $row[0]  ?></td>
                                 <td><?php echo $row[1]  ?></td>
                                 <td><?php echo $row[2]  ?></td>
                                 <td><?php echo $row[3]  ?></td>
                                 <td><?php echo $row[4]  ?></td>
                                 <td class="d-flex ">
                                     <a href="edit_catagory.php?id=<?php echo $row[0] ?>" class="btn  text-dark btn-sm"><i class="fas fa-pencil"></i></a>
                                     <a href="./delete.php?userid=<?php echo $row[0] ?>" class="btn text-dark btn-sm"><i class="fas fa-trash"></i>
                                     </a>
                                 </td>
                             </tr>
                         <?php
                            }
                            ?>
                     </tbody>
                 </table>
             </div>


    </main>
</body>
<script src="../assets/bootstrap/js/bootstrap.min.js"></script>

</html