<?php
use Models\Property;
use Models\Amenity;
use Models\Room;
use Models\RoomAmenity;
use Models\Image;
use Models\Review;
use Models\Rule;
use Models\Schedule;
use Models\Appointment;
include ("init.php");
include ("session.php");

    $user_id = $_SESSION['user_id'] ?? NULL;
    if(isset($_GET['property_id'])){
        $_SESSION['property_view_id'] = $_GET['property_id'];
    } else{
        $_SESSION['property_view_id'] = $_SESSION['property_view_id'];
    }
    
    $property_id = $_SESSION['property_view_id'];
    $_SESSION['current_page'] = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    
    $property = new Property();
    $property->setConnection($connection);
    $details = $property->getPropertyDetails($property_id);

    //print_r($details);

    //property information
    $property_name = $details['property_type'];
	$property_name = $details['property_name'];
	$landlord_id = $details['landlord_id'];
    $description = $details['description'];
    $total_floors = $details['total_floors'];
	$total_rooms = $details['total_rooms'];
    $lowest_rate = $details['lowest_rate'];
    $reservation_fee = $details['reservation_fee'];
    $advance_deposit = $details['advance_deposit'];
	$property_number = $details['property_number'];
	$street = $details['street'];
    $barangay = $details['barangay'];
    $city = $details['city'];
    $province = $details['province'];
	$region = $details['region'];
	$latitude = $details['latitude'];
	$longitude = $details['longitude'];

    $aircon = $details['aircon'];
    $cabinet = $details['cabinet'];
    $cctv = $details['cctv'];
    $drinking_water = $details['drinking_water'];
    $elevator = $details['elevator'];
    $emergency_exit = $details['emergency_exit'];
    $food_hall = $details['food_hall'];
    $laundry = $details['laundry'];
    $lounge = $details['lounge'];
    $microwave = $details['microwave'];
    $parking = $details['parking'];
    $refrigerator = $details['refrigerator'];
    $roof_deck = $details['roof_deck'];
    $security = $details['security'];
    $sink = $details['sink'];
    $study_area = $details['study_area'];
    $tv = $details['tv'];
    $wifi = $details['wifi'];

    $full_address = $property_number . ' ' . $street . ', ' . $barangay . '
     ' . $city . ' ' . $province;

    //landlord information
	$first_name = $details['first_name'];
	$last_name = $details['last_name'];

    //get all rooms of property
	$room = new Room();
	$room->setConnection($connection);
	$rooms = $room->getRooms($property_id);

    //get all rules
    $rules = new Rule();
    $rules->setConnection($connection);
    $rules = $rules->getRules($property_id);

    $short = $rules['short_term']; //1 or 0 
    $minweeks = $rules['min_weeks']; //00-99
    $mixgender = $rules['mix_gender']; //1 or 0 
    $curfew = $rules['curfew']; //1 or 0 
    $from_curfew = $rules['from_curfew']; //time
    $to_curfew = $rules['to_curfew']; //time
    $cooking = $rules['cooking']; //1 or 0 
    $pets = $rules['pets']; //1 or 0 
    $visitors = $rules['visitors']; //1 or 0 
    $from_visit = $rules['from_visit']; //time
    $to_visit = $rules['to_visit']; //time
    $alcohol = $rules['alcohol']; //1 or 0 
    $smoking = $rules['smoking']; //1 or 0 
    
    //get all images
    $images = new Image();
    $images->setConnection($connection);
    $images = $images->getImages($property_id);
    
    //var_dump($images);
    //$property_id = 26;
        //$user_id = 33; //change with session

    $disabled_dates = [];

    $date_time = new Schedule('','','');
    $date_time->setConnection($connection);
    $date_time = $date_time->getDateTime($property_id);

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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title> Apt Iba Pa | <?php echo $property_name ?> </title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM"
      crossorigin="anonymous"
    />
    <link
      href="https://getbootstrap.com/docs/5.3/assets/css/docs.css"
      rel="stylesheet"
    />
    <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
    crossorigin="anonymous"
  ></script>
    <script
      src="https://kit.fontawesome.com/868f1fea46.js"
      crossorigin="anonymous"
    ></script>

    <!-- <link href="css/view_property.css" rel="stylesheet" />
    <link href="css/all.css" rel="stylesheet" /> -->

    <!-- Vendor Files -->
    <link href="vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    
    <!-- LeafletJS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
     integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
     crossorigin=""/>
     <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
     integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
     crossorigin=""></script>

    <!-- Bootstrap Carousel CSS -->

    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
      integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g=="
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"
      integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw=="
      crossorigin="anonymous"
    />
  </head>
  <body>
    <style>
        <?php 
        include('css/view_property.css'); 
        include('css/all.css');
        ?>
    </style>
    <!-- Navbar -->
<?php include('navbar.php'); ?>

    <!-- Navbar ends -->


<input type="hidden" value="<?php echo $property_id ?>" name="property_id" id="property_id">
<input type="hidden" value="<?php echo $property_name ?>" name="property_name" id="property_name">
    <!-- Carousel code starts here -->
    <div class="container-fluid">
      <h1 class="text-center fw-bold display-1 mt-5 mb-5"> <?= $property_name ?> </h1>
      <div class="row">
          <div class="col-12 m-auto">
              <div class="owl-carousel owl-theme carousel-container">
                <?php foreach($images as $img){
                    $image = $img['image_path'];
                    $title = $img['title'];
                ?>
                  <div class="item">
                      <div class="card border-0 shadow">
                          <img src='resources/images/properties/<?php echo $image ?>' name="image" alt="" class="card-img-center">
                          <div class="card-body">
                            <div class="card-title text-center">
                                <h4><?php echo $title ?></h4>
                            </div>
                        </div>
                          
                      </div>
                  </div>
                <?php } ?>
              </div>
          </div>
      </div>
  </div>

  

    <!-- Carousel code ends here -->

<!-- Start of Property Information -->

<div class="container pt-5 pb-5 viewP">
  <div class="row">
    <div class="col-md-6">
      <div class="row">
        <div class="col-10">
          <h3 class="name"><?= $property_name ?></h3>
          <div class="row">
            <div class="h4 mt-3 col-sm-10 location">
              <div>
                <i class="fas fa-map-marker-alt"></i> <?= $full_address ?>
              </div> 
            </div>
          </div>
        </div>

        <div class="col-2 ps-4 justify-content-end">
          <button onclick="Toggle1()" id="btnBm" class="btn btnBookmark">
            <i class="fa-solid fa-bookmark fa-3x"></i>
          </button>
        </div>
      </div>

      <div class="row">
        <div class="col-sm-11 mt-5 viewpDescription">
          Description
          <div class="description">
            <?= $description ?>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-sm mb-3">
          <p class="btnRating">
            <i class="fa-solid fa-star-half-stroke starRating"></i> <?= $show_reviews ?>
          </p>
        </div>
      </div>
    </div>
    <!-- closing tag of 1st col-md-6 -->

    <div class="col-md-6">
      <div class="row">
        <div class="col justify-content-center">
          <h4 class="aptStarts" style="text-align: center;">
            Rent starts at
          </h4>
          <h3 class="aptPrice">
            &#8369;<?= $lowest_rate ?><span class="monthly">/Monthly</span>
          </h3>
          <!-- <h3 class="aptPrice">
            &#8369;5,000<span class="monthly">/Monthly</span>
          </h3> -->
        </div>
      </div>

      <?php if(!isset($_SESSION['user_id'])){ ?>
      <div class="row py-3">
        <div class="col-sm">
          <a href="login.php" class="btnViewP">Request a Visit</a>
        </div>
        <div class="col-sm">
          <a href="login.php" class="btnViewP">Reserve a Room</a>
        </div>
      </div>
    <?php } else { ?>
      <div class="row py-3">
        <div class="col-sm">
          <a href="#" class="btnViewP" data-bs-toggle="modal" data-bs-target="#requestVisit">Request a Visit</a>
        </div>
        <div class="col-sm">
          <a href="#" class="btnViewP" data-bs-toggle="modal" data-bs-target="#reserveRoom">Reserve a Room</a>
        </div>
      </div>
    <?php } ?>
      <div class="row pt-5">
        <div class="col-sm availRoom">
          <div class="room">Available Rooms</div>
          <span> 3 out of 9 room/s available </span>
        </div>
      </div>
    </div>
    <!-- closing tag of 1st col-md-6 -->
  </div>
  <!-- closing tag of container viewP row -->
</div>
<!-- closing tag of container viewP-->


    

<!-- Start of Property Amenities under Property Information -->
<div class="container pt-3 amenities">
  <div class="row">
    <div class="col-md-6">
      <h3 class="name">Property Amenities</h3>
      
    <hr />
    </div>

    <div class="col-md-6 text-md-start order-2 order-md-0">

        <div class="h5 d-none d-md-block">
          <span class="name h3">House Rules</span>
        </div>

        <div class="name h3 d-block d-md-none">House Rules</div>

      <hr />
    </div>

    <div class="col-md-6">
      <div class="row">
        <div class="text-center" >
          <div class="row mt-3">
            <div class="col-md-4 description">
                <div class="row">
                    <p <?php echo $aircon===1 ? '' : 'style="text-decoration: line-through"' ?>><i class="fa solid fa-fan"></i><span> Aircon</span></p>
                </div>
                <div class="row">
                    <p <?php echo $cabinet===1 ? '' : 'style="text-decoration: line-through"' ?>><i class="fa solid fa-grip"></i><span> Cabinet</span></p>
                </div> 
                <div class="row">
                    <p <?php echo $cctv===1 ? '' : 'style="text-decoration: line-through"' ?>><i class="fa solid fa-grip"></i><span> CCTV</span></p>
                </div> 
                <div class="row">
                    <p <?php echo $drinking_water===1 ? '' : 'style="text-decoration: line-through"' ?>><i class="fa solid fa-grip"></i><span> Drinking Water</span></p>
                </div> 
                <div class="row">
                    <p <?php echo $elevator===1 ? '' : 'style="text-decoration: line-through"' ?>><i class="fa solid fa-grip"></i><span> Elevator</span></p>
                </div> 
                <div class="row">
                    <p <?php echo $emergency_exit===1 ? '' : 'style="text-decoration: line-through"' ?>><i class="fa solid fa-grip"></i><span> Emergency Exit</span></p>
                </div>  
            </div>

            <div class="col-md-4 description">
                <div class="row">
                    <p <?php echo $food_hall===1 ? '' : 'style="text-decoration: line-through"' ?>><i class="fa solid fa-grip"></i><span> Food Hall</span></p>
                </div>
                <div class="row">
                    <p <?php echo $laundry===1 ? '' : 'style="text-decoration: line-through"' ?>><i class="fa solid fa-grip"></i><span> Laundry</span></p>
                </div> 
                <div class="row">
                    <p <?php echo $lounge===1 ? '' : 'style="text-decoration: line-through"' ?>><i class="fa solid fa-grip"></i><span> Lounge</span></p>
                </div> 
                <div class="row">
                    <p <?php echo $microwave===1 ? '' : 'style="text-decoration: line-through"' ?>><i class="fa solid fa-grip"></i><span> Microwave</span></p>
                </div> 
                <div class="row">
                    <p <?php echo $parking===1 ? '' : 'style="text-decoration: line-through"' ?>><i class="fa solid fa-grip"></i><span> Parking</span></p>
                </div> 
                <div class="row">
                    <p <?php echo $refrigerator===1 ? '' : 'style="text-decoration: line-through"' ?>><i class="fa solid fa-grip"></i><span> Refrigerator</span></p>
                </div>          
            </div>

            <div class="col-md-4 description">
                <div class="row">
                    <p <?php echo $roof_deck===1 ? '' : 'style="text-decoration: line-through"' ?>><i class="fa solid fa-arrows-left-right"></i><span> Roof Deck</span></p>
                </div>
                <div class="row">
                    <p <?php echo $security===1 ? '' : 'style="text-decoration: line-through"' ?>><i class="fa solid fa-grip"></i><span> Security</span></p>
                </div> 
                <div class="row">
                    <p <?php echo $sink===1 ? '' : 'style="text-decoration: line-through"' ?>><i class="fa solid fa-grip"></i><span> Sink</span></p>
                </div> 
                <div class="row">
                    <p <?php echo $study_area===1 ? '' : 'style="text-decoration: line-through"' ?>><i class="fa solid fa-grip"></i><span> Study Area</span></p>
                </div> 
                <div class="row">
                    <p <?php echo $tv===1 ? '' : 'style="text-decoration: line-through"' ?>><i class="fa solid fa-grip"></i><span> TV</span></p>
                </div> 
                <div class="row">
                    <p <?php echo $wifi===1 ? '' : 'style="text-decoration: line-through"' ?>><i class="fa solid fa-grip"></i><span> Wifi</span></p>
                </div>          
            </div>
          </div>
        </div>
      </div>
    </div>

      <!-- House Rules -->
    <div class="col-md-6 order-3 order-md-0">

      <div class="row">
        
        <div class="row mt-3">
          <div class="col-md-6 description">
            <div class="row">
                <?php if($pets===0){ ?>
                <p style="text-decoration: line-through">
                <? } else{ ?> 
                <p> 
                <?php } ?>
                <i class="fa-solid fa-paw"></i>
                <span> Pets are allowed</span>
              </p>
            </div>

            <div class="row">
                <?php if($visitors===0){ ?>
                    <p style="text-decoration: line-through">
                    <? } else{ ?> 
                    <p> 
                    <?php } ?>
                <i class="fa-solid fa-user-group-simple"></i>
                <span> Guests are allowed</span>
              </p>
            </div>
            
            <div class="row">
                <?php if($smoking===0){ ?>
                    <p style="text-decoration: line-through">
                    <? } else{ ?> 
                    <p> 
                    <?php } ?>
                <i class="fa-regular fa-smoking"></i>
                <span> Smoking/Vaping not allowed</span>
              </p>
            </div>

            <div class="row">
                <?php if($alcohol===0){ ?>
                    <p style="text-decoration: line-through">
                    <? } else{ ?> 
                    <p> 
                    <?php } ?>
                <i class="fa-regular fa-wine-bottle"></i>
                <span> Alcoholic drinks not allowed</span>
              </p>
            </div>
            

          </div>

          <div class="col-md-3 description ps-md-5 ms-md-3">
            <?php if($curfew===0){ ?>
            <div class="row">
                <p style="text-decoration: line-through">
                <i class="fa-solid fa-clock-eleven"></i>
                <span> Curfew Hours</span>
                </p>
            </div>
            <?php } elseif($curfew===1){ ?> 
            <div class="row">
                <p>
                <i class="fa-solid fa-clock-eleven"></i>
                <span> Curfew Hours</span>
                </p>
            </div>
            <div class="row">
              <p>
                <span> <?php echo $from_curfew . ' to ' . $to_curfew ?></span>
              </p>
            </div>
            <?php } ?>

            <div class="row">
            <?php if($visitors===0){ ?>
            <p style="text-decoration: line-through">
                <i class="fa-sharp fa-regular fa-hourglass-clock"></i>
                <span> Guests Hours</span>
              </p>

              <?php } else{ ?> 
                <p>
                    <i class="fa-sharp fa-regular fa-hourglass-clock"></i>
                    <span> Guests Hours</span>
                </p>

            </div>

            <div class="row">
              <p>
                <span> <?php echo $from_visit . ' to ' . $to_visit ?></span>
              </p>
            </div>
            <?php } ?>

          </div>

          
        </div>
          
        
  
      </div>

    </div>



  </div>
</div>

<!-- Start of Room Amenities under Property Information -->
<div class="container pt-5 amenities">
  <div class="row">
    <div class="col-12 text-center">
      <h3 class="name">Available Rooms</h3>
    </div>
  </div>

    <hr />
  <div class="row row-gap-3 ">

    <div class="row column-gap-3 justify-content-center ">
      
      <div class="col-md-5 text-center" >
        
          <div class="row justify-content-between">
            <div class="col-6 col-md-6 mt-3 d-flex justify-content-start amenitiesTitle">
              Single Bed Room
            </div>

            <div class="col-5 col-md-6 mt-3 d-flex justify-content-end amenitiesTitle" >
              ₱5000
            </div>
          </div>

      </div>
      

      <div class="col-md-5 text-center" >
        
        <div class="row justify-content-between">
          <div class="col-6 col-md-6 mt-3 d-flex justify-content-start amenitiesTitle">
            Double Bed Room
          </div>

          <div class="col-5 col-md-6 mt-3 d-flex justify-content-end amenitiesTitle" >
            ₱5000
          </div>
        </div>
    </div>
    </div>

    <div class="row column-gap-3 justify-content-center ">
      
      <div class="col-md-5 text-center" >
        
          <div class="row justify-content-between">
            <div class="col-6 col-md-6 mt-3 d-flex justify-content-start amenitiesTitle">
              Triple Bed Room
            </div>

            <div class="col-5 col-md-6 mt-3 d-flex justify-content-end amenitiesTitle" >
              ₱5000
            </div>
          </div>

      </div>
      

      <div class="col-md-5 text-center" >
        
        <div class="row justify-content-between">
          <div class="col-6 col-md-6 mt-3 d-flex justify-content-start amenitiesTitle">
            Quad Bed Room
          </div>

          <div class="col-5 col-md-6 mt-3 d-flex justify-content-end amenitiesTitle" >
            ₱5000
          </div>
        </div>

        
    </div>


    </div>

  </div>

  <!-- End of Room Amenities under Property Information -->
</div>

</div>




<!-- Start of Google Map under Property Information -->

<div class="container pt-5">
  <div class="row">
    <div id="map"></div>
    <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d962.807197098562!2d120.59276596960956!3d15.145774899088007!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3396f313262cc467%3A0xa12b7889c166e418!2sJaeden%20Kent%20Residence%20%2F%20Batac%20-Valencia!5e0!3m2!1sen!2sph!4v1690310871739!5m2!1sen!2sph" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe> -->
  </div>
</div>
<style>
        #map {height: 600px; width: 1350px }
    </style>
<script>
var map_center = [15.145763463436099, 120.59339729138502];
        var mapOptions = {
        center: map_center,
        zoom: 30
        }
        var map = L.map('map', mapOptions);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);
        var marker = L.marker([15.145763463436099, 120.59339729138502]).addTo(map);
        marker.bindPopup("<b>Batac Dormitory</b><br>Lourdes Sur East<br><a href='view.php?property_id=<?php echo $property_id ?>'>View</a>").openPopup();

</script>
<!-- End of Google Map under Property Information -->


<!-- Start of Reviews under Property Information -->
<div class="container-fluid mt-5" style="background-color: #191d28;">
<div class="container pt-5">
    <div class="row">
            <div class="testimonials-section px-5">
                
                <!-- Section Header Starts -->
              <div class="row">
                <div class="col-10">
                  <header class="section-header">
                      <h1>Reviews</h1>
                  </header>
                    <div class="row">
                      <div class="col-sm">
                        <div class="review-p">
                          <p>How others rated this apartment</p>
                        </div>
                      </div>
                    </div>
                </div>
                <div class="col-lg-2 section-header-btn">
                    <a href="#" class="btnReview">Add a review</a>
                </div>
              </div>
              <!-- Section Header Ends -->
            
                <!-- Owl Carousel Slider Starts -->
                <div class="owl-carousel owl-theme testimonials-container">
                    <!-- Item1 Starts -->
                    <div class="item testimonial-card">
                        <main class="test-card-body">
                          <div class="profile">
                            <div class="profile-image">
                                <img src="images/prof1.png">
                            </div>
                            <div class="profile-desc">
                                <span>Micoh Yabut</span>
                                <span class="ratings">
                                  <i class="fa-solid fa-star"></i>
                                  <i class="fa-solid fa-star"></i>
                                  <i class="fa-solid fa-star"></i>
                                  <i class="fa-solid fa-star"></i>
                                  <i class="fa-solid fa-star"></i>
                                  <i class="num"> 5.0</i>
                                </span>
                                <span class="date">Jun-06-23</span>
                            </div>
                          </div>
                            <div class="quote">
                                <i class="fa fa-quote-left"></i>
                                <h2>Awesome Coding</h2>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</p>
                        </main>

                    </div>
                    <!-- Item1 Ends -->
            
                    <!-- Item2 Starts -->
                    <div class="item testimonial-card">
                        <main class="test-card-body">
                          <div class="profile">
                            <div class="profile-image">
                                <img src="images/prof2.png">
                            </div>
                            <div class="profile-desc">
                                <span>Arnold Lim</span>
                                <span class="ratings">
                                  <i class="fa-solid fa-star"></i>
                                  <i class="fa-solid fa-star"></i>
                                  <i class="fa-solid fa-star"></i>
                                  <i class="fa-solid fa-star"></i>
                                  <i class="fa-solid fa-star"></i>
                                  <i class="num"> 5.0</i>
                                </span>
                                <span class="date">Jun-06-23</span>
                            </div>
                          </div>
                            <div class="quote">
                                <i class="fa fa-quote-left"></i>
                                <h2>Awesome Coding</h2>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</p>
                        </main>
                    </div>
                    <!-- Item2 Ends -->
            
                    <!-- Item3 Starts -->
                    <div class="item testimonial-card">
                        <main class="test-card-body">
                          <div class="profile">
                            <div class="profile-image">
                                <img src="images/prof3.png">
                            </div>
                            <div class="profile-desc">
                                <span>Aaron Echon</span>
                                <span class="ratings">
                                  <i class="fa-solid fa-star"></i>
                                  <i class="fa-solid fa-star"></i>
                                  <i class="fa-solid fa-star"></i>
                                  <i class="fa-solid fa-star"></i>
                                  <i class="fa-solid fa-star"></i>
                                  <i class="num"> 5.0</i>
                                </span>
                                <span class="date">Jun-06-23</span>
                            </div>
                          </div>
                            <div class="quote">
                                <i class="fa fa-quote-left"></i>
                                <h2>Awesome Coding</h2>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</p>
                        </main>
                    </div>
                    <!-- Item3 Ends -->
            
                    <!-- Item4 Starts -->
                    <div class="item testimonial-card">
                        <main class="test-card-body">
                          <div class="profile">
                            <div class="profile-image">
                                <img src="images/prof1.png">
                            </div>
                            <div class="profile-desc">
                                <span>Micoh Jomarie</span>
                                <span class="ratings">
                                  <i class="fa-solid fa-star"></i>
                                  <i class="fa-solid fa-star"></i>
                                  <i class="fa-solid fa-star"></i>
                                  <i class="fa-solid fa-star"></i>
                                  <i class="fa-solid fa-star"></i>
                                  <i class="num"> 5.0</i>
                                </span>
                                <span class="date">Jun-06-23</span>
                            </div>
                          </div>
                            <div class="quote">
                                <i class="fa fa-quote-left"></i>
                                <h2>Awesome Coding</h2>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</p>
                        </main>
                    </div>
                    <!-- Item4 Ends -->
            
                    <!-- Item5 Starts -->
                    <div class="item testimonial-card">
                        <main class="test-card-body">
                          <div class="profile">
                            <div class="profile-image">
                                <img src="images/prof2.png">
                            </div>
                            <div class="profile-desc">
                                <span>Arnold Nicholas</span>
                                <span class="ratings">
                                  <i class="fa-solid fa-star"></i>
                                  <i class="fa-solid fa-star"></i>
                                  <i class="fa-solid fa-star"></i>
                                  <i class="fa-solid fa-star"></i>
                                  <i class="fa-solid fa-star"></i>
                                  <i class="num"> 5.0</i>
                                </span>
                                <span class="date">Jun-06-23</span>
                            </div>
                          </div>
                            <div class="quote">
                                <i class="fa fa-quote-left"></i>
                                <h2>Awesome Coding</h2>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</p>
                        </main>
                    </div>
                    <!-- Item5 Ends -->
            
                    <!-- Item6 Starts -->
                    <div class="item testimonial-card">
                        <main class="test-card-body">
                          <div class="profile">
                            <div class="profile-image">
                                <img src="images/prof3.png">
                            </div>
                            <div class="profile-desc">
                                <span>David Aaron</span>
                                <span class="ratings">
                                  <i class="fa-solid fa-star"></i>
                                  <i class="fa-solid fa-star"></i>
                                  <i class="fa-solid fa-star"></i>
                                  <i class="fa-solid fa-star"></i>
                                  <i class="fa-solid fa-star"></i>
                                  <i class="num"> 5.0</i>
                                </span>
                                <span class="date">Jun-06-23</span>
                            </div>
                          </div>
                            <div class="quote">
                                <i class="fa fa-quote-left"></i>
                                <h2>Awesome Coding</h2>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse.</p>
                        </main>
                    </div>
                    <!-- Item6 Ends -->
            
                </div>
                <!-- Owl Carousel Slider Ends -->
            
            </div>

            
    </div>
  </div>
</div>
  
  <!-- End of Reviews under Property Information -->

<!-- ======= Frequently Asked Questions Section ======= -->
  <section id="faq" class="faq section-bg">
    <div class="container" data-aos="fade-up">

      <div class="section-title">
        <h2>Frequently Asked Questions</h2>
        <p>Magnam dolores commodi suscipit. Necessitatibus eius consequatur ex aliquid fuga eum quidem. Sit sint consectetur velit. Quisquam quos quisquam cupiditate. Et nemo qui impedit suscipit alias ea. Quia fugiat sit in iste officiis commodi quidem hic quas.</p>
      </div>

      <div class="faq-list">
        <ul>
          <li data-aos="fade-up" data-aos-delay="100">
            <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" class="collapse" data-bs-target="#faq-list-1">Non consectetur a erat nam at lectus urna duis? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
            <div id="faq-list-1" class="collapse show" data-bs-parent=".faq-list">
              <p>
                Feugiat pretium nibh ipsum consequat. Tempus iaculis urna id volutpat lacus laoreet non curabitur gravida. Venenatis lectus magna fringilla urna porttitor rhoncus dolor purus non.
              </p>
            </div>
          </li>

          <li data-aos="fade-up" data-aos-delay="200">
            <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-2" class="collapsed">Feugiat scelerisque varius morbi enim nunc? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
            <div id="faq-list-2" class="collapse" data-bs-parent=".faq-list">
              <p>
                Dolor sit amet consectetur adipiscing elit pellentesque habitant morbi. Id interdum velit laoreet id donec ultrices. Fringilla phasellus faucibus scelerisque eleifend donec pretium. Est pellentesque elit ullamcorper dignissim. Mauris ultrices eros in cursus turpis massa tincidunt dui.
              </p>
            </div>
          </li>

          <li data-aos="fade-up" data-aos-delay="300">
            <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-3" class="collapsed">Dolor sit amet consectetur adipiscing elit? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
            <div id="faq-list-3" class="collapse" data-bs-parent=".faq-list">
              <p>
                Eleifend mi in nulla posuere sollicitudin aliquam ultrices sagittis orci. Faucibus pulvinar elementum integer enim. Sem nulla pharetra diam sit amet nisl suscipit. Rutrum tellus pellentesque eu tincidunt. Lectus urna duis convallis convallis tellus. Urna molestie at elementum eu facilisis sed odio morbi quis
              </p>
            </div>
          </li>

          <li data-aos="fade-up" data-aos-delay="400">
            <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-4" class="collapsed">Tempus quam pellentesque nec nam aliquam sem et tortor consequat? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
            <div id="faq-list-4" class="collapse" data-bs-parent=".faq-list">
              <p>
                Molestie a iaculis at erat pellentesque adipiscing commodo. Dignissim suspendisse in est ante in. Nunc vel risus commodo viverra maecenas accumsan. Sit amet nisl suscipit adipiscing bibendum est. Purus gravida quis blandit turpis cursus in.
              </p>
            </div>
          </li>

          <li data-aos="fade-up" data-aos-delay="500">
            <i class="bx bx-help-circle icon-help"></i> <a data-bs-toggle="collapse" data-bs-target="#faq-list-5" class="collapsed">Tortor vitae purus faucibus ornare. Varius vel pharetra vel turpis nunc eget lorem dolor? <i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
            <div id="faq-list-5" class="collapse" data-bs-parent=".faq-list">
              <p>
                Laoreet sit amet cursus sit amet dictum sit amet justo. Mauris vitae ultricies leo integer malesuada nunc vel. Tincidunt eget nullam non nisi est sit amet. Turpis nunc eget lorem dolor sed. Ut venenatis tellus in metus vulputate eu scelerisque.
              </p>
            </div>
          </li>

        </ul>
      </div>

    </div>
  </section>
<!-- End Frequently Asked Questions Section -->


  <!-- Start of Similar Apartment Listings -->

    <!-- <div class="container-fluid featuredHtml"> -->
      
    <hr>
    
      <section class="listings">
        <h1 class="featureHeading p-3">Featured Dormitories and Apartments</h1>

        <!-- <div class="container-md"> -->
          <div class="box-container">
            <div class="row gx-5">
              <div class="col-md">
                <div class="box">
                  <div class="thumb">
                    <p class="total-images">
                      <i class="far fa-image"></i><span>4</span>
                    </p>
                    <p class="type"><span>Apartment</span></p>
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
                      <h3 class="name">Batacs Dormitory</h3>
                      <div class="row">
                        <div class="h4 mt-3 col-sm-8">
                          <div>
                            <i class="fas fa-map-marker-alt"></i> Brgy. Claro M.
                            Recto
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
                      <a href="view.php?property_id=<?= $property_id ?>" class="btnView">View property</a>
                    </div>
                  </div>

                </div>
              </div>


              <div class="col-md">
                <div class="box">
                  <div class="thumb">
                    <p class="total-images">
                      <i class="far fa-image"></i><span>4</span>
                    </p>
                    <p class="type"><span>Apartment</span></p>
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
                      <h3 class="name">Batac Dormitory</h3>
                      <div class="row">
                        <div class="h4 mt-3 col-sm-8">
                          <div>
                            <i class="fas fa-map-marker-alt"></i> Brgy. Claro M.
                            Recto
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
                      <a href="view.php?property_id=<?= $property_id ?>" class="btnView">View property</a>
                    </div>
                  </div>

                </div>
              </div>


              <div class="col-md">
                <div class="box">
                  <div class="thumb">
                    <p class="total-images">
                      <i class="far fa-image"></i><span>4</span>
                    </p>
                    <p class="type"><span>Apartment</span></p>
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
                      <h3 class="name">Batac Dormitory</h3>
                      <div class="row">
                        <div class="h4 mt-3 col-sm-8">
                          <div>
                            <i class="fas fa-map-marker-alt"></i> Brgy. Claro M.
                            Recto
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
                      <p class="btnRating"><i class="fa-solid fa-star-half-stroke starRating"></i> 4.8 (73 reviews)</p>
                    </div>
                    <div class="col-lg-6">
                      <a href="view.php?property_id=<?= $property_id ?>" class="btnView">View property</a>
                    </div>
                  </div>

                </div>
              </div>
            </div>

          </div>

          <div style="margin-top: 4rem; text-align: center">
            <a href="accomodations.php" class="inline-btn">View All</a>
          </div>

        <!-- </div> -->
      </section>
    <!-- </div> -->

    <!-- Featured ends -->



  <!-- End of Similar Apartment Listings -->



<!-- End of Property Information -->
 

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
  



  <!-- Request a Visit Modal -->

  <!-- Modal -->

  <?php include('appointment-modal.php'); ?>

  <!-- Reserve a Room Modal -->

  <?php include('reservation-modal.php'); ?>
  </body>

  <!-- javascript -->
  

  <script src="js/accommodations.js"></script>
  


  <!-- JS of Carousel -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>  -->


  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
      integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
      crossorigin="anonymous"></script>
  <script>
      $('.carousel-container').owlCarousel({
          loop: false,
          margin: 15,
          nav: true,
          navText:["<i class='fa-solid fa-arrow-left leftArrow'></i>",
                   "<i class='fa-solid fa-arrow-right rightArrow'></i>"],
          responsive: {
              0: {
                  items: 1
              },
              600: {
                  items: 2
              },
              1000: {
                  items: 3
              }
          }
      })

      $('.testimonials-container').owlCarousel({
        loop:true,
        autoplay:false,
        autoplayTimeout:6000,
        margin:10,
        nav:false,
        responsive:{
            0:{
                items:1,
                nav:false
            },
            600:{
                items:1,
                nav:true
            },
            768:{
                items:2
            },
        }
        })
  </script>

</html>
