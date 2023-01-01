<?php
session_start();
if (!isset($_SESSION['adminloggedin']) || $_SESSION['adminloggedin'] != true) {
    header('location: ../login.php');
    exit;
}
?>
<?php

include '../conn.php';

$showalert = false;
$showerror = false;
if (isset($_POST['submit'])) {

    $book_cover = $_FILES['book_cover']['name'];
    $book_name = $_POST['book_name'];
    $book_author = $_POST['book_author'];
    $book_price = $_POST['book_price'];
    $bpd = $_POST['book_price_discount'];
    $price = ($bpd / 100) * $book_price;
    $pr_result = $book_price - $price;
    $book_catagory = $_POST['book_catagory'];
    $book_type = $_POST['book_type'];
    $target = '../images/' . basename($book_cover);
    move_uploaded_file($_FILES['book_cover']['tmp_name'], $target);

    $sql = "INSERT INTO `tbl_add_book` ( `book_cover`, `book_name`, `book_author`,`book_price`,`book_price_discount`,`book_discount_percent`, `book_catagory`, `book_type`) VALUES ('$book_cover', '$book_name','$book_author', '$book_price', '$pr_result', '$bpd','$book_catagory' ,'$book_type')";
    $result = mysqli_query($con, $sql);

    if ($result) {
        $showalert = true;
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
  <strong>hurray!</strong> Product Added Sucessfully.
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
        <div class="row col-11 mx-auto d-flex justify-content-center pt-3">
            <div class="w-100 p-2   fs-6">
                <p style="background:white;" class=" rounded p-2 m-0">Book creation workspace</p>
            </div>

            <div class="form-container col-12 col-md-8 col-lg-6   " style="background:white;">
                <h4 class="text-dark fw-bold text-center my-3">Add New Books On Sale</h4>
                <form method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label mb-0 " style="font-size:.9rem;font-weight:500;">Enter Book Name</label>
                        <input style="background-color: #EEEEF8;" type="text" class="form-control" placeholder="Enter Book Name" name="book_name">
                    </div>
                    <div class="mb-3">
                        <label class="form-label mb-0 " style="font-size:.9rem;font-weight:500;">Enter Book Author Name</label>
                        <input style="background-color: #EEEEF8;" type="text" class="form-control" placeholder="Enter Book Author Name" name="book_author">
                    </div>
                    <div class="mb-3">
                        <div class="col-auto">
                            <label class="form-label mb-0 sr-only" style="font-size:.9rem;font-weight:500;">Enter Book price</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">$</div>
                                </div>
                                <input style="background-color: #EEEEF8;" type="text" class="form-control" placeholder="Enter Book price" name="book_price">
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="col-auto">
                            <label for="inlineFormInputGroup" class="form-label mb-0 sr-only" style="font-size:.9rem;font-weight:500;">Discount</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">%</div>
                                </div>
                                <input id="inlineFormInputGroup" style="background-color: #EEEEF8;" type="text" class="form-control" placeholder="Enter Book discount percentage" name="book_price_discount">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-floating  col-6">
                            <select  style="background-color: #EEEEF8;"  class="form-select form-select-sm" name="book_catagory" id="floatingSelect" aria-label="Floating label select example">
                                <?php
                                $query = "SELECT * FROM `tbl_category`";
                                $row = mysqli_query($con, $query);
                                while ($run = mysqli_fetch_array($row)) {
                                ?>
                                    <option><?php echo $run[2]; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                            <label class="ms-2" for="floatingSelect">Select Catagory</label>
                        </div>
                        <div class="form-floating mb-3 col-6">
                            <select  style="background-color: #EEEEF8;"  name="book_type" class="form-select form-select-sm col-3" id="floatingSelect" aria-label="Floating label select example">
                                <option value="Hard Copy" selected>Hard Copy</option>
                                <option value="CD or DVD">CD or DVD</option>
                                <option value="PDF">PDF</option>
                            </select>
                            <label class="ms-2    " for="floatingSelect">Select Book Type</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label mb-0 " style="font-size:.9rem;font-weight:500;">Add Book Cover</label>
                        <input style="background-color: #EEEEF8;" class="form-control" type="file" name="book_cover">
                    </div>
                    <div class="mb-3 ">
                        <button class="btn btn border  btn-md " name='submit' style="background:#F1F0FE;color:#1f22bd;font-weight:600;" type="submit"><i class="fas fa-book me-2"></i>Add Book</button>
                    </div>

                </form>
            </div>
            </div>
    </main>
</body>
<script src="../assets/bootstrap/js/bootstrap.min.js"></script>

</html>