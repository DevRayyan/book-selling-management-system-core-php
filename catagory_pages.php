<?php
include './conn.php';
$name = $_GET['category'];
$query = "SELECT * FROM tbl_add_book where `book_catagory`='$name' ";
$result = mysqli_query($con, $query);

?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title><?php echo $name ?></title>
  <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/headers/">
  <link rel="stylesheet" href="./assets/fontawesome/css/all.min.css">
  <link rel="stylesheet" href="./assets/fontawesome/css/fontawesome.min.css">
  <link href="./assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.1.2/css/all.css">
  <!-- MDB -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.3.0/mdb.min.css" rel="stylesheet" />
  <!-- Custom styles for this template -->
  <link href="./style.css" rel="stylesheet">

</head>

<body>
  <main style="min-height:50vh;">
    <?php require './partials/_nav.php'; ?>
    <div class="container-fluid w-100 flash_sale pt-2 ">
      <div class="container-fluid fs-2 fw-bold" style="color:#1C1A7D;">Category</div>
      <div class="container-fluid text-dark fs-5"><?php echo $name ?></div>

      <div class="container-fluid card-container py-3">
        <?php
        while ($row = mysqli_fetch_array($result)) {
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
                        <div><span class="fs-4 text-dark"><?php echo $row[2] ?></span> </div>
     
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

      <?php require 'partials/footer.php'; ?>

  </main>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.3.0/mdb.min.js"></script>
<script src="./assets/bootstrap/js/bootstrap.bundle.min.js"></script>

</html>