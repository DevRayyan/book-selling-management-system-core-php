<div class="sidebar close">
  <div class="logo-details">

    <span class="logo_name"><?php echo $_SESSION['admin'] ?></span>
    <i class="fa-light fa-bars-filter fa-bars"></i>
  </div>
  <ul class="nav-links">
    <li>
      <a href="#">
        <i class="fa-light fa-user"></i>
        <span class="link_name">Dashboard</span>
      </a>
      <ul class="sub-menu blank">
        <li><a class="link_name" href="./admin.php">Dashboard</a></li>
      </ul>
    </li>
    <li>
      <a href="#">
        <i class="fa-light fa-grid-2"></i>
        <span class="link_name">Categories</span>
      </a>
      <ul class="sub-menu blank">
        <li><a class="link_name" href="./catagory.php">Categories</a></li>
      </ul>
    </li>
    <li>
      <div class="iocn-link">
        <a href="#">
          <i class="fa-light fa-list"></i>
          <span class="link_name">Products</span>
        </a>
        <i class='fas fa-chevron-down arrow'></i>
      </div>
      <ul class="sub-menu">
        <li><a class="link_name" href="#">Products</a></li>
        <li><a href="./manage_product.php">Manage Product</a></li>
        <li><a href="./create_product.php">Create Product</a></li>


      </ul>
    </li>
    <li>
      <div class="iocn-link">
        <a href="#">
          <i class="fa-light fa-cart-circle-check"></i>
          <span class="link_name">Orders</span>
        </a>
        <i class='fas fa-chevron-down arrow'></i>
      </div>
      <ul class="sub-menu">
        <li><a class="link_name" href="./pending_orders.php">Orders</a></li>
        <li><a href="./pending_orders.php">pending Orders</a></li>
        <li><a href="./completed_orders.php">completed Orders</a></li>


      </ul>
    </li>
    <li>
      <div class="iocn-link">
        <a href="#">
          <i class="fa-light fa-users"></i>
          '<span class="link_name">Users</span>
        </a>
        <i class='fas fa-chevron-down arrow'></i>
      </div>
      <ul class="sub-menu">
        <li><a class="link_name" href="#">Users</a></li>
        <li><a href="./user.php">Total Users</a></li>
        <li><a href="./payment_detail.php">Payment Detail</a></li>

      </ul>
    </li>






    <li>

      <div class="iocn-link">
        <a href="competitions.php">
          <i class="fa-light fa-award"></i>
          <span class="link_name">Competitions</span>
        </a>
        <i class='fas fa-chevron-down arrow'></i>
      </div>
      <ul class="sub-menu">
        <li><a class="link_name" href="competitions.php">Competitions</a></li>
        <li><a href="competitions.php">manage competitions</a></li>
        <li><a href="participants.php">participants</a></li>
      </ul>
    </li>




    <li>
      <a href="./plans.php">
        <i class="fa-light fa-clipboard-list-check"></i>
        <span class="link_name">Manage Plans</span>
      </a>
      <ul class="sub-menu blank">
        <li><a class="link_name" href="./plans.php"> Plans</a></li>
      </ul>
    </li>
    <li>

      <div class="iocn-link">
        <a href="./custom_slider.php">
          <i class="fa-light fa-sliders"></i>
          <span class="link_name">customization</span>
        </a>
        <i class='fas fa-chevron-down arrow'></i>
      </div>
      <ul class="sub-menu">
        <li><a class="link_name" href="./custom_slider.php">customization</a></li>
        <li><a href="custom_slider.php">slider</a></li>
      </ul>
    </li>
    <li>
      <div class="iocn-link">
        <a href="#">
          <i class="fa-light fa-gear"></i>
          <span class="link_name">Settings</span>
        </a>
        <i class='fas fa-chevron-down arrow'></i>
      </div>
      <ul class="sub-menu">
        <li><a class="link_name" href="#">Settings</a></li>
        
        <li><a href="./messages.php">Messages</a></li>
        <li><a href="./add_new_admin.php">Manage Admins</a></li>
        <li><a href="../logout.php">logout</a></li>
      </ul>
    </li>
    <li>
      <div class="profile-details">
        <i class='fas fa-log-out'></i>
      </div>
    </li>
  </ul>
</div>

<script>
  var arrow = document.querySelectorAll(".arrow");
  for (var i = 0; i < arrow.length; i++) {
    arrow[i].addEventListener("click", (e) => {
      let arrowParent = e.target.parentElement.parentElement;
      arrowParent.classList.toggle("showMenu");
    });
  }

  var sidebar = document.querySelector(".sidebar");
  let sidebarBtn = document.querySelector(".fa-bars");

  sidebarBtn.addEventListener("click", () => {
    sidebar.classList.toggle("close");
  });
</script>
<!-- side bar closed -->