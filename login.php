<?php 
include 'conn.php';
session_start();
if(isset($_SESSION["userloggedin"]) && $_SESSION["userloggedin"] == true){
    $_SESSION["showerror"] = "Your are already logged in.";
header("location:index.php");
}
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $pass = $_POST['password'];
    $password = sha1($pass);

    $query = "SELECT * FROM user_register where username='$username' and password='$password' ";
    $result = mysqli_query($con, $query);
    $num = mysqli_num_rows($result);
    $row = mysqli_fetch_array($result);
    if ($num ==  1) {
        $_SESSION['fullname'] = $row['fullname'];
        $_SESSION['username'] =  $row['username'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['id'] = $row['user_id'];
        if ($row['roles'] == 'user') {
            $_SESSION['userloggedin'] = true;
            $_SESSION["showalert"] = "Your are logged in successfully";

            header('location: index.php');
        } elseif ($row['roles'] == 'admin') {
            $_SESSION['adminloggedin'] = true;
            $_SESSION['admin'] = $username;

            header("location:./admin/admin.php");
        } else {
            $_SESSION["showerror"] = "Invalid Credentials";
        }
    } else {
        $_SESSION["showerror"] = "Invalid Credentials";
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hello, world!</title>
    <link rel="stylesheet" href="./assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="./assets/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.1.2/css/all.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.3.0/mdb.min.css" rel="stylesheet" />

</head>
<style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap');

body {
    /* background: #000; */
    font-family: 'Roboto', sans-serif;
background:linear-gradient(to bottom , #00000052,#00000052), url(./img/login.jpg) no-repeat;
background-size: cover;

}
</style>
<body>
    <?php
    require './partials/_nav.php';
    if (isset($_SESSION["showalert"])) {
        echo '<div class="alert d-flex align-items-center justify-content-center alert-light shadow-sm py-3 rounded-2 alert-dismissible fade show position-absolute "style="left:50%;transform:translate(-50%);top:20px;" role="alert">
<div class="text-dark "><i class=" fa-solid fa-check text-success me-3"></i>' . $_SESSION["showalert"] . '.</div>
<button type="button" class="btn-close p-0 d-flex justify-content-center align-items-center h-100 px-3" style="font-size:13px;" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
    }
    if (isset($_SESSION["showerror"]) ) {
        echo '<div class="alert  d-flex align-items-center justify-content-center border  shadow-sm py-3 rounded-2 alert-dismissible fade show position-absolute "style="left:50%;transform:translate(-50%);top:20px;background-color:#ffffff;" role="alert">
  <div class="text-dark "><i class=" fa-solid fa-xmark text-danger me-3"></i>' . $_SESSION["showerror"] . '.</div>
  <button type="button" class="btn-close p-0 d-flex justify-content-center align-items-center h-100 px-3" style="font-size:13px;" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
    }
 ?>
    <section class="h-100 h-custom shadow shadow-dark">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-8 col-xl-6">
                    <div class="card rounded-3">
                        <img src="./img/login.jpg" class="w-100" style="border-top-left-radius: .3rem; border-top-right-radius: .3rem;" alt="Sample photo">
                        <div class="card-body p-4 p-md-5">
                            <h3 class="mb-4 pb-2 pb-md-0 mb-md-3 px-md-2 text-dark">LOGIN</h3>

                            <form class="px-md-2" method="post">

                                <div class="form-outline mb-4">
                                    <input type="text" id="form3Example1q" name="username" class="form-control email" />
                                    <label class="form-label" for="form3Example1q">Email or Username</label>
                                </div>
                                <!-- <div class="form-outline">
  <input type="text" id="form16" class="form-control" data-mdb-showcounter="true" maxlength="20" />
  <label class="form-label" for="form16">Example label</label>
  <div class="form-helper"></div>
</div> -->
                                <div class="form-outline mb-3 position-relative">
                                    <input type="password" name="password" name="password" data-mdb-showcounter="true" maxlength="50"  id="loginpass" class="form-control" />
                                    <label class="form-label" for="form3Example1q">Password</label>
                                    <span id="loginpasseye" onclick="login_showpass()" class="position-absolute  align-items-center" style="transform:translate(0,-50%);right:10px;top: 50%;opacity: .6;cursor: pointer;"><span id="loginpasseyetext" class="me-1  "><i class="fa-solid text-muted fa-eye-slash"></i></span></span>
                                    <div class="form-helper"></div>
                                </div>
                                <div class="form-check mb-4">
                                    <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" checked>
                                    <label class="form-check-label" for="defaultCheck1" style="font-size:.9rem;">
                                        remember me.
                                    </label>
                                </div>
                                <button type="submit" name="login" class="btn btn-primary btn-lg mb-1">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>

<script src="./assets/bootstrap/js/bootstrap.min.js"></script>
<script>
    function login_showpass() {
        if (loginpass.type === 'password') {
            loginpass.type = 'text';
            loginpasseye.style.transition = '.1s';
            loginpasseye.style.opacity = '1';
            loginpasseyetext.innerHTML = '<i class="fa-solid fa-dark fa-eye"></i>';

        } else {

            loginpass.type = 'password';
            loginpasseye.style.transition = '.1s';
            loginpasseye.style.opacity = '.6';
            loginpasseyetext.innerHTML = '<i class="fa-solid fa-dark fa-eye-slash"></i>';

        }
    };



    // $(document).ready(function() {

    // });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.3.0/mdb.min.js"></script>
<script src="./assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</html>
