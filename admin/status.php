<?php
include '../conn.php';


$id = $_GET['id'];
$status = $_GET['status'];
$sql = "UPDATE `tbl_orders` set `status` = '$status' where `tracking_id` = '$id'";
mysqli_query($con,$sql);
header('location: pending_orders.php');


echo $userid = $_GET['userid'];
echo $statuscheck = $_GET['statuscheck'];
$query = "UPDATE `tbl_contest_participants` set `status` = '$statuscheck' where `user_id` = '$userid'";
mysqli_query($con,$query);
header('location: participants.php');

?>