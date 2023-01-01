<?php

session_start();
include './conn.php';

$cat_sql = "SELECT * FROM `tbl_category` limit 18";
$catrow = mysqli_query($con, $cat_sql);


?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>home</title>
  <link href="./assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="./assets/fontawesome/css/all.min.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.3.0/mdb.min.css" rel="stylesheet" />

  <!-- MDB -->
  <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.3.0/mdb.min.css" rel="stylesheet" /> -->
  <link rel="stylesheet" href="css/mdb.min.css" />

  <!-- Custom styles for this template -->
  <link rel="stylesheet" href="style.css">
</head>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap');

  body {
    /* background: #000; */
    font-family: 'Roboto', sans-serif;

  }

  /*  catagories */
  .catagory {
    width: 100%;

    min-height: 297px;
  }

  .catagory-items {
    list-style: none;
    padding: 0;
    margin: 0;
  }

  .catagory-items li:hover {

    opacity: .85;
  }

  .catagory-items li {
    padding: 1px;

    max-height: 150px;

  }

  .catagory-items li img {
    width: 100%;
    height: 100%;
  }

  @media only screen and (max-width:768px) {
    .break {
      display: block;
    }
  }
  @media only screen and (max-width:400px) {
    .pr_layout{
width: 100% !important;    }
  }
</style>

<body>

  <!-- <div class="alert alert-primary border-none alert-dismissible fade show " role="alert">
  <i class="fa-regular fa-info-circle"></i>
  <strong>Winner Announcment! </strong> Congratulations <?php echo $fetch[2] ?> you are the winner of <b>"<?php echo $fetch1[2] ?> (<?php echo $fetch1[3] ?>)"</b>.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div> -->


  <main>
    <?php require './partials/_nav.php'; ?>
    <?php require './partials/_slider.php' ?>
    <?php
    if (isset($_SESSION["showalert"])) {
      echo '<div class="alert d-flex align-items-center justify-content-center alert-light shadow-sm py-3 rounded-2 alert-dismissible fade show position-absolute "style="left:50%;transform:translate(-50%);top:20px;" role="alert">
<div class="text-dark "><i class=" fa-solid fa-check text-success me-3"></i>' . $_SESSION["showalert"] . '.</div>
<button type="button" class="btn-close p-0 d-flex justify-content-center align-items-center h-100 px-3" style="font-size:13px;" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
    }
    if (isset($_SESSION["showerror"])) {
      echo '<div class="alert  d-flex align-items-center justify-content-center border  shadow-sm py-3 rounded-2 alert-dismissible fade show position-absolute "style="left:50%;transform:translate(-50%);top:20px;background-color:#ffffff;" role="alert">
<div class="text-dark "><i class=" fa-solid fa-xmark text-danger me-3"></i>' . $_SESSION["showerror"] . '.</div>
<button type="button" class="btn-close p-0 d-flex justify-content-center align-items-center h-100 px-3" style="font-size:13px;" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
    }
    ?>
    <!-- catagories -->

    <div class="container-fluid mb-5 px-3">
      <div class="d-flex justify-content-between   rounded my-2 px-3 text-dark " style="background-color:#A8327910;">
        <div class="fw-bold fs-3" style="color: #A83279;">CATEGORIES</div>
        <div><a class="btn fs-6  border-0 shadow-0 m-0 btn-md text-berry" href="./all_categories.php">See all <i class="fa-sharp fa-solid fa-angle-right ms-1"></i></a></div>

      </div>
      <ul class="catagory-items row m-0">
        <?php
        while ($cat_row = mysqli_fetch_array($catrow)) {
        ?>
          <li class=" col-6 position-relative col-md-2 col-sm-4 col-xs-12 text-center hover-shadow  d-flex justify-content-center align-items-center"><img src="./images/<?php echo $cat_row[1] ?>" alt="">
            <p class="text-white mb-0 position-absolute "><?php echo $cat_row[2] ?></p>
            <a href="./catagory_pages.php?category=<?php echo $cat_row[2] ?>" class="text-white mb-0 position-absolute w-100" style='height:100%;left:0;'></a>
          </li>

        <?php
        }
        ?>
      </ul>
    </div>
    <!-- catagories -->

    <section class="px-3">
      <div class="d-flex justify-content-between   rounded my-2 px-3 text-dark " style="background-color:#A8327910;">
        <div class="fw-bold fs-3" style="color: #A83279;">POPULAR BOOKS</div>
        <div><a class="btn fs-6  border-0 shadow-0 m-0 btn-md text-berry" href="./browse_product.php?start=1">See all <i class=" fs-5 fa-solid fa-arrow-right-long"></i></a></div>
      </div>
      <div class="container-fluid p-0 ">
        <?php
        $sql = "SELECT * FROM `tbl_add_book` ORDER BY  RAND() limit 10";
        $run = mysqli_query($con, $sql);
        while ($row = mysqli_fetch_array($run)) {
        ?>
          <form action="./insertcart.php" method="POST" enctype="multipart/form-data">
            <div class="row m-0 justify-content-center pr_layout col-10 mx-auto col-sm-12 mb-3 m-0 p-0">
              <div class=" col-md-12 p-0">
                <div class="card shadow-0 border rounded-3" style="background-color:#A8327903;">
                  <div class="card-body">
                    <div class="row m-0">
                      <div class="col-12 col-sm-3 text-center col-lg-2 mb-4 mb-lg-0">
                        <div class=" hover-zoom  rounded ripple-surface ">
                          <img height="200px" src="./images/<?php echo $row[1]  ?>" class="w-100" />
                          <a href="#!">
                            <div class="hover-overlay">
                              <div class="mask" style="background-color: rgba(253, 253, 253, 0.15);"></div>
                            </div>
                          </a>
                        </div>
                      </div>
                      <div class="col-sm-9 col-md-6 col-lg-7">
                        <div><span class="fs-4 text-dark"><?php echo $row[2] ?></span></div>
     
                        <div class="mt-1 mb-0 text-muted small">
                          <span><span class="text-dark">Author: </span><?php echo $row[3] ?></span><br>
                          <span><span class="text-dark">Category: </span><?php echo $row[7] ?></span><br>
                          <span><span class="text-dark">type: </span><?php echo $row[8] ?></span>

                        </div>
                        <div class="my-2 d-flex align-items-center">
                          <span class="me-2">Quantity</span>
                          <div class="col-sm-3 col-md-2 d-flex">
                            <button class="btn btn-link px-2" type="button" onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                              <i class="fas fa-minus"></i>
                            </button>

                            <input id="form1" min="1" max="5" name="quantity" value="1" style="width: 50px;" type="number" class="form-control form-control-sm rounded-0" />

                            <button class="btn btn-link px-2" type="button" onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                              <i class="fas fa-plus"></i>
                            </button>
                          </div>
                        </div>
                      </div>
                      <div class="flex-column flex-sm-row flex-md-column col-sm-12 d-flex col-sm-3 col-md-3 border-sm-start-none border-start">
                        <div class="col-12 col-sm-6 col-md-12">
                          <div class="d-flex flex-row align-items-center">
                            <h4 class="mb-1 text-dark me-1">$<?php echo $row[4] ?></h4>
                            <span class="text-muted">$<s><?php echo $row[5] ?></s></span>
                          </div>
                          <h6 class="text-dark">-<?php echo $row[6] ?>%</h6>
                          <h6 class="text-success fs-7 mx-0 m-1"><i class="fa-solid fa-truck me-2"> </i><span class="text-dark">Free shipping</span></h6>
                          <h6 class="text-muted fs-7 mb-3">delivery only available in karachi</h6>
                        </div>
                        <div class="d-flex flex-column col-12 col-sm-6 col-md-12">
                          <button class="btn btn-primary btn-sm" name="addcart" type="submit">Add to cart</button>
                          <button class="btn btn-outline-primary btn-sm mt-2" type="button">
                            Add to wishlist
                          </button>
                          <input type="hidden" name="id" value="<?php echo $row[0] ?>">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
        <?php
        }
        ?>
      </div>
    </section>
    
    <?php require 'partials/footer.php'; ?>
  </main>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="./assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="js/mdb.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.3.0/mdb.min.js"></script>

</html>
<?php unset($_SESSION['showerror']);
unset($_SESSION['showalert']);
?>