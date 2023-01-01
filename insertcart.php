<?php
include './conn.php' ;
session_start();
// session_destroy();
if(isset( $_SESSION['userloggedin'])){
    if (isset($_POST['addcart'])) {
        $id = $_POST['id'];
        $quantity = $_POST['quantity'];
    $sql = mysqli_query($con, "SELECT * FROM `tbl_add_book` WHERE  `book_Id`='$id' ");
    $fetch = mysqli_fetch_array($sql);
    
    if (isset($_SESSION['cart'])) {
            $check_product = array_column($_SESSION['cart'], 'productname');
            if (in_array($fetch[2], $check_product)) {
                $_SESSION["showerror"] ="product already added";
                header("location:cart.php");
    // echo '
    // <script>alert("product already added")
    // window.location.href="cart.php"</script>';
    
            } else {
                $_SESSION['cart'][] = array('bookimg' => $fetch[1] , 'productname' => $fetch[2], 'bookauthname' => $fetch[3], 'qty' => $quantity , 'productprice' => $fetch[4],'productid' => $id);
               
                header('location: cart.php');
            }
        }else {
            $_SESSION['cart'][] = array('bookimg' => $fetch[1] , 'productname' => $fetch[2], 'bookauthname' => $fetch[3], 'qty' => $quantity , 'productprice' => $fetch[4],'productid' => $id);
           
            header('location: cart.php');
        }
    }
    
}else{
    header('location: login.php');

}
if (isset($_POST['remove'])) {
    foreach ($_SESSION['cart'] as $key => $value) {
        if ($value['productname'] === $_POST['name']) {
            unset($_SESSION['cart'][$key]);
            $_SESSION['cart'] = array_values($_SESSION['cart']);
   $_SESSION['showalert'] = "products successfully removed";

            header('location:cart.php');
        }
    }
}
if (isset($_POST['mod_qty'])) {
    foreach ($_SESSION['cart'] as $key => $value) {
        if ($value['productname'] === $_POST['name']) {
            $_SESSION['cart'][$key]['qty'] = $_POST['mod_qty'];

            header('location:cart.php');
        }
    }
}
