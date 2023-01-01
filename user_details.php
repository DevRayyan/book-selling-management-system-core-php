<?php
session_start();
include 'conn.php' ;
// sleep(2);
// if (isset($_POST['order_details'])) {
    
    $id = $_POST['id'];
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phoneno = $_POST['phoneno'];
    $country = $_POST['country'];
    $city = $_POST['city'];
    $address = $_POST['address'];
    $postal_code = $_POST['postal_code'];
    $payment_mode = $_POST['payment_mode'];
    
    if(empty($id) || empty($fullname)|| empty($username)|| empty($email)|| empty($phoneno)|| empty($country) || empty($city)|| empty($address)|| empty($postal_code)){
        $_SESSION['showerror'] = "Fields are empty";
    }else{
    $query = "SELECT * FROM  `order_details` where `user_id` =  '$id'";
    $running = mysqli_query($con, $query);
    $fetch = mysqli_fetch_array($running);
    $check = mysqli_num_rows($running);
    if ($check > 0) {
        $update =  "UPDATE `order_details` SET `fullname`='$fullname' , `username`='$username', `email`='$email', `phone_no`='$phoneno', `country`='$country', `city`='$city', `address`='$address', `postal_code`='$postal_code', `method`='$payment_mode'";
        $update_running = mysqli_query($con, $update);
    } else {

        $insert =  "INSERT INTO `order_details`(`fullname`, `username`, `email`, `phone_no`, `country`, `city`, `address`, `postal_code`, `method`,`user_id`) VALUES ('$fullname','$username','$email','$phoneno','$country','$city','$address','$postal_code','$payment_mode','$id')";
        $insert_running = mysqli_query($con, $insert);
    }
   $_SESSION['showalert'] = "Your data added successfully";

echo '
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
<div class="position-absolute top-0 end-0  text-muted pe-2 cursor-pointer pt-1"><i class="fa-solid fa-xmark"></i></div>';
    }
?>