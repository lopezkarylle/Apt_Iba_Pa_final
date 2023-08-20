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
    <title>Apt Iba Pa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous"/>
    <script src="https://kit.fontawesome.com/868f1fea46.js"crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    <link href="css/dashboard.css" rel="stylesheet" />
    <link href="css/all.css" rel="stylesheet" />
  </head>
  <body>
    <!-- Navbar -->

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">
          <img src="images/logo.png" alt="image" width="120" height="50" />
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
    <!-- Header/Banner starts -->

    <div class="container-fluid jumbotron p-3">
      <div class="row mt-3 mt-sm-5 mb-3 ms-5 text-wrap">
        <div class="col-sm-9" id="headerTitle">
          <h2>Your Second Home Search Made Easy</h2>
        </div>
        <div class="row">
          <div class="col-sm text-wrap" id="headerDetails">
            Don’t spend hours online searching for apartments/dorms, with Apt.
            Iba Pa you’ll find your new home in no time
          </div>
        </div>
        <div class="row mt-5 mb-5">
          <div class="col-lg-5 text-wrap" id="headerSearch">
            <form class="d-flex" role="search">
              <input
                class="form-control me-2"
                type="search"
                placeholder="Search"
                aria-label="Search"
              />
              <button class="btnSearch" type="submit">Search</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Header/Banner ends-->

    <!-- Info Buttons starts-->

    <div class="container-fluid">
      <div class="row mt-5">
        <section class="info">
          <div class="box-container">
            <a href="your-link-1" class="box">
              <img src="images/icon-17.png" alt="" />
              <h3>Dormitories and Apartments located in Claro M. Recto</h3>
            </a>

            <a href="your-link-1" class="box">
              <img src="images/icon-17.png" alt="" />
              <h3>Dormitories and Apartments located in Salapungan</h3>
            </a>

            <a href="your-link-1" class="box">
              <img src="images/icon-17.png" alt="" />
              <h3>Dormitories and Apartments located in Lourdes Sur East</h3>
            </a>

            <a href="your-link-1" class="box">
              <img src="images/icon-18.png" alt="" />
              <h3>Dormitories and Apartments located around AUF</h3>
            </a>

          </div>
        </section>
      </div>
    </div>
    <!-- Info Buttons ends-->

    <!-- Featured section starts -->

    <!-- <div class="container-fluid featuredHtml"> -->
      <section class="listings">
        <h1 class="featureHeading p-3">Featured Dormitories and Apartments</h1>

        <!-- <div class="container-md"> -->
          <div class="box-container">
            <div class="row gx-5">
            <?php foreach($properties as $property){
                $full_address = $property['street'] . " " . $property['street'] . ", Barangay " . $property['barangay'] . ", " . $property['city'];
                ?>
              <div class="col-md">
                <div class="box">
                  <div class="thumb">
                    <p class="total-images">
                      <i class="far fa-image"></i><span>4</span>
                    </p>
                    <p class="type"><span><?= $property['property_type']?></span></p>
                    <form action="" method="post" class="save">
                      <button
                        type="submit"
                        name="save"
                        class="fa-solid fa-bookmark fa-3x"
                      ></button>
                    </form>
                    <img src="images/house-img-2.webp" alt="" />
                  </div>
                  <div class="row">
                    <div class="col-sm-8">
                      <h3 class="name"><?= $property['property_name']?></h3>
                      <div class="row">
                        <div class="h4 mt-3 col-sm-8">
                          <div>
                            <i class="fas fa-map-marker-alt"></i> <?=$property['property_barangay']?>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-4 rentName">
                      Rent starts at
                      <div class="price">&#8369;5,000</div>
                    </div>
                  </div>
          
                  <div class="row flex">
                    <div class="col">
                      <p><i class="fas fa-bed"></i><span>4</span></p>
                    </div>
                    <div class="col">
                      <p><i class="fas fa-bath"></i><span>2</span></p>
                    </div>
                    <div class="col">
                      <p><i class="fas fa-maximize"></i><span>750sqft</span></p>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-6">
                      <p class="btnRating"><i class="fa-solid fa-star starRating"></i> 5.0 (150 reviews)
                    </div>
                    <div class="col-lg-6">
                      <!-- <a href="view.php" class="btnView">View property</a>fix -->
                    </div>
                  </div>

                </div>
              </div>
            </div>
        </div>
        <?php } ?>
        <div style="margin-top: 4rem; text-align: center">
        <a href="accommodations.php" class="inline-btn">View All</a>
        </div>

        <!-- </div> -->
      </section>
    <!-- </div> -->

    <!-- Featured ends -->

    <!-- offers starts  -->
        <div class="container-fluid jumbuildings">
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
