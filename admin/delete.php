<?php
include '../conn.php';
$adminid = $_GET['adminid'];
$userid = $_GET['userid'];
$id = $_GET['id'];
$cat_id = $_GET['catid'];
$sliderid = $_GET['sliderid'];
$comp_id = $_GET['comp_id'];

if($id){
$query = "DELETE FROM `tbl_add_book` WHERE `tbl_add_book`.`book_Id` = '$id'";
$result = mysqli_query($con,$query);
if($result){
  
    header('location:manage_product.php');
}

}else if($cat_id){


    $query = "DELETE FROM `tbl_add_catagory` WHERE `tbl_add_catagory`.`catagory_id` = '$cat_id'";
$result = mysqli_query($con,$query);
if($result){
  
    header('location: ./catagory.php');
}
}else if($adminid){
    $query = "DELETE FROM `user_register` WHERE `user_register`.`user_Id` = '$adminid'";
$result = mysqli_query($con,$query);
if($result){
  
    header('location: ./add_new_admin.php');}
}else if($userid){
    $query = "DELETE FROM `user_register` WHERE `user_register`.`user_Id` = '$userid'";
$result = mysqli_query($con,$query);
if($result){
  
    header('location: ./user.php');}
}else if($sliderid){
    $query = "DELETE FROM `slider` WHERE `slider`.`slider_Id` = '$sliderid'";
    $result = mysqli_query($con,$query);
    if($result){
      
        header('location: ./custom_slider.php');
}
}else if($comp_id){
    $query = "DELETE FROM `competitions` WHERE `competitions`.`competition_id` = '$comp_id'";
    $result = mysqli_query($con,$query);
    if($result){
      
        header('location: ./competitions.php');
}
}
?>
