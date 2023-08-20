<?php
use Models\Property;
include ("init.php");
include ("session.php");

$property = new Property('','','', '', '', '','','','','', '', '', '','','','','','');
$property->setConnection($connection);
$properties = $property->getProperties();

$user_id = $_SESSION['user_id'] ?? NULL;


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Accommodations | Apt Iba Pa</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM"
      crossorigin="anonymous"
    />
    <script
    src="https://kit.fontawesome.com/868f1fea46.js"
    crossorigin="anonymous"
  ></script>
    <link href="css/accommodations.css" rel="stylesheet" />
    <link href="css/all.css" rel="stylesheet" />
  </head>
  <body>
    <!-- Navbar -->

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid">
        <a class="navbar-brand" href="dashboard.html">
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
              <a class="nav-link" href="accommodations.php">Accommodations</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="about.php">About Us</a>
            </li>
          </ul>
          <form class="d-flex signOutbtn" role="search">
            <?php if ($user_id){ ?>
            <a class="btn btn-outline-secondary me-2" href="logout.php" type="button">
              Logout
            </a>
            <?php } else { ?>
            <a class="btn btn-outline-secondary me-2" href="login.php" type="button">
                Login
            </a>
            <?php } ?>
            <a class="btn btn-outline-secondary" onclick="window.location.href='apply.php';" type="button">
              Apply My Property
            </a>
          </form>
        </div>
      </div>
    </nav>

    <!-- Navbar ends -->

    <!-- Featured section starts -->

    <div class="container-fluid accomJumbuildings">
      <section class="accommodations">

          <div class="row">
            <div class="col-md">
                  <div class="h1 float-end p-4">
                      <a href="accomodations2.html" class="btnFilter"><i class="fa-solid fa-arrow-down-short-wide fa-xl" style="color: #ffffff;"></i></a>
                  </div>
            </div>
          </div>

        <div class="container-md">
          <div class="box-container">
            <div class="row gx-5 mb-3">
                <?php foreach($properties as $property){
                    $full_address = $property['street'] . " " . $property['street'] . ", Barangay " . $property['barangay'] . ", " . $property['city'];
                  ?>
              <div class="col-md-6">
                <div class="box">
                    <div class="row">
                        <div class="col-10">
                            <h3 class="name"><?=$property['property_name']?></h3>
                            <div class="row">
                                <div class="h4 mt-3 col-sm-8">
                                    <div>
                                    <i class="fas fa-map-marker-alt"></i> <?=$property['property_barangay']?>
                                    </div>
                                </div>
                            </div>
                        </div>

                            <div class="col-2 ps-4 justify-content-end">
                              <Button onclick="Toggle1()" id="btnBm" class="btn btnBookmark"><i class="fa-solid fa-bookmark fa-3x"></i></Button>
                            </div>

                    </div>

                  <div class="thumb">
                    <p class="total-images">
                      <i class="far fa-image"></i><span>4</span>
                    </p>
                    <p class="type"><span><?=$property['property_type']?></span></p>

                    <img src="images/house-img-2.webp" alt="" />
                  </div>
                  <div class="row">
                    
                    <div class="col-sm-6 rentName">
                      Rent starts at
                      <div class="price">&#8369;3,000</div>
                    </div>
                    <div class="col-sm-6">
                        <p class="btnRating"><i class="fa-solid fa-star-half-stroke starRating"></i> 4.8 (73 reviews)</p>
                      </div>
                  </div>
                  
                  <div class="row">
                    <div class="col-sm">
                      <!-- <a href="view.php" class="btnView">View property</a>fix form -->
                    </div>
                  </div>
                  <?php }?>
                </div>
            </div>
        </div>



              <div class="row mt-5 mb-5 justify-content-center">
                <a href="accomodations.html" class="btnViewAll">View All</a>
              </div>


              
          
          </div>
        </div>
      </section>
    </div>

    <!-- Featured ends -->


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

  <script src="js/accommodations.js"></script>

</html>
