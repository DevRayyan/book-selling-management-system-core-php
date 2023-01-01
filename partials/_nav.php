<?php
include 'conn.php';
$count = false;
if (isset($_SESSION['cart'])) {
  $count = true;
}
if (!isset($_SESSION['userloggedin']) || $_SESSION['userloggedin'] != true) {
  $login = false;
} else {
  $login = true;
}
?>
<header class="row text-light text-center px-5 fs-7 py-2" style="background:#232639;">
<div class="col-12 col-sm-6 text-sm-start">Helpline no +92 3170777289</div>
<div  class="col-12 col-sm-6 text-sm-end ">
<?php 
if(!$login){
  ?>
<a class="login me-4 cursor-pointer text-light"  href="./login.php">Login</a>|<a class="signup ms-4 cursor-pointer text-light"  href="./signup.php" >Register </a>
  <?php
}else{
  ?>
  <a class="login me-4 cursor-pointer text-light"  href="./logout.php">Logout <i class="fa-solid text-danger fa-right-from-bracket"></i></a>
  <?php
}
?>
</div>
</header>
<nav class="navbar navbar-expand-md navbar-light bg-light p-0 shadow shadow-sm py-2 position-relative">
  <div class="container-fluid ">
    <a class="navbar-brand fs-4 fw-bold text-dark " href="#"><i class="fa-solid text-berry fa-book-open-cover me-1"></i> BookMate</a>
    <button class="navbar-toggler position-absolute start-0 ms-2 mt-2 text-dark " type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"> <i class="fa-regular fa-bars"></i></span>
    </button>
      <div class="profile cursor-pointer px-3 position-absolute end-0 me-2 mt-2 "  style="height: 40px;line-height:40px;"><a  href="./cart.php"><i class="text-dark fa-regular fs-4 fa-shopping-cart"></i><?php if ($count) {
    echo '<div class="badge indecator rounded-circle  bg-danger position-absolute start-50 ">' . count($_SESSION['cart']) . '</div>';
} else {
    echo '<div class="badge rounded-circle  d-none"></div>';
};
?></a></div>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav  fs-7 fw-500">
        <li class="nav-item ">
          <a class="nav-link text-berry fs-7" href="./index.php">Home</a>
        </li>
        <li class="nav-item dropdown">
        <a class="nav-link text-dark" href="#" id="navbarDropdownMenuLink" role="button"
          data-mdb-toggle="dropdown" aria-expanded="false">
         Category <i class="fa-solid fa-angle-down"></i>
        </a>
        <ul class="dropdown-menu rounded-0 " aria-labelledby="navbarDropdownMenuLink">
<?php 
$category = mysqli_query($con,"SELECT * FROM  `tbl_category`");
while($fetch_category = mysqli_fetch_array($category)){

  ?>
<li>
  <a class="dropdown-item rounded-0" href="./catagory_pages.php?category=<?php echo $fetch_category[2]?>"><?php echo $fetch_category[2]?></a>
</li>


  <?php
}
?>
        </ul>
      </li>

      <li class="nav-item ">
        <a class="nav-link text-dark rounded-0" href="./browse_product.php">Products</a>
      </li>
      <li class="nav-item ">
        <a class="nav-link text-dark rounded-0" href="./about.php">About us</a>
      </li>
      <li class="nav-item ">
        <a class="nav-link text-dark rounded-0" href="./contact.php">Contact us</a>
      </li>

      </ul>
      <style>
        .indecator{
          width: 15px;
          height:15px;
      padding: 0% !important;
                  padding-top: 2px !important;                  
        }
      </style>
    </div>
    <div class="search d-flex position-absolute end-0" style="height: 40px;top:50%;transform:translate(0,-50%);">
      <!-- <form method="POST" action="./browse_product.php"  class="">
      <div class="search-box d-flex "><input type="text" name="search"  placeholder="Search" class="form-control rounded-0 "><button type="submit" name="submit" class="btn h-100 rounded-0 shadow-0  alert-dark"><i class="fa-solid fa-magnifying-glass"></i></button>
    </div>
  </form> -->

</div>
    <!-- User Account Dropdown closed -->
  </div>

</nav>
