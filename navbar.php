<?php
session_start();
?>
<html>
  <head>
  <script src="https://kit.fontawesome.com/33593f5208.js" crossorigin="anonymous"></script>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="position: fixed; z-index: 5; width:100%">
        <div class="container-fluid">
          <a class="navbar-brand" href="#" style="font-size: 2rem; padding-right: 19rem;">Fustal Booking
            <em>System</em>
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav " >
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="index.php">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/Futsals.php">Futsals</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Contact</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#" style="width:8rem;">About US</a>
              </li>
              </ul>
              <!-- <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"> Menu </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </li>
            </ul> -->
            <?php if(isset($_SESSION['id']) != null){?>
              <ul class="navbar-nav" style="padding-left:31rem;">             
                <li class="nav-item dropdown" >
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa-solid fa-user"></i>
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <li><a class="dropdown-item" href="#">My Profile</a></li>
                  <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                 
                </ul>
              </li>
                  
                   <?php }
                  else
                  {?>
                   <ul class="navbar-nav" style="padding-left:29rem;">   
                   <li class="nav-item">
                <a class="nav-link" href="Login.php">Login</a>               
                  </li>
                  <li class="nav-item">
                <a class="nav-link" href="signup.php">Signup</a>               
                  </li>
                  
         
                  <?php } ?>
              
              </ul>
                  
          </div>
        </div>
      </nav>
      <!-- <nav class="navbar navbar-expand-lg navbar-light bg-light" style="height: 41px;  ">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="#">Navbar</a>

                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNavDropdown">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">All Products</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Desks</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Chairs</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Tables</a>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Cabinate</a>
                                </li>

                                
                                <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Dropdown link
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </li>
                            </ul>
                        </div>
                    </div>
                </nav> -->
</body>
</html>
