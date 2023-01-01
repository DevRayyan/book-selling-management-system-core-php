<?php
include './conn.php';

$query = "SELECT * FROM tbl_category  ";
$result = mysqli_query($con,$query);

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
    <main>
        <?php require './partials/_nav.php'; ?>
        <div class="container-fluid w-100 flash_sale pt-2 ">

    <div class="container-fluid fs-2 fw-bold" style="color:#1C1A7D;">All Categories</div>
    <div class="container-fluid card-container justify-content-evenly flex-wrap border d-flex  p-0" style="background-color: #E9E8F9;">
    <style>
      .catagory {
        width: 100%;

        min-height: 297px;
      }

      .catagory-items {
        list-style: none;
        padding: 0;
        margin: 0;
      }

      .catagory-items li {
        padding: 1px;

        max-height: 200px;

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
    </style>
    <ul class="catagory-items row">
      <?php  
      while ($cat_row = mysqli_fetch_array($result)) {
        ?>
<li class=" col-6 position-relative col-md-3 col-sm-4 col-xs-12 hover-shadow  d-flex justify-content-center align-items-center"><img src="./images/<?php echo $cat_row[1] ?>" alt="">
          <p class="text-white mb-0 position-absolute "><?php echo $cat_row[2] ?></p>
      <a href="./catagory_pages.php?category=<?php echo $cat_row[2]?>"class="text-white mb-0 position-absolute w-100" style='height:100%;left:0;'></a>
      </li>
        
        <?php  
      }
      ?>
      </ul>
    </div>
<?php  require 'partials/footer.php';?>

    </main>
</body>
<script src="./assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<script   src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.3.0/mdb.min.js"></script>

</html>