<?php
session_start();
if (!isset($_SESSION['userloggedin']) || $_SESSION['userloggedin'] != true) {
    header('location: ./login.php');
    exit;
}
$id = $_SESSION['id'];
include 'conn.php';

if (isset($_POST['delete_details'])) {
    $del = mysqli_query($con, "DELETE from `order_details` where `user_id` = '$id'");
}
$count = false;
if (isset($_SESSION['cart'])) {
    $count = true;
}
$id = $_SESSION['id'];
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>cart</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/headers/">
    <link rel="stylesheet" href="./assets/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="./assets/fontawesome/css/fontawesome.min.css">
    <link href="./assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- MDB -->
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.3.0/mdb.min.css" rel="stylesheet" /> -->

    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <!-- Custom styles for this template -->
    <link href="./style.css" rel="stylesheet">
    <link rel="stylesheet" href="css/mdb.min.css" />

</head>

<body>
    <?php

    $success = false;
    if (isset($_SESSION['success'])) {
        $success = true;
    }
    if ($success) {
        $name = mysqli_query($con, "SELECT * FROM `user_register` WHERE `user_id` = $id");
        $user = mysqli_fetch_array($name);

    ?>


        <div id="popupups" class="fixed-top vh-100 w-100 popup" style="background-color: #000000a0;">

            <div class="col-12 col-sm-8 col-md-7 col-lg-5  position-absolute top-50 start-50" style="transform:translate(-50%,-50%);">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header border-bottom-0 ms-auto">
                            <button id="closepopup" type="button" class="btn-close" data-mdb-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body text-start text-black p-4">
                            <h5 class="modal-title text-uppercase mb-5" id="exampleModalLabel">hello, <?php echo $user[2] ?></h5>
                            <h4 class="" style="color: #35558a;">Thanks for your order</h4>
                            <p>your order has been recieved</p>
                            <p class="mb-0" style="color: #35558a;">Payment summary</p>
                            <hr class="mt-2 mb-4" style="height: 0; background-color: transparent; opacity: .75; border-top: 2px dashed #9e9e9e;">
                            <?php



                            foreach ($_SESSION['cart'] as $key => $value) {
                            ?>

                                <div class="d-flex justify-content-between">
                                    <p class=" "><?php echo $value['productname'] . '(Qty' . $value['qty'] ?>) <br> <span class="text-muted mb-2">subtotal (<span class="mb-2 pt-1 ">$<?php echo ($value['productprice'] * $value['qty']) ?></span>)</span></p>


                                    <p class="text-muted text-end">$<?php echo $value['productprice'] ?>

                                    </p>
                                </div>

                            <?php
                            }

                            ?>
                            <div class="d-flex justify-content-between">

                                <p class="p-0 m-0">shipping fee</p>

                                <p class="text-muted text-end">$<?php echo $_SESSION['shipping'] ?>

                                </p>
                            </div>

                            <div class="d-flex justify-content-between">
                                <p class="fw-bold fs-4 my-2">Grand Total:</p>
                                <p class="fw-bold my-2 fs-4" style="color: #35558a;">$<?php echo $_SESSION['grand'] ?></p>
                            </div>

                        </div>
                        <div class="modal-footer d-flex justify-content-center border-top-0 py-4">
                            <a href="./index.php" class="btn   text-primary rounded-0 btn-outline btn-outline-primary"> Continue Shopping</a>
                        </div>
                    </div>
                    <!-- </div> -->
                </div>
            </div>

        </div>




    <?php
        unset($_SESSION['cart']);
    }
    ?>
    <style>
        .loader {
            pointer-events: none;
            width: 17px;
            height: 17px;
            border-radius: 50%;
            border: 2px solid transparent;
            border-top-color: #fff;
            animation: btn-animation 1s ease infinite;
            margin: auto;
        }

        @keyframes btn-animation {
            0% {
                transform: rotate(0turn);
            }

            100% {
                transform: rotate(1turn);
            }
        }
    </style>
    <?php require './partials/_nav.php';


    if (isset($_SESSION["showalert"])) {
        echo '<div class="alert d-flex align-items-center justify-content-center alert-light shadow-sm py-3 rounded-2 alert-dismissible fade show col-10 col-sm-6  fixed-top"style="left:50%;transform:translate(-50%);top:20px;" role="alert">
  <div class="text-dark "><i class=" fa-solid fa-check text-success me-3"></i>' . $_SESSION["showalert"] . '.</div>
  <button type="button" class="btn-close p-0 d-flex justify-content-center align-items-center h-100 px-3" style="font-size:13px;" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
    }
    if (isset($_SESSION["showerror"])) {
        echo '<div class="alert  d-flex align-items-center justify-content-center border  shadow-sm py-3 rounded-2 alert-dismissible fade show col-12 col-md-6 fixed-top "style="left:50%;transform:translate(-50%);top:20px;background-color:#ffffff;" role="alert">
  <div class="text-dark "><i class=" fa-solid fa-xmark text-danger me-3"></i>' . $_SESSION["showerror"] . '.</div>
  <button type="button" class="btn-close p-0 d-flex justify-content-center align-items-center h-100 px-3" style="font-size:13px;" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
    };
    ?>

    <section class="mt-4">
        <div class="container_fluid ">
            <div class="row m-0 d-flex justify-content-start align-items-center h-100">
                <div class="my-5">
                    <div class="fw-bold fs-2 text-berry p-0 m-0 ps-3 "><i class="fa-solid fa-shopping-bag"></i> Shopping bag </div>
                    <span class="p-0 m-0 ps-3">(<?php if ($count) {
                                                    echo count($_SESSION['cart']) . ' items in your bag';
                                                } else {
                                                    echo 'your cart is empty';
                                                };
                                                ?>)</span>
                </div>
                <div class="row m-0 p-0 px-2 px-md-5 mb-5 ">

                    <div class=" col-12   cart  border indecator" style="min-height:500px;width:100%;background:#fff;overflow:scroll;">
                        <table class="table  text-center">
                            <thead class="">
                                <tr class="">

                                    <th>Product</th>
                                    <th>Description</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th style="white-space: nowrap;">Total Price</th>
                                    <th>Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                if (isset($_SESSION['cart'])) {
                                    foreach ($_SESSION['cart'] as $key => $value) {
                                ?>
                                        <tr class="align-middle">
                                            <td style="width:70px;height:70px;" scope="row"><img height="100%" src="images/<?php echo $value['bookimg'] ?>" class="img-fluid">
                                            </td>
                                            <td style="white-space: nowrap;"><?php echo $value['productname'] ?><br><?php echo $value['bookauthname'] ?></td>
                                            <td style="white-space: nowrap;">$<?php echo $value['productprice'] ?><input type="hidden" class="iprice" value="<?php echo $value['productprice'] ?>" /></td>
                                            <td>
                                                <div style="width: 100px;" class=" d-flex mx-auto">
                                                    <form action="./insertcart.php" method="POST">
                                                        <input class="iqty" name="mod_qty" onchange="this.form.submit()" min="1" max="5" name="quantity" value="<?php echo $value['qty'] ?>" type="number" class="form-control form-control-sm rounded-0" />
                                                        <input type="hidden" name='name' value="<?php echo $value['productname'] ?>">
                                                    </form>

                                                </div>
                                            </td>
                                            <td>$<span class="itotal"></span></td>
                                            <form method="post" action="./insertcart.php">
                                                <td><button type="submit" name="remove" class="message-btn btn ms-2 shadow-0 alert-danger btn-floating btn-sm"><i class="fa-solid fa-trash "></i></button>
                                                </td>
                                                <input type="hidden" name='name' value="<?php echo $value['productname'] ?>">
                                            </form>
                                        </tr>
                                <?php
                                    }
                                } else {
                                    echo '<tr class="align-middle">
                                    <td colspan="6" style="width:70px;height:70px;" scope="row">cart is empty                                         <a class=" btn btn-md text-light bg-berry mx-3 rounded-0" href="./index.php" style="text-transform:none;">Continue Shopping </a>
                                    </td>
                        
                                </tr>';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <?php
                    if (isset($_SESSION['cart'])) {
                    ?>
                        <div class="row m-0 p-0  ">
                            <div class="col-12 col-md-7 px-2 text-dark  rounded my-4">
                                <div class="fs-5 px-2  text-dark">Shipping Address</div>
                                <?php
                                $detail = mysqli_query($con, "SELECT * FROM `order_details` where `user_id` = '$id'");
                                $fetch_data = mysqli_num_rows($detail);
                                $get_details = mysqli_fetch_array($detail);
                                if ($fetch_data > 0) {


                                ?>
                                    <p class="d-block ps-2">Edit your shipping address, and save it. </p>
                                <?php } else {
                                ?>
                                    <p class="d-block ps-2">Enter your shipping address, and save it. </p>

                                <?php
                                }
                                ?>
                                <form method="post">
                                    <div class="px-2" style="font-size:.9rem ;">
                                        <div class=" row d-flex justify-content-between my-2 m-0">
                                            <?php
                                            ?>
                                            <div class="form-outline col-12 col-sm-5 ">
                                                <input type="text" required id="fullname" name="fullname" id="typeText" class="form-control" />
                                                <label class="form-label" for="typeText">Full name</label>
                                            </div>
                                            <div class="form-outline col-12 col-sm-5 mt-3 mt-sm-0 ms-sm-3  me-auto">
                                                <input type="text" required id="username" name="username" id="typeText" class="form-control" />
                                                <label class="form-label" for="typeText">Username</label>
                                            </div>
                                        </div>
                                        <div class=" row d-flex justify-content-between my-3 m-0">
                                            <div class="form-outline col-12 col-sm-5 ">
                                                <input type="email" required id="email" name="email" id="typeText" class="form-control" />
                                                <label class="form-label" for="typeText">Email address</label>
                                            </div>
                                            <div class="form-outline col-12 col-sm-5 mt-3 mt-sm-0 ms-sm-3  me-auto">
                                                <input type="tel" required id="phoneno" name="phoneno" id="typeText" class="form-control" />
                                                <label class="form-label" for="typeText">Phone no</label>

                                            </div>
                                        </div>
                                        <div class=" row d-flex justify-content-between my-3 m-0">

                                            <div class="form-outline col-12 col-sm-5">
                                                <input type="text" required id="country" name="country" id="typeText" class="form-control" />
                                                <label class="form-label" for="typeText">Country</label>
                                            </div>
                                            <div class="form-outline col-12 col-sm-5 mt-3 mt-sm-0 ms-sm-3 me-auto">
                                                <input type="text" id="city" name="city" id="typeText" class="form-control" />
                                                <label class="form-label" required id="city" for="typeText">City</label>
                                            </div>
                                        </div>
                                        <div class=" row d-flex justify-content-between my-3 m-0">

                                            <div class="form-outline col-12 col-sm-5">
                                                <input type="text" required id="address" name="address" id="typeText" class="form-control" />
                                                <label class="form-label" for="typeText">Home Address</label>
                                            </div>
                                            <div class="form-outline col-12 col-sm-5 mt-3 mt-sm-0 ms-sm-3 me-auto">
                                                <input type="number" required id="postal_code" name="postal_code" id="typeText" class="form-control" />
                                                <label class="form-label" for="typeText">Postal Code</label>
                                            </div>
                                        </div>
                                        <div class="row d-flex justify-content-between  m-0 p-0">
                                            <div class="col-12 col-sm-5 p-0 m-0">
                                                <div>Payment Method</div>

                                                <div class="col-12">
                                                    <select id="payment_mode" name="payment_mode" class="form-control  ">

                                                        
                                                            <option selected value="Cash on delivery">COD</option>
                                                            <option value="Credit / Debit card">Credit / Debit card</option>
                                                            <option value="Paypal">Paypal</option>
                                                  
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-5  mt-2 me-auto">
                                            <?php

                                            if ($fetch_data > 0) {
                                            ?>
                                                <button type="button" class="submit col-12 col-sm-6 btn  rounded-0 text-light mt-3 bg-primary ">Saved <i class="fa-solid fa-check ms-1 p-1 rounded-circle border"></i> </button>
                                            <?php
                                            } else {
                                            ?>
                                                <button type="button" class="submit col-12 col-sm-6 btn  rounded-0 text-light mt-3 bg-berry ">save details</button>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-12 col-md-5 my-2 mb-5 border">
                            <?php
                            $details = mysqli_query($con, "SELECT * FROM `order_details` where `user_id` = '$id'");
                            $fetch_id = mysqli_num_rows($details);
                            if (($fetch_id > 0)) {

                                $get_details = mysqli_fetch_array($details);

                            ?>
                                <div class="card m-0 p-2 container-details shadow-0 position-relative border rounded-0 mt-3">
                                    <div class="text-dark fs-5">Saved details</div>
                                    <div><span>Fullname :</span><span class="text-muted"> <?php echo $get_details[1] ?></span></div>
                                    <div><span>Username :</span><span class="text-muted"> <?php echo $get_details[2] ?></span></div>
                                    <div><span>Email Address :</span><span class="text-muted"> <?php echo $get_details[3] ?></span></div>
                                    <div><span>Phone number :</span><span class="text-muted"> <?php echo $get_details[4] ?></span></div>
                                    <div><span>Country :</span><span class="text-muted"> <?php echo $get_details[5] ?></span></div>
                                    <div><span>City :</span><span class="text-muted"> <?php echo $get_details[6] ?></span></div>
                                    <div><span>Current Address :</span><span class="text-muted"> <?php echo $get_details[7] ?></span></div>
                                    <div><span>Postal Code :</span><span class="text-muted"> <?php echo $get_details[8] ?></span></div>
                                    <div><span>Payment method :</span><span class="text-muted"> <?php echo $get_details[9] ?></span></div>
                                    <form method="POST">
                                        <button type="submit" name="delete_details" class="position-absolute top-0 end-0 border-0   text-muted p-3 d-flex justify-content-center align-items-center cursor-pointer "><i class="fa-solid fa-xmark "></i></button>
                                    </form>
                                </div>
                                <hr>
                            <?php
                            } else {
                                echo '<div class="text-muted px-2 cursor-pointer"><div class="p-4">please saved your shipping address</div></div>';
                            }
                            ?>
                            <form method="post" action="./order_placed.php">
                                <div class="p-2 card shadow-0">
                                    <div class="p-4">
                                        <p class="p-0 m-0 p-0 d-flex align-items-center text-dark">
                                            <span class="fs-6  text-dark small me-2 ">Shipping Fee </span> <span style='color:#1C1A7D;font-weight:500;' class="fs-6 text-muted">$<span id="shippingfee"><?php if (count($_SESSION['cart']) >= 5) {
                                                                                                                                                                                                            echo 0;
                                                                                                                                                                                                        } else {
                                                                                                                                                                                                            echo 2;
                                                                                                                                                                                                        } ?></span></span>
                                        </p>
                                        <!-- <span class="p-0 m-0">ORDER UPTO 5 BOOK YOU CAN GET FREE DELIVERY</span> -->
                                        <p class="p-0 m-0   d-flex align-items-center text-dark">
                                            <span class="fs-6  text-dark small me-2 ">Discount </span> <span style='color:#1C1A7D;font-weight:500;' class="fs-6  text-muted ">$0.00</span>
                                        </p>
                                        <p class="p-0  m-0 rounded d-flex align-items-center text-dark ">

                                            <span class="fs-3 fw-bold text-berry small me-2 ">Grand Total: </span><span class="fs-3 ">$<span id="gtotal"></span></span>
                                            <input type="hidden" name="total_pr" id="totalprice">
                                        </p>
                                  
                                        <div class="d-flex justify-content-center p-3 border-top" style="background:#fff;">
                                            <a class=" btn btn-md text-light bg-primary mx-3 rounded-0" href="./index.php" style="text-transform:none;">Continue Shopping</a>
                                            <?php
                                            $details = mysqli_query($con, "SELECT * FROM `order_details` where `user_id` = '$id'");
                                            $fetch_id = mysqli_num_rows($details);
                                            if ($fetch_id > 0) {
                                            ?>
                                                <input type="submit" name="order" class=" btn btn-md text-light bg-berry rounded-0" value="placed your order">
                                            <?php } else {
                                            ?>

                                                <input type="button" class="disabled btn btn-md text-light bg-berry rounded-0" value="placed your order">

                                            <?php
                                            } ?>
                                            <input type="hidden" id="fee" name="shipping_fee">
                                        </div>

                                    </div>


                                </div>
                            </form>
                        </div>
                </div>
            </div>
        <?php

                    }
        ?>
        <style>
            .indecator::-webkit-scrollbar {
                display: none;
            }

            /* .fade {
                    right: 10px;
                    opacity: 0;
                    cursor: pointer;
                } */
        </style>

    </section>
    <!-- <div id="note" class="notify bg-light shadow shadow-lg border fade" style="width: 300px;position:fixed;top:10px;">
        <div class="notify-head  border-bottom p-1 d-flex  px-2  align-items-center justify-content-between">
            <i class="fas fa-solid fa-check check text-success rounded-circle"></i>
            <div class="d-flex align-items-center">
                <span class="me-2 fs-7">just now</span>
                <button onclick="closes()"><i class="fa-solid fa-xmark close" ></i></button>
            </div>
        </div>
        <div class="notify-content p-2">your details was successfully saved .
        </div>
    </div> -->


    <?php require 'partials/footer.php'; ?>
</body>


</html>

<script>
    gt = 0
    iqty = document.getElementsByClassName('iqty');
    iprice = document.getElementsByClassName('iprice');
    itotal = document.getElementsByClassName('itotal');
    gtotal = document.getElementById('gtotal');
    totalprice = document.getElementById('totalprice');
    ship = document.getElementById('shippingfee');
    fee = document.getElementById('fee');

    function subtotal() {
        gt = 0

        for (i = 0; i < iprice.length; i++) {

            itotal[i].innerText = (iprice[i].value) * (iqty[i].value);
            gt = gt + ((iprice[i].value) * (iqty[i].value));
        }
        gtotal.innerText = gt + parseInt(ship.innerText);
        totalprice.value = gt + parseInt(ship.innerText);
        fee.value = ship.innerText;
    }
    subtotal();

    // for toast 
    $(document).ready(function() {

        // $('.close').click(function(){
        //    alert('erghergh')
        // })

        $('#closepopup').click(function() {
$("#popupups").addClass("d-none") 
       })
        $('.submit').click(function() {
            $(this).html("<div class='d-flex justify-content-center'><span class='me-1'>please wait</span><div class='loader'></div></div>");

            $(this).attr('disabled', true);


   
                    // console.log(fullname + username + email + phoneno + country + city + address + postal_code+payment_mode)

            $.ajax({
                url: 'user_details.php',
                type: 'POST',
                data: {
                    id: <?php echo $_SESSION['id'] ?>,
                    fullname: $('#fullname').val(),
                    username: $('#username').val(),
                    email: $('#email').val(),
                    phoneno: $('#phoneno').val(),
                    country: $('#country').val(),
                    city: $('#city').val(),
                    address: $('#address').val(),
                    postal_code: $('#postal_code').val(),
                    payment_mode: $('#payment_mode').val()
                },
                success: function(data) {

                        $('.contaner-details').html(data);
                        $('.submit').attr('disabled', false);
                        $('.submit').removeClass('bg-berry');
                        $('.submit').addClass('bg-primary');
                        $('.submit').html("<div class='d-flex justify-content-center align-items-center'><span class='me-2'>Saved</span><div class='fa-solid fa-check me-2'></div></div>");

                        $("body").load("cart.php")
                           }
            });
        });
    });
</script>
<script src="./assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.3.0/mdb.min.js"></script>
<script type="text/javascript" src="js/mdb.min.js"></script>
<?php
unset($_SESSION['success']);

?><?php unset($_SESSION['showerror']);
    unset($_SESSION['showalert']);
    ?>