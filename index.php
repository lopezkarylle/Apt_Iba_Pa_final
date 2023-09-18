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
    $_SESSION['full_name'] = $full_name;
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
    <!-- LeafletJS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <link href="css/all.css" rel="stylesheet" />
    <link href="css/dashboard.css" rel="stylesheet" />
  </head>
  <body>
    <!-- Navbar -->
<?php include('navbar.php'); ?>
    <!-- Navbar ends -->


<!-- Hero -->
<section class="hero" id="home">
    <div class="container">

    <div class="row my-5 gap-5 gap-md-0">
      <div class="col-12 col-md-6 py-auto my-auto order-5 order-md-0" >

        <h1 class="hero-title text-center text-md-start fw-bold display-1">Your Second Home Search <span class="text" style="color:hsl(200, 69%, 14%)">Made Easy</span></h1>

        <div class="row">
          <p class="hero-text fs-5">
            Don’t spend hours online searching for an accommodation. With Apt.
            Iba Pa, you’ll find your new home in no time
          </p>
          <form action="accommodations.php" method="POST">
          <div class="row mt-3">
            <div class="input-group mb-3">
            
              <input type="text" class="form-control" placeholder="Search for your home" aria-label="search-loc" aria-describedby="button-addon2" name="query" id="search_bar">
              <button class="btn" type="submit" name="search" id="button-addon2"><i class="fa-regular fa-magnifying-glass-location fa-2x"></i></button>

            </div>
          </div>
        </div>
        </form>
      </div>
      <div class="col-12 col-md-6 order-1 order-md-0" >
        <img src="resources/images/hero-banner.png" alt="Modern house model" class="w-100">
      </div>
    </div>

    </div>
</section>

<!-- Hero -->



    <!-- Info Buttons starts-->

    <div class="container-md">
      <div class="row mt-5 mb-5">
        <section class="info">
          <div class="row gy-4">

            <?php foreach($barangay_list as $barangay) {?>
                <div class="col ">
                    <div class="box-container">
                        <form action="accommodations.php" method="POST">
                            <input type="hidden" name="barangay" value="<?= $barangay ?>">
                      <button type="submit" class="box">
                        <img src="resources/images/icon-20.png" alt="" />
                        <h3>Dormitories and Apartments located in <?= $barangay ?></h3>
                    </button>
                    </form>
                    </div>
                  </div>
                <?php } ?>

              <div class="col ">
                <div class="box-container">
                        <form action="accommodations.php" method="POST">
                      <button type="submit" class="box">
                        <img src="resources/images/icon-21.png" alt="" />
                        <h3>Dormitories and Apartments located around AUF></h3>
                    </button>
                    </form>
                    </div>
              </div>

            
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
        
        <h1 class="featureHeading p-3">Featured Listings</h1>

        <!-- <div class="container-md"> -->
          <div class="box-container">
            <div class="row gx-5">
                <?php foreach($properties as $property){ 
                    $property_name = $property['property_name'];
                    $barangay = $property['barangay'];
                    $lowest_rate = $property['lowest_rate'];
                    $property_type = $property['property_type'];
            
                    $property_id = $property['property_id'];
                    $images = new Image();
                    $images->setConnection($connection);
                    $images = $images->getDisplayImage($property_id);

                    if($images){
                        $image = $images['image_path'];
                    }

                    $reviews = new Review();
                    $reviews->setConnection($connection);
                    $reviews = $reviews->getRatings($property_id);
                    
                    if(count($reviews)>0){
                        $total_ratings = 0;
                        $total_reviews = count($reviews);
                        
                        foreach ($reviews as $review) {
                            $total_ratings += $review["rating"];
                        }

                        $average_rating = $total_ratings / $total_reviews;

                        if($total_reviews>1){
                            $show_reviews = $average_rating . ' ( ' . $total_reviews . ' Reviews )';
                        } else{
                            $show_reviews = $average_rating . ' ( ' . $total_reviews . ' Review )';
                        }
                    } else{
                        $show_reviews = "No reviews yet";
                    }
                    
                    ?>
              <div class="col-12 col-md-6 col-xl-4 ">
                <div class="box">
                  <div class="thumb">
                    <p class="type"><span><?= $property_type ?></span></p>
                    <form action="" method="post" class="save">
                      <button
                        type="submit"
                        name="save"
                        class="fa-solid fa-bookmark fa-3x"
                      ></button>
                    </form>
                    <img class="w-100" src="resources/images/properties/<?=$image?>" alt=""/>
                  </div>
                  <div class="row justify-content-between">
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
                    <div class="col-5 justify-content-start col-lg-4 rentName">
                      <div class="float-start float-lg-end">Rent starts at</div>
                        <br>
                      <div class="float-start float-lg-end price">&#8369;<?= $lowest_rate?></div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-lg-6">
                      <p class="btnRating"><i class="fa-solid fa-star starRating"></i> <?= $show_reviews ?> </p>
                    </div>
                    <div class="col-lg-6">
                    <a href="view.php?property_id=<?= $property_id ?>" class="btnView">View property</a> 
                    </div>
                    
                  </div>

                </div>
              </div>
                <?php } ?>

            </div>
              </div>

          <div class="row mt-5 mb-5 d-flex justify-content-center">
            <div class="col-12 col-md-4 d-flex justify-content-center">
              
            </div>
          </div>

        <!-- </div> -->
      </section>
    <!-- </div> -->

    <!-- Featured ends -->

    <!-- offers starts  -->
        <div class="container-fluid jumbuildings">
          <section class="offers">
            <h1 class="offersHeading p-3">Apt Iba Pa Offers</h1>

            <div class="container-md mb-5">
              <div class="box-container">
                <div class="row">

                  <div class="col-12 col-sm-6 col-md-4 p-3">
                    <div class="box">
                      <span class="fa-stack fa-3x">
                        <i class="fa-solid fa-circle fa-stack-2x"></i>
                        <i class="fa-light fa-book-atlas fa-stack-1x fa-inverse" style="color: #ff5a3d;"></i>
                      </span>
                      <div class="row mt-3">
                        <div class="col-12">
                          <h3>Online Catalog for Students</h3>
                        </div>
                      </div>
                      <p>Choose from different spaces, reserve, and schedule
                      your second home with one click</p>
                  </div>
                  </div>

                  <div class="col-12 col-sm-6 col-md-4 p-3">
                    <div class="box">
                      <span class="fa-stack fa-3x">
                        <i class="fa-solid fa-circle fa-stack-2x"></i>
                        <i class="fa-light fa-messages-question fa-stack-1x fa-inverse" style="color: #ff5a3d;"></i>
                      </span>
                      <h3 class="mt-3">Customer Support</h3>
                      <p>Ask for help from the team, anytime. 
                      Just send us a message and get back to you 
                      immediately.</p>
                    </div>
                  </div>

                  <div class="col-12 col-sm-6 col-md-4 p-3">
                    <div class="box">
                      <span class="fa-stack fa-3x">
                        <i class="fa-solid fa-circle fa-stack-2x"></i>
                        <i class="fa-light fa-house-user fa-stack-1x fa-inverse" style="color: #ff5a3d;"></i>
                      </span>
                      <h3 class="mt-3">A space to call Home</h3>
                      <p>A place you can call home, somewhere you can
                      work and relax at the same time.</p>
                    </div>
                  </div>


                  <div class="col-12 col-sm-6 col-md-4 p-3">
                    <div class="box">
                      <span class="fa-stack fa-3x">
                        <i class="fa-solid fa-circle fa-stack-2x"></i>
                        <i class="fa-light fa-shield-heart fa-stack-1x fa-inverse" style="color: #ff5a3d;"></i>
                      </span>
                      <h3 class="mt-3">Built-In Comfort</h3>
                      <p>Functional spaces with amenities that cater to 
                      your basic needs and comfortability.</p>
                    </div>
                  </div>

                  <div class="col-12 col-sm-6 col-md-4 p-3">
                    <div class="box">
                      <span class="fa-stack fa-3x">
                        <i class="fa-solid fa-circle fa-stack-2x"></i>
                        <i class="fa-light fa-lock fa-stack-1x fa-inverse" style="color: #ff5a3d;"></i>
                      </span>
                      <h3 class="mt-3">Well-secured Spaces</h3>
                      <p>Our homes come with CCTV, caretakers, and security
                      personnel you can rely on for your safety.</p>
                    </div>
                  </div>

                  <div class="col-12 col-sm-6 col-md-4 p-3">
                    <div class="box">
                      <span class="fa-stack fa-3x">
                        <i class="fa-solid fa-circle fa-stack-2x"></i>
                        <i class="fa-light fa-calendar-week fa-stack-1x fa-inverse" style="color: #ff5a3d;"></i>
                      </span>
                      <h3 class="mt-3">Regular Maintenance</h3>
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
    <?php include('footer.php'); ?>
    <!-- Footer ends -->


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

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
    crossorigin="anonymous"
  ></script>
    </body>
    </html>
  