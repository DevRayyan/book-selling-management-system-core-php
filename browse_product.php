<?php
session_start();
include './conn.php';
$record = mysqli_num_rows(mysqli_query($con, "SELECT * FROM `tbl_add_book`"));
$page = 10;

$start = 0;

$pagination = ceil($record / $page);
if (isset($_GET['start'])) {
  $start = $_GET['start'];
  $start--;
} else {
  $start = 1;
}
$cur_page = $start;
$start = $start * $page;
$run = mysqli_query($con, "SELECT * FROM `tbl_add_book` limit $start,$page");
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>home</title>
  <link rel="stylesheet" href="./assets/fontawesome/css/all.min.css">
  <link href="./assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/mdb.min.css" />
  <!-- Custom styles for this template -->
  <link rel="stylesheet" href="style.css">

</head>

<body>
  <main>

    <?php require './partials/_nav.php'; ?>

    <!-- <style>
        .card {
          width: 220px;
          height: 320px;
          color: #000;
          background-color: #FFF;

        }

        .card-img {
          width: 100%;
          min-height: 170px;
          text-align: center;


        }

        .card-img img {
          height: 100%;

        }

        .card-name {
          font-size: 1rem;
          font-weight: 600;
          line-height: 20px;
          margin-top: 4px;
        }

        .card-author {
          line-height: 20px;
          font-size: 1rem;
          font-weight: 400;
        }

        .card-discount-price {
          color: #1C1A7D;
          font-weight: 600;
        }

        .real-price {
          color: #757575;
          font-weight: 100;
        }

        .card-discount-price {
          line-height: 20px;

        }

        .real-price-percent {
          font-size: .8rem;
          line-height: 20px;

        }

      </style> -->


    <?php

    // if(isset($_POST['submit'])){
    //   $keyword = $_POST['search'];
    //   $_SESSION['search'] = $keyword;
    //   $result= mysqli_query($con,"SELECT * from `tbl_add_book` where `book_name` like '%$keyword%' or `book_author` like '%$keyword%' or `book_catagory` like '%$keyword%'  ");
    // $count = mysqli_num_rows($result);

    //   
    ?>





    <section style="min-height:50vh;">

      <div class="d-flex m-0 p-4 justify-content-between" style="background-color: #fff;">

        <div class="search_engine position-relative w-50" style="height: 45px;">
          <input type="text" id="engine" class="form-control ps-5  h-100" placeholder="type your favourite books">
          <i class="fa-regular fa-magnifying-glass position-absolute top-50 start-0 px-3 d-flex align-items-center  h-100 " style="transform: translate(0,-50%);"></i>
        </div>
      </div>
      <div class="container-fluid card-container py-3">
        <!-- <p class="fs-4 ms-3 result">lorem</p> -->
        <?php
        if (mysqli_num_rows($run) > 0) {


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
        } else {
          ?>
          <div class="col-md-6 mt-5 ">
            <h1 class=" fw-bold text-dark" style="font-size:3rem;">NO RECORDS</h1>
            <!-- <h2 class="fw-bold">No Records Found</h2> -->
            <p class="">The page you are looking for does not exist.
              How you got here is a mystery. But you can click the button below
              to go back to the homepage.
            </p>
            <a href="./index.php" class="btn btn-outline btn-outline-primary rounded-pill">HOME</a>
          </div>
        <?php
        }
        ?>
        <div class="row m-0 my-4">
          <nav aria-label="...">
            <ul class="pagination pagination-circle justify-content-center">
              <li class="page-item">
                <a class="page-link">Previous</a>
              </li>

              <?php

              for ($i = 0; $i <= $pagination; $i++) {
                if ($cur_page == $i) {


              ?>
                  <li class="page-item active"><a class="page-link" href="?start=<?php echo $i+1 ?>"><?php echo $i+1 ?></a></li>

                <?php
                } else {
                ?>
                  <li class="page-item"><a class="page-link" href="?start=<?php echo $i+1 ?>"><?php echo $i+1 ?></a></li>

              <?php
                }
              }

              ?>

<li class="page-item">
                <a class="page-link">Next</a>
              </li>
            </ul>
          </nav>
        </div>
      </div>

    </section>









    <?php
    // } 
    ?>
    <?php require 'partials/footer.php'; ?>

  </main>
</body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.3.0/mdb.min.js"></script>

<script src="./assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="js/mdb.min.js"></script>

<script>
  $(document).ready(function() {
    $('#engine').keyup(function() {

      // alert($word)
      var word = $('#engine').val()

      $.ajax({
        url: 'search_engine.php',
        type: 'GET',
        data: {
          keyword: word
        },
        success: function(data) {
          $('.card-container').html(data);
        }

      })

    });
  });
</script>

</html>