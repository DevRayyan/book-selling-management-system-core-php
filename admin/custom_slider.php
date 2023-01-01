<?php

session_start();

include '../conn.php';

if (isset($_POST['upload'])) {
    $imgname = $_FILES['slider_img']['name'];
    $target = '../images/' . basename($imgname);
    move_uploaded_file($_FILES['slider_img']['tmp_name'], $target);
    if (empty($imgname)) {
        echo '<script>alert(Feild are empty please Fill First)</script> ';
    } else {
        $sql = "INSERT into `slider`(`slider_image`)  VALUES('$imgname')";
        $result = mysqli_query($con, $sql);
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
    <?php require '_asider.php'; ?>
    <main class="">
        <?php require '_header.php'; ?>
        <div class="row col-11 mx-auto d-flex justify-content-center pt-3">
            <div class="w-100 p-2   fs-6">
                <p style="background:white;" class=" rounded p-2 m-0">Customize slider workspace</p>
            </div>
        </div>
        <div class="mx-auto col-11 row">
            <div class="fs-4 fw-normal">Add Slider Images</div>
            <div class="col-8">
                <form method="post" enctype="multipart/form-data">
                    <input type="file" name="slider_img" class="form-control">
                    <button type="submit" name="upload" class="btn btn-dark my-2">Add Image</button>
                </form>
            </div>
            <div class="col-4 bg-light border">
                <div>
                    Slider Images preview
                </div>
                <table class="table">
                    <?php
                    include '../conn.php';
                    $query = 'SELECT * from `slider`';
                    $run = mysqli_query($con, $query);
                    while ($row = mysqli_fetch_array($run)) {
                    ?>
                        <tr class="text-center ">

                            <td><?php echo $row[0] ?></td>
                            <td style="width: 100px;height:100px;"><img class="img-fluid" src="../images/<?php echo $row[1] ?>" alt=""></td>
                            <td > <a  href="delete.php?sliderid=<?php echo $row[0]; ?>" class="btn  text-dark fs-6 btn-sm"><i class="fa-solid fa-trash-can"></i>
                                </a></td>
                        </tr>
                    <?php
                    }
                    ?>

                </table>
            </div>
        </div>
    </main>
</body>

</html>