 <?php
    session_start();
    if (!isset($_SESSION['adminloggedin']) || $_SESSION['adminloggedin'] != true) {
        header('location: ../login.php');
        exit;
    }
    $showalert = false;
    $showerror = false;
    if (isset($_POST['competition'])) {
        include '../conn.php';
        $title = $_POST['comp_title'];
        $topic = $_POST['comp_topic'];
        $start_date = $_POST['comp_start_date'];
        $end_date = $_POST['comp_end_date'];
        $prize = $_POST['comp_prize'];
        $comp_cover = $_FILES['comp_cover']['name'];
        $target = '../images/' . basename($comp_cover);
        move_uploaded_file($_FILES['comp_cover']['tmp_name'], $target);

        if (empty($comp_cover) || empty($title) || empty($topic) || empty($start_date) || empty($end_date) || empty($prize)) {
            $showerror = true;
        } else {
            $sql = "INSERT INTO `competitions`(`competition_cover`,`competition_topic`,`competition_title`,`competition_start_date`,`competition_end_date`,`competition_prize`) VALUES('$comp_cover','$topic','$title','$start_date','$end_date','$prize') ";
            $run = mysqli_query($con, $sql);
            $showalert = true;
        }
    }

    ?>

 <!doctype html>
 <html lang="en">

 <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <title>competitions</title>
     <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
     <link rel="stylesheet" href="../assets/fontawesome/css/all.min.css">
     <link rel="stylesheet" href="../assets/fontawesome/css/fontawesome.min.css">
     <link rel="stylesheet" href="admin.css">
     <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.1.2/css/all.css">
 </head>

 <body>
     <?php
        //     if ($showalert) {
        //         echo ' <div style="z-index:9999" class="alert alert-success alert-dismissible fade show" role="alert">
        //   <strong>hurray!</strong> Catagory Added Sucessfully.
        //   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        //   </div>';
        //     }
        //     if ($showerror) {
        //         echo '<div  style="z-index:9999"  class="alert alert-danger alert-dismissible fade show" role="alert">   
        //     <strong>error!</strong> ' . $showerror . '.
        //     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        //     </div>';
        //     }
        ?>
     <?php require '_asider.php'; ?>
     <main class="">
         <?php require '_header.php'; ?>
         <div class="row col-12 mx-auto d-flex justify-content-center rounded p-2">
             <div class="w-100 p-2   fs-6">
                 <p style="background:white;" class=" rounded p-2 m-0">manage competition workspace</p>
             </div>

             <?php

                include '../conn.php';

                include '../conn.php';
                $sql = "SELECT * FROM `competitions`";
                $run = mysqli_query($con, $sql);
                ?>
             <div class="col-8 border bg-light" style="max-height: 90vh;overflow:scroll;">
                 <p class=" rounded p-2 my-2 fs-3 fw-bolder text-center">Manage Your competitions</p>
                 <table class="table border-bottom">
                     <thead>
                         <tr class="" style="font-weight: 600;font-size:.9rem;">
                             <td scope="col">Id</td>
                             <td scope="col">COVER</td>
                             <td scope="col">TITLE</td>
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

                                 <td class="d-flex ">
                                     <a href="edit_competition.php?comp_id=<?php echo $row[0] ?>" class="btn  text-dark btn-sm"><i class="fa-solid fa-pen-to-square"></i></a>
                                     <a href="./delete.php?comp_id=<?php echo $row[0] ?>" class="btn text-dark btn-sm"><i class="fa-solid fa-trash-can"></i>
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
                 <h4 class="text-dark fw-bold text-center my-3">Create New Competition</h4>
                 <form method="post" enctype="multipart/form-data">
                     <div class="mb-3">
                         <label class="form-label mb-0 " style="font-size:.9rem;font-weight:500;">Competition Topic</label>
                         <input style="background-color: #EEEEF8;" type="text" class="form-control" placeholder="write an essay on myself" name="comp_topic">
                     </div>
                     <div class="mb-3">
                         <label class="form-label mb-0 " style="font-size:.9rem;font-weight:500;">Competition Title</label>
                         <input style="background-color: #EEEEF8;" class="form-control" type="text" name="comp_title" placeholder="essay writing">
                     </div>
                     <div class="mb-3">
                         <label class="form-label mb-0 " style="font-size:.9rem;font-weight:500;">Start Date</label>
                         <input style="background-color: #EEEEF8;" class="form-control" type="date" name="comp_start_date">
                     </div>
                     <div class="mb-3">
                         <label class="form-label mb-0 " style="font-size:.9rem;font-weight:500;">End Date</label>
                         <input style="background-color: #EEEEF8;" class="form-control" type="date" name="comp_end_date">
                     </div>
                     <div class="mb-3">
                         <label class="form-label mb-0 " style="font-size:.9rem;font-weight:500;">Winning Prize</label>
                         <input style="background-color: #EEEEF8;" class="form-control" type="text" name="comp_prize" placeholder="$100">
                     </div>
                     <div class="mb-3">
                         <label class="form-label mb-0 " style="font-size:.9rem;font-weight:500;">Cover Image</label>
                         <input style="background-color: #EEEEF8;" class="form-control" type="file" name="comp_cover" placeholder="$100">
                     </div>
                     <div class="mb-3 ">
                         <button class="btn btn border  btn-md " style="background:#F1F0FE;color:#1f22bd;font-weight:600;" name="competition" type="submit"><i class="fa-solid fa-plus me-2"></i>Create</button>
                     </div>

                 </form>
             </div>


         </div>
     </main>
 </body>
 <script src="../assets/bootstrap/js/bootstrap.min.js"></script>

 </html>