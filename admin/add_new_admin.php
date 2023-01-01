 <?php
    session_start();
    if(!isset($_SESSION['adminloggedin']) ||$_SESSION['adminloggedin']!=true ){
        header('location: ../login.php');
        exit;
    }
    ?>
 <?php

    include '../conn.php';
    $showalert = false;
    $showerror = false;
    if ($_SERVER["REQUEST_METHOD"] == 'POST') {

        $name = $_POST['fullname'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $admin = 'admin';
        if (empty($name) || empty($username) || empty($email) || empty($password)) {
            $showerror = 'fields are empty';
        } else {

            $sql = "INSERT INTO `user_register` ( `fullname`, `username`, `email`,`password`, `date`,`roles`) VALUES ('$name', '$username','$email', '$password', current_timestamp(),'$admin')";
            $result = mysqli_query($con, $sql);
            if ($result) {
                $showalert = true;
            }
        }
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
     <?php
        if ($showalert) {
            echo ' <div style="z-index:9999" class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>hurray!</strong> Admin Added Sucessfully.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
        }
        if ($showerror) {
            echo '<div  style="z-index:9999"  class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>error!</strong> ' . $showerror . '.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
        }
        ?>
     <?php require '_asider.php'; ?>
     <main class="">
         <?php require '_header.php'; ?>

         <div class="row col-12 mx-auto d-flex justify-content-center rounded p-2">
             <div class="w-100 p-2   fs-6">
                 <p style="background:white;" class=" rounded p-2 m-0">Create New Admin workspace</p>
             </div>

             <?php



                if (isset($_SESSION['message'])) {

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

                $sql = "SELECT * FROM `user_register` where `roles` = 'admin'";
                $run = mysqli_query($con, $sql);
                ?>
             <div class="col-8 border bg-light" style="max-height: 90vh;overflow-y:scroll;">
                 <p class=" rounded p-2 my-2 fs-3 fw-bolder text-center">Manage Admins</p>
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
                            while ($row = mysqli_fetch_array($run)) {
                            ?>
                             <tr>
                                 <td><?php echo $row[0]  ?></td>
                                 <td><?php echo $row[1]  ?></td>
                                 <td><?php echo $row[2]  ?></td>
                                 <td><?php echo $row[3]  ?></td>
                                 <td><?php echo $row[4]  ?></td>
                                 <td class="d-flex justify-content-evenly">
                                     <a href="edit_catagory.php?id=<?php echo $row[0] ?>" class="btn  text-dark btn-sm"><i class="fas fa-pencil"></i></a>
                                     <a href="./delete.php?adminid=<?php echo $row[0] ?>" class="btn text-dark btn-sm"><i class="fas fa-trash"></i>
                                     </a>
                                 </td>
                             </tr>
                         <?php
                            }
                            ?>
                     </tbody>
                 </table>
             </div>
             <div class="form-container col-12 col-md-6 col-lg-4   " style="background:white;">
                 <h4 class="text-dark fw-bold text-center my-3">Create New Admin</h4>
                 <form method="post" class="mt-2">
                     <div class="col-12">
                         <label class="form-label mb-0">Full Name</label>
                         <input type="text" name="fullname" class="form-control mb-3" placeholder="Enter fullname">
                     </div>

                     <div class="col-12">
                         <label class="form-label mb-0">Username</label>
                         <input type="text" name="username" class="form-control mb-3" placeholder="Enter username">
                     </div>

                     <div class="col-12">
                         <label for="email" class="form-label mb-0">Email</label>
                         <input type="email" name="email" placeholder="Enter e-mail address" class="form-control mb-3" id="email">
                     </div>
                     <!-- <div class="col-12">
                         <label for="text" class="form-label mb-0 ">User Type</label>
                         <input type="text" name="admin" value="admin"  class="form-control mb-3" id="text">
                     </div> -->

                     <div class="col-12 position-relative">
                         <label class="form-label mb-0">Password</label>
                         <input type="password" name="password" placeholder="Enter password" class="form-control mb-3" id="pass">
                         <span id="passeye" onclick="showpass()" class="position-absolute align-items-center" style="right:10px;top: 30px;opacity: .6;cursor: pointer;"><span id="passeyetext" class="me-1 ">show</span><i class="fas fa-eye"></i></span>
                     </div>
                     <div class="d-block text-center my-3">
                         <button type="submit" name='register' class="btn w-50 w-sm-75 my-2" style="background:#1C1A7D;color: white;">Add Admin</button>
                     </div>
                 </form>
             </div>


         </div>
     </main>
 </body>
 <script src="../assets/bootstrap/js/bootstrap.min.js"></script>

 </html