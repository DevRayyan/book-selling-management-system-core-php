<?php
include './conn.php';
$word = $_GET['keyword'];
$sql = mysqli_query($con, "SELECT * FROM `tbl_add_book` WHERE `book_name` like  '%$word%' or `book_catagory` like  '%$word%' limit 10 ");
$fetch = mysqli_num_rows($sql);
if ($fetch > 0) {


  while ($row = mysqli_fetch_array($sql)) {
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
  <div>No results found</div>
<?php
}
?>