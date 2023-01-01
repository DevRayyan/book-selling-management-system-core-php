
       <!-- header -->
        <nav class="navbar navbar-expand-lg navbar-light p-0 ">
            <div class="container-fluid ">
                <a class="navbar-brand fw-bolder text-dark" style="font-size: 2rem;" href="#"><?php echo $_SESSION['admin'] ?> </a>
                <button class="navbar-toggler " type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse sm-text-center " id="navbarSupportedContent">
                    <div class='d-flex justify-content-end align-items-center col-12 col-sm-10 col-md-7 m-auto'>
                        <div class="col-12  position-relative  my-sm-2 me-2">
                            <input class="w-100 form-control border" placeholder="Search here" type="text">
                            <button class="btn   btn-dark text-light position-absolute " style="right:0%;top: 0%;height:100%; border-bottom-left-radius: 0px; border-top-left-radius: 0px;"><i class="fa-regular fa-magnifying-glass"></i></i></button>
                        </div>
                    </div>
                    <ul class="navbar-nav me-3 ">
                        <li class="nav-item  mx-md-auto  col-12 col-sm-10 col-md-7 col-lg-12   m-auto">
                            <a href="./add_new_admin.php" class="btn  btn-dark text-light col-12 my-2 my-sm-0 " style="font-size:.9rem ;" href="welcome.php"><i class="fa-solid fa-plus"></i> Create New Admin </a>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>
        <!-- header closed  -->