<?php
use Models\Property;
use Models\Image;
use Models\User;
use Models\Review;
include ("init.php");
include ("session.php");


if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
    
    $user = new User();
    $user->setConnection($connection);
    $user = $user->getById($user_id);
    
    $full_name = $user['first_name'] . ' ' . $user['last_name'];
}

if(isset($_SESSION['current_page'])){
    unset($_SESSION['current_page']);
}

//Get all properties
$property = new Property();
$property->setConnection($connection);
$properties = $property->getProperties();


//For map display
$map_latitude = [];
$map_longitude = [];
$map_property = [];
$full_address = [];
foreach($properties as $property_item){
    $map_latitude[] = $property_item['latitude'];
    $map_longitude[] = $property_item['longitude'];
    $map_property[] = $property_item['property_name'];
    $full_address[] = $property_item['property_number'] . ' ' . $property_item['street'] . ', ' .  $property_item['barangay'];
}

//All available barangay
$barangay_list = array('Lourdes Sur East', 'Salapungan', 'Claro M. Recto'); //can be converted or taken from csv

?>

<!DOCTYPE html>
<html lang="en">
  
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Apt Iba Pa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous"/>
    <script src="https://kit.fontawesome.com/868f1fea46.js" crossorigin="anonymous"></script>
    <link href="css/dashboard.css" rel="stylesheet" />
    <link href="css/all.css" rel="stylesheet" />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

    <!-- LeafletJS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
</head>

<body>
    <!-- Navbar -->
        <?php include('navbar.php') ?>
        <div>
            <a href="profile.php">Profile</a>
        </div>
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
            <form class="d-flex" role="search" action="accommodations.php" method="POST">
              <input
                class="form-control me-2"
                type="text"
                placeholder="Search"
                aria-label="Search"
                name="query"
                id="search_bar"
              />
              <button class="btnSearch" name="search" type="submit">Search</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Header/Banner ends-->

    <!-- Info Buttons starts-->

    <div class="container-md">
      <div class="row mt-5">
        <section class="info">
          <div class="row gy-4">

          <?php foreach($barangay_list as $barangay) {?>
              <div class="col ">
                <div class="box-container">
                  <a href="accommodations.php?barangay=<?php echo $barangay ?>" class="box">
                    <img src="images/icon-17.png" alt="" />
                    <h3>Dormitories and Apartments located in <?php echo $barangay ?></h3>
                  </a>
                </div>
              </div>
              <?php } ?>
              

            
          </div>
        </section>
      </div>
    </div>
    <!-- Info Buttons ends-->

        <!-- Map Browse -->
        <div class="container-md">
      <div class="row mt-5">
            <div id="map"></div>
        </div>
    </div>
    <!-- Map Browse end -->

    <!-- Featured section starts -->

    <!-- <div class="container-fluid featuredHtml"> -->
      <section class="listings">
        <h1 class="featureHeading p-3">Featured Dormitories and Apartments</h1>

        <!-- <div class="container-md"> -->
          <div class="box-container">
            <div class="row gx-5">

                <?php 
                shuffle($properties); 
                foreach ($properties as $property) { 
                    $property_name = $property['property_name'];
                    $barangay = $property['barangay'];
                    $lowest_rate = $property['lowest_rate'];
                    $property_type = $property['property_type'];
            
                    $property_id = $property['property_id'];
                    $images = new Image();
                    $images->setConnection($connection);
                    $images = $images->getDisplayImage($property_id);
                    
                    $reviews = new Review();
                    $reviews->setConnection($connection);
                    $reviews = $reviews->getRatings($property_id);
                    
                    $total_ratings = 0;
                    $total_reviews = count($reviews);
                    
                    foreach ($reviews as $review) {
                        $total_ratings += $review["rating"];
                    }

                    $average_rating = $total_ratings / $total_reviews;

                    if($images){
                        $image = $images['image_path'];
                    }
                    ?>

            <form action="view.php" method="POST">
            <input type="hidden" value="<?=$property_id?>" name="property_id">
              <div class="col-md">
                <div class="box">
                  <div class="thumb">
                    <p class="total-images">
                      <i class="far fa-image"></i><span>4</span>
                    </p>
                    <p class="type"><span><?= $property_type ?>></span></p>
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
                      <h3 class="name"><?= $property_name?></h3>
                      <div class="row">
                        <div class="h4 mt-3 col-sm-8">
                          <div>
                            <i class="fas fa-map-marker-alt"></i> <?= $barangay?>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-lg-4 rentName">
                      Rent starts at
                      <div class="price">&#8369;<?= $lowest_rate?></div>
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
                      <p class="btnRating"><i class="fa-solid fa-star starRating"></i> <?= $average_rating ?>
                    </div>
                    <div class="col-lg-6">
                      <a href="view.php?property_id=<?php echo $property_id ?>" class="btnView">View property</a> 

                      <!-- <button type="submit" name="view_property">View Property</button> -->
                    </div>
                  </div>

                </div>
              </div>
            </form>
              <?php } ?>
            </div>
              </div>

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
  

<!-- map style and script -->

<style>
    #map {height: 600px; width: 1350px }
</style>
<script>
var map_center = [15.145158062165162, 120.59477842687491];
        var mapOptions = {
        center: map_center,
        zoom: 18
        }
        var map = L.map('map', mapOptions);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        var latitude = <?php echo json_encode($map_latitude); ?>;
        var longitude = <?php echo json_encode($map_longitude); ?>;
        var propertyNames = <?php echo json_encode($map_property); ?>;
        var full_address = <?php echo json_encode($full_address); ?>;
        for (var i = 0; i < latitude.length; i++) {
        var marker = L.marker([latitude[i], longitude[i]]).addTo(map);
        marker.bindPopup("<b>" + propertyNames[i] + "</b><br>" + full_address[i] + "<br><a href='view.php?property_id'>View</a>").openPopup();
        }
</script>
</body>
</html>
