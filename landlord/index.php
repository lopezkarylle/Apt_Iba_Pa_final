<?php 
use Models\User;

include ("../init.php");

session_start();

if(!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 1){
    echo "<script>window.location.href='../login.php';</script>";
    exit();
}

$user_id = $_SESSION['user_id'];

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Landlord Dashboard | Apt Iba Pa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous"/>
    <script src="https://kit.fontawesome.com/868f1fea46.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href="css/dashboard.css" rel="stylesheet" />
    <link href="css/all.css" rel="stylesheet" />
  </head>
  <body>
    <!-- Navbar -->

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid">
        <a class="navbar-brand" href="index.php">
          <img src="images/logo.png" alt="Bootstrap" width="120" height="50" />
        </a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNav"
          aria-controls="navbarNav"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../landlord/property/index.php">My Property</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../landlord/appointment/index.php">Appointments</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../landlord/reservation/index.php">Reservations</a>
            </li>
          </ul>
          <form class="d-flex" role="search" action="../logout.php" action="POST">
            <button class="btn btn-outline-secondary me-2" type="submit">
            Sign Out &nbsp;<i class="fa-solid fa-right-from-bracket"></i> 
            </button>
          </form>
        </div>
      </div>
    </nav>

    <!-- Navbar ends -->
    <!-- Header/Banner starts -->

    <div class="container-fluid jumbotron p-3">
      <div class="row mt-5 mb-3 ms-5 text-wrap">
        <div class="col-sm-9" id="headerTitle">
          <h2>Your Second Home Search Made Easy</h2>
        </div>
        <div class="row">
          <div class="col-sm text-wrap" id="headerDetails">
            Don’t spend hours online searching for apartments/dorms, with Apt.
            Iba Pa you’ll find your new home in no time
          </div>
        </div>
      </div>
    </div>

    <!-- Header/Banner ends-->

    <!-- Info Buttons starts-->

    <div class="container-fluid pt-5 pb-5 position-relative">
      <div class="custom-shape-divider-top-1691000602 z-1">
        <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M985.66,92.83C906.67,72,823.78,31,743.84,14.19c-82.26-17.34-168.06-16.33-250.45.39-57.84,11.73-114,31.07-172,41.86A600.21,600.21,0,0,1,0,27.35V120H1200V95.8C1132.19,118.92,1055.71,111.31,985.66,92.83Z" class="shape-fill"></path>
        </svg>
      </div>
      <div class="row">

        <section class="info z-2">
          <div class="box-container">
            <a href="../landlord/property/index.php" class="box">
              <img src="images/box4.png" alt="My Property" style="height: 120px;"/>
              <h3>MY PROPERTY</h3>
            </a>

            <a href="../landlord/appointment/index.php" class="box">
              <img src="images/box2.png" alt="Appointments" style="height: 120px;"/>
              <h3>APPOINTMENTS</h3>
            </a>

            <a href="../landlord/reservation/index.php" class="box">
              <img src="images/box3.png" alt="Reservations" style="height: 120px;"/>
              <h3>RESERVATIONS</h3>
            </a>

          </div>
        </section>
      </div>
    </div>
    <!-- Info Buttons ends-->

    <!-- offers starts  -->
        <div class="container-fluid position-relative jumbuildings">
          <hr>
          <section class="offers">
            <h1 class="offersHeading p-3">Latest Offers</h1>

            <div class="container-md mb-5">
              <div class="box-container">
                <div class="row">

                  <div class="col-lg-4 p-3">
                    <div class="box">
                      <img src="images/icon-6.png" alt="">
                      <h3>Online Catalog for Students</h3>
                      <p>Choose from different spaces, reserve, and schedule
                      your second home with one click</p>
                  </div>
                  </div>

                  <div class="col-lg-4 p-3">
                    <div class="box">
                      <img src="images/icon-7.png" alt="">
                      <h3>Customer Support</h3>
                      <p>Ask for help from the team, anytime. 
                      Just send us a message and get back to you 
                      immediately.</p>
                    </div>
                  </div>

                  <div class="col-lg-4 p-3">
                    <div class="box">
                      <img src="images/icon-8.png" alt="">
                      <h3>A space to call Home</h3>
                      <p>A place you can call home, somewhere you can
                      work and relax at the same time.</p>
                    </div>
                  </div>

                </div>

                <div class="row">

                  <div class="col-lg-4 p-3">
                    <div class="box">
                      <img src="images/icon-9.png" alt="">
                      <h3>Built-In Comfort</h3>
                      <p>Functional spaces with amenities that cater to 
                      your basic needs and comfortability.</p>
                    </div>
                  </div>

                  <div class="col-lg-4 p-3">
                    <div class="box">
                      <img src="images/icon-10.png" alt="">
                      <h3>Well-secured Spaces</h3>
                      <p>Our homes come with CCTV, caretakers, and security
                      personnel you can rely on for your safety.</p>
                    </div>
                  </div>

                  <div class="col-lg-4 p-3">
                    <div class="box">
                      <img src="images/icon-11.png" alt="">
                      <h3>Regular Maintenance</h3>
                      <p>Regular maintenance to your spaces that cater to 
                      your basic needs and comfortability.</p>
                    </div>
                  </div>

                </div>

              </div>
            </div>
            
          </section>
        </div>

    <!-- offers section ends -->

    <!-- Footer -->

    
      <footer class="site-footer">
        <div class="container-fluid">
          <div class="container">
          <div class="row">
              <div class="col-sm-12 col-md-8">
              <h2>APT IBA PA</h2>
                <div class="row">
                  <div class="col-sm-12 col-md-8">
                    <p class="text-justify">
                      Our platform serves as a comprehensive guide, providing a vast database of dormitories and apartments in the area surrounding AUF. Through our interactive map interface, users can easily navigate and explore different locations, allowing them to make informed decisions based on their preferences and requirements.
                    </p>
                  </div>
                </div>
              </div>
  
              <div class="col-xs-6 col-md-2 me-auto pt-4">
              <h6>Pages</h6>
              <ul class="footer-links">
                  <li><a href="http://scanfcode.com/category/c-language/">Accomodations</a><li>
                  <li>
                  <a href="http://scanfcode.com/category/front-end-development/">About Us</a>
                  </li>
                  <li>
                  <a href="http://scanfcode.com/category/back-end-development/">Apply My Property</a>
              </ul>
              </div>
  
              <div class="col-xs-6 col-md-2 pt-4">
              <h6>Features</h6>
              <ul class="footer-links">
                  <li><a href="http://scanfcode.com/about/">Favorites</a></li>
                  <li><a href="http://scanfcode.com/contact/">Reserve a Room</a></li>
                  <li>
                  <a href="http://scanfcode.com/contribute-at-scanfcode/">Schedule a Visit</a>
              </ul>
              </div>
          </div>
          <hr />
          </div>
          <div class="container">
          <div class="row">
              <div class="col-md-8 col-sm-6 col-xs-12">
              <p class="copyright-text">
                  Copyright &copy; 2023 All Rights Reserved by
                  <a href="#">APT IBA PA</a>.
              </p>
              </div>
  
              <div class="col-md-4 col-sm-6 col-xs-12">
              <ul class="social-icons">
                  <li>
                  <a class="facebook" href="#"><i class="fa fa-facebook"></i></a>
                  </li>
                  <li>
                  <a class="twitter" href="#"><i class="fa fa-twitter"></i></a>
                  </li>
                  <li>
                  <a class="dribbble" href="#"><i class="fa fa-dribbble"></i></a>
                  </li>
                  <li>
                  <a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a>
                  </li>
              </ul>
              </div>
          </div>
          </div>
        </div>
      </footer>
      
  
      <!-- Footer ends -->
  



    


  </body>

  <!-- javascript -->
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
    crossorigin="anonymous"
  ></script>

</html>
