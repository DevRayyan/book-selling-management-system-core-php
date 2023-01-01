<?php
  include 'conn.php';
 session_start();

    if (isset($_POST["register"])) {
        $fullname = $_POST['fullname'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $pass = $_POST['password'];
        $password = sha1($pass);
        $cpass = $_POST['cpassword'];
        $cpassword = sha1($cpass);

        $existSql = "SELECT * FROM `user_register` WHERE username = '$username'";
        $existSql2 = "SELECT * FROM `user_register` WHERE email = '$email'";

        $result = mysqli_query($con, $existSql);
        $result2 = mysqli_query($con, $existSql2);

        $numExistRows = mysqli_num_rows($result);
        $numExistRows2 = mysqli_num_rows($result2);


        if (empty($fullname) || empty($username) || empty($email) || empty($pass)) {
            
            $_SESSION["showerror"] = "Feilds are empty please filled it";
        } elseif ($numExistRows > 0) {
            // $exists = true;

            
            $_SESSION["showerror"] = "Username Already Exists";

            if ($numExistRows2 > 0) {
                // $exists = true;

                
                $_SESSION["showerror"] = "email Already Exists";
            }
        } else {

            // $exists = false; 
            if (($password == $cpassword)) {

                $sql = "INSERT INTO `user_register` ( `fullname`, `username`, `email`,`password`, `date`) VALUES ('$fullname', '$username','$email', '$password', current_timestamp())";
                $result = mysqli_query($con, $sql);

                if ($result) {
                $_SESSION["showalert"] = "Congratulations, Your account craeted successfully ";
                header("location:login.php");

                }
            } else {

                
                $_SESSION["showerror"] = "Passwords do not match";
            }
        }
    }
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="./assets/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.1.2/css/all.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.3.0/mdb.min.css" rel="stylesheet" />
    <title>sign up</title>
</head>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap');

    body {
        font-family: 'Roboto', sans-serif;


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
    if (isset($_SESSION["showerror"])) {
        echo '<div class="alert  d-flex align-items-center justify-content-center border  shadow-sm py-3 rounded-2 alert-dismissible fade show position-absolute "style="left:50%;transform:translate(-50%);top:20px;background-color:#ffffff;" role="alert">
  <div class="text-dark "><i class=" fa-solid fa-xmark text-danger me-3"></i>' . $_SESSION["showerror"] . '.</div>
  <button type="button" class="btn-close p-0 d-flex justify-content-center align-items-center h-100 px-3" style="font-size:13px;" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
    }
    ?>

    <section class="h-100 h-custom shadow shadow-0 mt-3">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class=" col-sm-8 col-md-6 h-100">
                    <img src="./img/register.png" class="w-100 shadow" style="object-fit:cover;border-top-left-radius: .3rem; border-top-right-radius: .3rem;height:100%  ;" alt="Sample photo">

                </div>
                <div class=" col-sm-8 col-md-6">
                    <div class="card shadow-0  rounded-3 p-2 p-sm-4">
                        <h3 class="mt-4 pb-2 pb-md-0 mb-md-3 px-md-2 fw-bold text-dark">REGISTER NOW</h3>


                        <form method="post" class="mt-2">
                            <div class="form-outline mb-4">
                                <input type="text" id="form3Example1" name="fullname" class="form-control" />
                                <label class="form-label" for="form3Example1">Full Name</label>
                            </div>
                            <div class="form-outline mb-4">
                                <input type="text" id="form3Example1" name="username" class="form-control" />
                                <label class="form-label" for="form3Example1">Username</label>
                            </div>
                            <div class="form-outline mb-4">
                                <input type="email" id="form3Example1" name="email" class="form-control" />
                                <label class="form-label" for="form3Example1">Email</label>
                            </div>
    
                            <div class="form-outline mb-4 position-relative">
                                <input type="password" name="password" name="password" data-mdb-showcounter="true" maxlength="50" id="loginpass" class="form-control" />
                                <label class="form-label" for="form3Example1q">Password</label>
                                <span id="loginpasseye" onclick="showpass()" class="position-absolute  align-items-center" style="transform:translate(0,-50%);right:10px;top: 50%;opacity: .6;cursor: pointer;"><span id="loginpasseyetext" class="me-1  "><i class="fa-solid text-muted fa-eye-slash"></i></span></span>
                                <div class="form-helper"></div>
                            </div>
                            <div class="form-outline mb-4 position-relative">
                                <input type="password" name="cpassword" data-mdb-showcounter="true" maxlength="50" id="cpass" class="form-control" />
                                <label class="form-label" for="form3Example1q">Password</label>
                                <span id="cpasseye" onclick="showcpass()" class="position-absolute  align-items-center" style="transform:translate(0,-50%);right:10px;top: 50%;opacity: .6;cursor: pointer;"><span id="cpasseyetext" class="me-1  "><i class="fa-solid text-muted fa-eye-slash"></i></span></span>
                                <div class="form-helper"></div>
                            </div>

                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" disabled checked>
                                <label class="form-check-label" for="defaultCheck1" style="font-size:.9rem;">
                                    I agree all <a href="" class="" style="color: #1C1A7D;font-weight: 500;">Terms & Conditions</a>
                                </label>
                            </div>

                            <div class="d-block  my-3">
                                <button type="submit" name='register' style="background:#A83279;" class="btn btn-lg mb-1 text-light">Register</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
</body>

<script src="./assets/bootstrap/js/bootstrap.min.js"></script>
<script>
    function showpass() {
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

    function showcpass() {
        if (cpass.type === 'password') {
            cpass.type = 'text';
            cpasseye.style.transition = '.1s';
            cpasseye.style.opacity = '1';
            cpasseyetext.innerHTML = '<i class="fa-solid fa-dark fa-eye"></i>';

        } else {

            cpass.type = 'password';
            cpasseye.style.transition = '.1s';
            cpasseye.style.opacity = '.6';
            cpasseyetext.innerHTML = '<i class="fa-solid fa-dark fa-eye-slash"></i>';

        }
    };
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.3.0/mdb.min.js"></script>

<script src="./assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="js/mdb.min.js"></script>

</html>
<?php unset($_SESSION['showerror']);

?>