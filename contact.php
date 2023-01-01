<?php
include './conn.php';
if (isset($_POST['message'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $msg = $_POST['msg'];
  if (empty($name || $email || $msg)) {
    echo '<script>alert(`field are empty`)</script>';
  } else {
    $result = mysqli_query($con,"INSERT INTO `message`(`name`,`email`,`message`) Values('$name',' $email',' $msg') ");
    echo '<script>alert(`Your Message Send Successfully`)</script>';
    
  }
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title></title>
  <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/headers/">
  <link rel="stylesheet" href="./assets/fontawesome/css/all.min.css">
  <link rel="stylesheet" href="./assets/fontawesome/css/fontawesome.min.css">
  <link href="./assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.1.2/css/all.css">
  <!-- MDB -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.3.0/mdb.min.css" rel="stylesheet" />
  <!-- Custom styles for this template -->
  <link href="./style.css" rel="stylesheet">

</head>

<body>
  <style>
    /* Google Font CDN Link */
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Poppins", sans-serif;
    }

    body {
      min-height: 100vh;
      width: 100%;
      background-color: #E9E8F9;

    }

    .containerz {
      width: 85%;
      background: #fff;
      border-radius: 6px;
      padding: 20px 60px 30px 40px;
      box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
      margin: 40px auto;
    }

    .content {
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .content .left-side {
      width: 25%;
      height: 100%;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      margin-top: 15px;
      position: relative;
    }

    .content .left-side::before {
      content: '';
      position: absolute;
      height: 70%;
      width: 2px;
      right: -15px;
      top: 50%;
      transform: translateY(-50%);
      background: #afafb6;
    }

    .content .left-side .details {
      margin: 14px;
      text-align: center;
    }

    .content .left-side .details i {
      font-size: 30px;
      color: #3e2093;
      margin-bottom: 10px;
    }

    .content .left-side .details .topic {
      font-size: 18px;
      font-weight: 500;
    }

    .content .left-side .details .text-one,
    .content .left-side .details .text-two {
      font-size: 14px;
      color: #afafb6;
    }

    .content .right-side {
      width: 75%;
      margin-left: 75px;
    }

    .content .right-side .topic-text {
      font-size: 23px;
      font-weight: 600;
      color: #3e2093;
    }

    .right-side .input-box {
      height: 50px;
      width: 100%;
      margin: 12px 0;
    }

    .right-side .input-box input,
    .right-side .input-box textarea {
      height: 100%;
      width: 100%;
      border: none;
      outline: none;
      font-size: 16px;
      background: #F0F1F8;
      border-radius: 6px;
      padding: 0 15px;
      resize: none;
    }

    .right-side .message-box {
      min-height: 110px;
    }

    .right-side .input-box textarea {
      padding-top: 6px;
    }

    .right-side .button {
      display: inline-block;
      margin-top: 12px;
    }

    .right-side .button input[type="submit"] {
      color: #fff;
      font-size: 18px;
      outline: none;
      border: none;
      padding: 8px 16px;
      border-radius: 6px;
      background: #3e2093;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .button input[type="submit"]:hover {
      background: #5029bc;
    }

    @media (max-width: 950px) {
      .containerz {
        width: 90%;
        padding: 30px 40px 40px 35px;
      }

      .content .right-side {
        width: 75%;
        margin-left: 55px;
      }
    }

    @media (max-width: 820px) {
      .containerz {
        margin: 40px 0;
        height: 100%;
      }

      .content {
        flex-direction: column-reverse;
      }

      .content .left-side {
        width: 100%;
        flex-direction: row;
        margin-top: 40px;
        justify-content: center;
        flex-wrap: wrap;
      }

      .content .left-side::before {
        display: none;
      }

      .content .right-side {
        width: 100%;
        margin-left: 0;
      }
    }
  </style>
  <?php require './partials/_nav.php'; ?>

  <div class="containerz">
    <div class="content">
      <div class="left-side">
        <div class="address details">
          <i class="fas fa-map-marker-alt"></i>
          <div class="topic">Address</div>
          <div class="text-one">M.A Jinnah Road</div>
          <div class="text-two">Block B, Plot 834</div>
        </div>
        <div class="phone details">
          <i class="fas fa-phone-alt"></i>
          <div class="topic">Phone</div>
          <div class="text-one">+92 6728492011</div>
          <div class="text-two">03170777287</div>
        </div>
        <div class="email details">
          <i class="fas fa-envelope"></i>
          <div class="topic">Email</div>
          <div class="text-one">alirayyan.dev@gmail.com</div>
          <div class="text-two">ebookservices@gmail.com</div>
        </div>
      </div>
      <div class="right-side">
        <div class="topic-text">Send us a message</div>

        <form action="#" method="post">
          <div class="input-box">
            <input type="text" name="name" placeholder="Enter your name">
          </div>
          <div class="input-box">
            <input type="text" name="email" placeholder="Enter your email">
          </div>
          <div class="input-box message-box">
            <textarea name="msg" placeholder="message me ..." name="" id="" cols="30" rows="10"></textarea>
          </div>
          <div class="button">
            <input name="message" type="submit" value="Send Now">
          </div>
        </form>
      </div>
    </div>
  </div>
  <?php require 'partials/footer.php'; ?>
</body>
<script src="./assets/bootstrap/js/bootstrap.bundle.min.js"></script>
<script   src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/4.3.0/mdb.min.js"></script>

</html>