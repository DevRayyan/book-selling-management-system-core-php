<?php 
include './conn.php' ;
session_start();
$user_id = $_SESSION['id'];

if(isset($_POST['order'])){
$grand = $_POST['total_pr'];
$sf = $_POST['shipping_fee'];

$_SESSION['grand'] = $grand;
$_SESSION['shipping'] = $sf;

foreach ($_SESSION['cart'] as $key => $value) {
    $name = $value['productname'];
    $auth = $value['bookauthname'];
    $price = $value['productprice'];
    $qty = $value['qty'];
    $pid = $value['productid'];
    
    $sql = mysqli_query($con,"INSERT INTO `tbl_orders`(`order_id`,`Product_Id`, `order_name`, `author`, `order_price`, `order_qty`) VALUES('$user_id','$pid','$name','$auth','$price','$qty')");
if($sql){
$_SESSION['success'] = true;
}
    header('location:cart.php');

//    echo $value['productid'];
}


}

?>