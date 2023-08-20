<?php
use Models\Property;
use Models\Amenity;
use Models\Room;
use Models\RoomAmenity;
use Models\Image;
use Models\Review;
include ("init.php");
//include ("../session.php");

    $user_id = $_SESSION['user_id'] ?? NULL;
    //$property_id = $_GET['property_id'];
    $property_id = 1;
    $property = new Property('','', '', '', '','','','','', '', '', '','','','','','');
    $property->setConnection($connection);
    $details = $property->getPropertyDetails($property_id);

    //var_dump($details);
	$property_name = $details['property_name'];
	$owner_id = $details['owner_id'];
	$total_rooms = $details['total_rooms'];
	$total_floors = $details['total_floors'];
	$description = $details['description'];
	$property_number = $details['property_number'];
	$street = $details['street'];
	$region = $details['region'];
	$province = $details['province'];
	$city = $details['city'];
	$barangay = $details['barangay'];
	$postal_code = $details['street'];
	$latitude = $details['latitude'];
	$longitude = $details['longitude'];
	$first_name = $details['first_name'];
	$last_name = $details['last_name'];
    $full_address = $property_number . ' ' . $street . ', ' . $barangay . '
     ' . $city . ' ' . $province;

	$amenity = new Amenity('','','');
	$amenity->setConnection($connection);
	$amenities = $amenity->getAmenities($property_id);
    $amenities_array = $amenities['amenity_name'];
    $property_amenities = explode(",", $amenities_array);

	$room = new Room('','','','','','','');
	$room->setConnection($connection);
	$rooms = $room->getRooms($property_id);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Batac Dormitory - view</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM"
      crossorigin="anonymous"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      href="https://getbootstrap.com/docs/5.3/assets/css/docs.css"
      rel="stylesheet"
    />
    <script
      src="https://kit.fontawesome.com/868f1fea46.js"
      crossorigin="anonymous"
    ></script>

    <link href="css/view_property.css" rel="stylesheet" />
    <link href="css/all.css" rel="stylesheet" />

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
    <!-- Navbar -->

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">
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



    <!-- Carousel code starts here -->
    <div class="container-fluid">
      <h1 class="text-center fw-bold display-1 mt-5 mb-5"><?= $property_name?><span class="text" style="color:#052069">Dormitory</span></h1>
      <div class="row">
          <div class="col-12 m-auto">
              <div class="owl-carousel owl-theme carousel-container">
                <?php
                    $images = new Image();
                    $images->setConnection($connection);
                    $getImages = $images->getImages($property_id);
                    
                    
                    foreach($getImages as $img){
                ?>
                  <div class="item">
                      <div class="card border-0 shadow">
                          <img src="../resources/images/properties/<?= $img['image_path']?>" alt="" class="card-img-center">
                          <div class="card-body">
                            <div class="card-title text-center">
                                <h4>Hall</h4>
                            </div>
                        </div>
                          
                      </div>
                  </div>
                <?php } ?>
                  <div class="item">
                      <div class="card border-0 shadow">
                          <img src="images/hall-img-1.webp" alt="" class="card-img-top">
                          <div class="card-body">
                            <div class="card-title text-center">
                                <h4>Room</h4>
                            </div>
                        </div>
                          
                      </div>
                  </div>
                  <div class="item">
                      <div class="card border-0 shadow">
                          <img src="images/bathroom-img-1.webp" alt="" class="card-img-top">
                          <div class="card-body">
                              <div class="card-title text-center">
                                  <h4>Bathroom</h4>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="item">
                      <div class="card border-0 shadow">
                          <img src="images/hall-img-1.webp" alt="" class="card-img-top">
                          <div class="card-body">
                              <div class="card-title text-center">
                                  <h4>Owl Carousel</h4>
                              </div>
                          </div>
                      </div>
                  </div>

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
          <h3 class="name"><Batac Dormitory></h3>
          <div class="row">
            <div class="h4 mt-3 col-sm-10 location">
              <div>
                <i class="fas fa-map-marker-alt"></i><?= $full_address ?>>
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
            <i class="fa-solid fa-star-half-stroke starRating"></i> 4.8 (73
            reviews)
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
            &#8369;5,000<span class="monthly">/Monthly</span>
          </h3>
          <!-- <h3 class="aptPrice">
            &#8369;5,000<span class="monthly">/Monthly</span>
          </h3> -->
        </div>
      </div>

      <div class="row py-3">
        <div class="col-sm">
        <!-- <input type="hidden" name="property_id" value="<?php echo $property_id ?>"> -->
          <a href="#" class="btnViewP" data-bs-toggle="modal" data-bs-target="#requestVisit">Request a Visit</a>
        </div>
        <div class="col-sm">
        <!-- <input type="hidden" name="property_id" value="<?php echo $property_id ?>"> -->
          <a href="#" class="btnViewP" data-bs-toggle="modal" data-bs-target="#reserveRoom">Reserve a Room</a>
        </div>
      </div>

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

    <div class="col-md-6 text-md-end order-2 order-md-0">

        <div class="h5 d-none d-md-block">frequently asked questions 
          <span class="name h3">FAQs</span>
        </div>

        <div class="name h3 d-block d-md-none">FAQs<span class="h5">frequently asked questions</span></div>

      <hr />
    </div>

    <div class="col-md-6">

      <div class="row">
        
        <div class="text-center" >
  
          <div class="row mt-3">
            <div class="col-md-6 description">
                <?php
                foreach($property_amenities as $amenity) {
                    if($amenity == 'cabinet'){
                        $icon = 'fa-grip'; // and more
                    } ?>
              <div class="row">
                <p><i class="fa solid <?= $icon ?>"></i><span><?= $amenity ?></span></p>
              </div>
              <?php } ?>
              <div class="row">
                <p style="text-decoration: line-through">
                  <i class="fa-solid fa-fan"></i><span> Aircon</span>
                </p>
              </div>
              
              <div class="row">
                <p><i class="fa-solid fa-bath"></i><span> CR</span></p>
              </div>
              
              <div class="row">
                <p>
                  <i class="fa-solid fa-shower"></i>
                  <span> Bathroom</span>
                </p>
              </div>
              
              <div class="row">
                <p>
                  <i class="fa-solid fa-bed"></i>
                  <span> 1 Small Single Bed</span>
                </p>
              </div>
              
              <div class="row">
                <p style="text-decoration: line-through">
                  <i class="fa-solid fa-arrows-left-right"></i>
                  <span> Roof Deck</span>
                </p>
              </div>
  
            </div>
  
            <div class="col-md-6  description">
              <div class="row">
                <p><i class="fa solid fa-grip"></i><span> Cabinet</span></p>
              </div>
  
              <div class="row">
                <p style="text-decoration: line-through">
                  <i class="fa-solid fa-fan"></i><span> Aircon</span>
                </p>
              </div>
              
              <div class="row">
                <p><i class="fa-solid fa-bath"></i><span> CR</span></p>
              </div>
              
              <div class="row">
                <p>
                  <i class="fa-solid fa-person-running"></i>
                  <span> Emergency Exit</span>
                </p>
              </div>
              
              <div class="row">
                <p>
                  <i class="fa-solid fa-bed"></i>
                  <span> 1 Small Single Bed</span>
                </p>
              </div>
              
              <div class="row">
                <p style="text-decoration: line-through">
                  <i class="fa-solid fa-arrows-left-right"></i>
                  <span> Roof Deck</span>
                </p>
              </div>
  
            </div>
  
            
          </div>
          
        </div>
  
      </div>
  
      </div>

    <div class="col-md-6 align-items-center order-3 order-md-0">

      <div class="accordion" id="faqsAccord">
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
              Are guests allowed?
            </button>
          </h2>
          <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#faqsAccord">
            <div class="accordion-body">
              Yes. However, they can only stay your room until 8pm.
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
              Are pets allowed?
            </button>
          </h2>
          <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#faqsAccord">
            <div class="accordion-body">
              Unfortunately, pets are not allowed at our property.
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
              How much is the reservation fee?
            </button>
          </h2>
          <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#faqsAccord">
            <div class="accordion-body">
              It costs ₱500. And a downpayment of ₱3,000 to secure your reserved room.
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
              How much is the reservation fee?
            </button>
          </h2>
          <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#faqsAccord">
            <div class="accordion-body">
              It costs ₱500. And a downpayment of ₱3,000 to secure your reserved room.
            </div>
          </div>
        </div>
        
      </div>

    </div>



  </div>
</div>

<!-- End of Property Amenities under Property Information -->

<?php foreach($rooms as $room){
	$room_id = $room['room_id'];
    $roomAmenity = new RoomAmenity('','','');
	$roomAmenity->setConnection($connection);
	$roomAmenities = $roomAmenity->getAmenities($room_id);
    $room_amenities = explode(",", $roomAmenities['amenity_name']);
    $bed = $room['total_beds'];
    if($bed===1){
        $room_type = "Single Room";
    } elseif($bed===2) {
        $room_type = "Double Room";
    } elseif($bed===3) {
        $room_type = "Triple Room";
    } elseif($bed===4) {
        $room_type = "Quad Room";
    } elseif($bed===5) {
        $room_type = "5-Bed Room";
    } elseif($bed===6) {
        $room_type = "6-Bed Room";
    } elseif($bed===7) {
        $room_type = "7-Bed Room";
    } elseif($bed===8) {
        $room_type = "8-Bed Room";
    }
?>

<!-- Start of Room Amenities under Property Information -->
<div class="container pt-5 amenities">
  <div class="row">
    <div class="col-12 text-center">
      <h3 class="name">Room Amenities</h3>
    </div>
  </div>

    <hr />
  <div class="row row-gap-3 ">

    <div class="row column-gap-3 justify-content-center ">
      
      <div class="col-md-5 text-center" >
        
          <div class="row justify-content-between">
            <div class="col-6 col-md-6 mt-3 d-flex justify-content-start amenitiesTitle">
                <?= $room_type ?>
            </div>

            <div class="col-5 col-md-6 mt-3 d-flex justify-content-end amenitiesTitle" >
              ₱<?= $monthly_rent ?>
            </div>
          </div>

          <div class="row mt-3">
            <div class="col-md-6 description">
                <?php foreach($room_amenities as $amenities):?>
              <div class="row">
                <p><i class="fa-regular fa-fan-table"></i></i><span> <?php echo $amenities;?></span></p>
              </div>
              <?php endforeach;?>
              <div class="row">
                <p style="text-decoration: line-through">
                  <i class="fa-solid fa-fan"></i><span> Aircon</span>
                </p>
              </div>
              
              <div class="row">
                <p><i class="fa-solid fa-toilet"></i><span> CR</span></p>
              </div>
              
              <div class="row">
                <p>
                  <i class="fa-solid fa-person-to-door"></i>
                  <span> Emergency Exit</span>
                </p>
              </div>
              
              <div class="row">
                <p>
                  <i class="fa-solid fa-bed-front"></i>
                  <span> 1 Small Single Bed</span>
                </p>
              </div>
              
              <div class="row">
                <p style="text-decoration: line-through">
                  <i class="fa-solid fa-arrows-left-right"></i>
                  <span> Roof Deck</span>
                </p>
              </div>

            </div>

            <div class="col-md-6  description">
              <div class="row">
                <p><i class="fa solid fa-grip"></i><span> Cabinet</span></p>
              </div>

              <div class="row">
                <p style="text-decoration: line-through">
                  <i class="fa-sharp fa-solid fa-fire-extinguisher"></i><span> Fire Extinguisher</span>
                </p>
              </div>
              
              <div class="row">
                <p><i class="fa-solid fa-shower"></i><span> Bathroom</span></p>
              </div>
              
              <div class="row">
                <p>
                  <i class="fa-solid fa-person-running"></i>
                  <span> Emergency Exit</span>
                </p>
              </div>
              
              <div class="row">
                <p>
                  <i class="fa-solid fa-bed"></i>
                  <span> 1 Small Single Bed</span>
                </p>
              </div>
              
              <div class="row">
                <p style="text-decoration: line-through">
                  <i class="fa-solid fa-arrows-left-right"></i>
                  <span> Roof Deck</span>
                </p>
              </div>

            </div>

            
          </div>
      </div>
      <?php  }?>

      <div class="col-md-5 text-center" >
        
        <div class="row justify-content-between">
          <div class="col-6 col-md-6 mt-3 d-flex justify-content-start amenitiesTitle">
            Single Room
          </div>

          <div class="col-5 col-md-6 mt-3 d-flex justify-content-end amenitiesTitle" >
            ₱5000
          </div>
        </div>

        <div class="row mt-3">
          <div class="col-md-6 description">
            <div class="row">
              <p><i class="fa solid fa-grip"></i><span> Cabinet</span></p>
            </div>

            <div class="row">
              <p style="text-decoration: line-through">
                <i class="fa-solid fa-fan"></i><span> Aircon</span>
              </p>
            </div>
            
            <div class="row">
              <p><i class="fa-solid fa-bath"></i><span> CR</span></p>
            </div>
            
            <div class="row">
              <p>
                <i class="fa-solid fa-person-running"></i>
                <span> Emergency Exit</span>
              </p>
            </div>
            
            <div class="row">
              <p>
                <i class="fa-solid fa-bed"></i>
                <span> 1 Small Single Bed</span>
              </p>
            </div>
            
            <div class="row">
              <p style="text-decoration: line-through">
                <i class="fa-solid fa-arrows-left-right"></i>
                <span> Roof Deck</span>
              </p>
            </div>

          </div>

          <div class="col-md-6  description">
            <div class="row">
              <p><i class="fa solid fa-grip"></i><span> Cabinet</span></p>
            </div>

            <div class="row">
              <p style="text-decoration: line-through">
                <i class="fa-solid fa-fan"></i><span> Aircon</span>
              </p>
            </div>
            
            <div class="row">
              <p><i class="fa-solid fa-bath"></i><span> CR</span></p>
            </div>
            
            <div class="row">
              <p>
                <i class="fa-solid fa-person-running"></i>
                <span> Emergency Exit</span>
              </p>
            </div>
            
            <div class="row">
              <p>
                <i class="fa-solid fa-bed"></i>
                <span> 1 Small Single Bed</span>
              </p>
            </div>
            
            <div class="row">
              <p style="text-decoration: line-through">
                <i class="fa-solid fa-arrows-left-right"></i>
                <span> Roof Deck</span>
              </p>
            </div>

          </div>

          
        </div>
      </div>


    </div>

    <div class="row column-gap-3 justify-content-center ">
      
      <div class="col-md-5 text-center" >
        
          <div class="row justify-content-between">
            <div class="col-6 col-md-6 mt-3 d-flex justify-content-start amenitiesTitle">
              Single Room
            </div>

            <div class="col-5 col-md-6 mt-3 d-flex justify-content-end amenitiesTitle" >
              ₱5000
            </div>
          </div>

          <div class="row mt-3">
            <div class="col-md-6 description">
              <div class="row">
                <p><i class="fa solid fa-grip"></i><span> Cabinet</span></p>
              </div>

              <div class="row">
                <p style="text-decoration: line-through">
                  <i class="fa-solid fa-fan"></i><span> Aircon</span>
                </p>
              </div>
              
              <div class="row">
                <p><i class="fa-solid fa-bath"></i><span> CR</span></p>
              </div>
              
              <div class="row">
                <p>
                  <i class="fa-solid fa-person-running"></i>
                  <span> Emergency Exit</span>
                </p>
              </div>
              
              <div class="row">
                <p>
                  <i class="fa-solid fa-bed"></i>
                  <span> 1 Small Single Bed</span>
                </p>
              </div>
              
              <div class="row">
                <p style="text-decoration: line-through">
                  <i class="fa-solid fa-arrows-left-right"></i>
                  <span> Roof Deck</span>
                </p>
              </div>

            </div>

            <div class="col-md-6  description">
              <div class="row">
                <p><i class="fa solid fa-grip"></i><span> Cabinet</span></p>
              </div>

              <div class="row">
                <p style="text-decoration: line-through">
                  <i class="fa-solid fa-fan"></i><span> Aircon</span>
                </p>
              </div>
              
              <div class="row">
                <p><i class="fa-solid fa-bath"></i><span> CR</span></p>
              </div>
              
              <div class="row">
                <p>
                  <i class="fa-solid fa-person-running"></i>
                  <span> Emergency Exit</span>
                </p>
              </div>
              
              <div class="row">
                <p>
                  <i class="fa-solid fa-bed"></i>
                  <span> 1 Small Single Bed</span>
                </p>
              </div>
              
              <div class="row">
                <p style="text-decoration: line-through">
                  <i class="fa-solid fa-arrows-left-right"></i>
                  <span> Roof Deck</span>
                </p>
              </div>

            </div>

            
          </div>
      </div>
      

      <div class="col-md-5 text-center" >
        
        <div class="row justify-content-between">
          <div class="col-6 col-md-6 mt-3 d-flex justify-content-start amenitiesTitle">
            Single Room
          </div>

          <div class="col-5 col-md-6 mt-3 d-flex justify-content-end amenitiesTitle" >
            ₱5000
          </div>
        </div>

        <div class="row mt-3">
          <div class="col-md-6 description">
            <div class="row">
              <p><i class="fa solid fa-grip"></i><span> Cabinet</span></p>
            </div>

            <div class="row">
              <p style="text-decoration: line-through">
                <i class="fa-solid fa-fan"></i><span> Aircon</span>
              </p>
            </div>
            
            <div class="row">
              <p><i class="fa-solid fa-bath"></i><span> CR</span></p>
            </div>
            
            <div class="row">
              <p>
                <i class="fa-solid fa-person-running"></i>
                <span> Emergency Exit</span>
              </p>
            </div>
            
            <div class="row">
              <p>
                <i class="fa-solid fa-bed"></i>
                <span> 1 Small Single Bed</span>
              </p>
            </div>
            
            <div class="row">
              <p style="text-decoration: line-through">
                <i class="fa-solid fa-arrows-left-right"></i>
                <span> Roof Deck</span>
              </p>
            </div>

          </div>

          <div class="col-md-6  description">
            <div class="row">
              <p><i class="fa solid fa-grip"></i><span> Cabinet</span></p>
            </div>

            <div class="row">
              <p style="text-decoration: line-through">
                <i class="fa-solid fa-fan"></i><span> Aircon</span>
              </p>
            </div>
            
            <div class="row">
              <p><i class="fa-solid fa-bath"></i><span> CR</span></p>
            </div>
            
            <div class="row">
              <p>
                <i class="fa-solid fa-person-running"></i>
                <span> Emergency Exit</span>
              </p>
            </div>
            
            <div class="row">
              <p>
                <i class="fa-solid fa-bed"></i>
                <span> 1 Small Single Bed</span>
              </p>
            </div>
            
            <div class="row">
              <p style="text-decoration: line-through">
                <i class="fa-solid fa-arrows-left-right"></i>
                <span> Roof Deck</span>
              </p>
            </div>

          </div>

          
        </div>
    </div>


    </div>

  </div>

  <!-- End of Room Amenities under Property Information -->
</div>




<!-- Start of Google Map under Property Information -->

<div class="container pt-5">
  <div class="row">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d962.807197098562!2d120.59276596960956!3d15.145774899088007!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3396f313262cc467%3A0xa12b7889c166e418!2sJaeden%20Kent%20Residence%20%2F%20Batac%20-Valencia!5e0!3m2!1sen!2sph!4v1690310871739!5m2!1sen!2sph" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
  </div>
</div>

<!-- End of Google Map under Property Information -->

<!-- Start of Reviews under Property Information -->

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
                    <?php
                        $reviews = new Review();
                        $reviews->setConnection($connection);
                        $getReviews = $reviews->getReviews($property_id);
                        foreach($getReviews as $review){ 
                    ?> 
                    <!-- Item1 Starts -->
                    <div class="item testimonial-card">
                        <main class="test-card-body">
                          <div class="profile">
                            <div class="profile-image">
                                <img src="images/prof1.png">
                            </div>
                            <div class="profile-desc">
                                <span><?= $review['first_name'] . ' ' . $review['last_name']?></span>
                                <span class="ratings">
                                  <i class="fa-solid fa-star"></i>
                                  <i class="fa-solid fa-star"></i>
                                  <i class="fa-solid fa-star"></i>
                                  <i class="fa-solid fa-star"></i>
                                  <i class="fa-solid fa-star"></i>
                                  <i class="num"><?= $rating ?></i>
                                </span>
                                <span class="date"><?= $review_date ?></span>
                            </div>
                          </div>
                            <div class="quote">
                                <i class="fa fa-quote-left"></i>
                            </div>
                            <p><?= $review['description']?></p>
                        </main>

                    </div>
                    <!-- Item1 Ends -->
            
                    <?php } ?>
            
                </div>
                <!-- Owl Carousel Slider Ends -->
            
            </div>

            
    </div>
  </div>
</div>
  
  <!-- End of Reviews under Property Information -->



  <!-- Start of Similar Apartment Listings -->

    <!-- <div class="container-fluid featuredHtml"> -->
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
                      <a href="view_property.html" class="btnView">View property</a>
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
                      <a href="view_property.html" class="btnView">View property</a>
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
                      <a href="view_property.html" class="btnView">View property</a>
                    </div>
                  </div>

                </div>
              </div>
            </div>

          </div>

          <div style="margin-top: 4rem; text-align: center">
            <a href="accomodations.html" class="inline-btn">View All</a>
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
  <div class="modal fade" id="requestVisit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="requestVisitLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg overflow-x-hidden ">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-3" id="requestVisitLabel">Schedule a Visit</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body overflow-x-hidden  modalTimeslots">

          <div class="container">

            <form>
              <!-- Form start -->
              <div class="container pt-5 pb-5 bgTimeSlots timeSlots">

                <div class="row">
                  <h3 class="text-center">View the property on</h3>
                  <div class="col-md">
                    <h2 class="ms-3 apptDate">August 04, 2023</h2>
                  </div>
                </div>

                <div class="row justify-content-center">

                  
                  <div class="col-md-4">

                    <form action="#">
                      <div class="form-group p-3 datePicker">
                        <input type="date" class="form-control" id="pick-date" placeholder="Pick A Date">
                      </div>
                      
                      <h5 class="text-center">*Click to change date</h5>
                    </form>

                  </div>
                </div>


                <div class="row ps-4 h3 mt-2">
                  <h2 class="dayzone">
                    <img src="images/dayzone1.png" alt=""/>
                    Morning
                  </h2>
                  <h2 class="timezone">8:00 AM to 11:30 AM</h2>
                </div>
                
                  <div class="row pt-5 justify-content-center">
        
                      <div class="col-5 col-sm-3 col-lg-2  d-flex justify-content-center"><a class="btn btn-outline-secondary disabled" data-bs-toggle="modal" data-bs-target="#modal" role="button"><i class="fa-regular fa-clock"></i> 8:00 AM </a></div>
                      
                      <div class="col-5 col-sm-3 col-lg-2 d-flex justify-content-center"><a class="btn btn-outline-secondary disabled" data-bs-toggle="modal" data-bs-target="#modal" role="button"><i class="fa-regular fa-clock"></i> 8:30 AM </a></div>
        
                      <div class="col-5 col-sm-3 col-lg-2 mt-3 mt-sm-0 d-flex justify-content-center"><a class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modal" role="button"><i class="fa-regular fa-clock"></i> 9:00 AM </a></div>
                      
                      <div class="col-5 col-sm-3 col-lg-2 mt-3 mt-sm-0 d-flex justify-content-center"><a class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modal" role="button"><i class="fa-regular fa-clock"></i> 9:30 AM </a></div>
        
                  </div>
                  <div class="row pt-5 pb-5 justify-content-center">
        
                    <div class="col-5 col-sm-3 col-lg-2  d-flex justify-content-center"><a class="btn btn-outline-secondary disabled" data-bs-toggle="modal" data-bs-target="#modal" role="button"><i class="fa-regular fa-clock"></i>  10:00 AM </a></div>
                      
                    <div class="col-5 col-sm-3 col-lg-2 d-flex justify-content-center"><a class="btn btn-outline-secondary disabled" data-bs-toggle="modal" data-bs-target="#modal" role="button"><i class="fa-regular fa-clock"></i> 10:30 AM </a></div>
        
                    <div class="col-5 col-sm-3 col-lg-2 mt-3 mt-sm-0 d-flex justify-content-center"><a class="btn btn-outline-secondary disabled" data-bs-toggle="modal" data-bs-target="#modal" role="button"><i class="fa-regular fa-clock"></i> 11:00 AM </a></div>
                      
                    <div class="col-5 col-sm-3 col-lg-2 mt-3 mt-sm-0 d-flex justify-content-center"><a class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modal" role="button"><i class="fa-regular fa-clock"></i> 11:30 AM </a></div>
        
                  </div>
                
                <div class="row ps-4 h3 mt-5">
                  <hr>
                  <h2 class="dayzone pt-4">
                    <img src="images/dayzone2.png" alt=""/>
                    Afternoon
                  </h2>
                  <h2 class="timezone">1:00 PM to 5:30 PM</h2>
                </div>
                  <div class="row pt-5 justify-content-center">
        
                    <div class="col-5 col-sm-3 col-lg-2  d-flex justify-content-center"><a class="btn btn-outline-secondary disabled" data-bs-toggle="modal" data-bs-target="#modal" role="button"><i class="fa-regular fa-clock"></i> 12:00 PM </a></div>
                    
                    <div class="col-5 col-sm-3 col-lg-2 d-flex justify-content-center"><a class="btn btn-outline-secondary disabled" data-bs-toggle="modal" data-bs-target="#modal" role="button"><i class="fa-regular fa-clock"></i> 12:30 PM </a></div>
        
                    <div class="col-5 col-sm-3 col-lg-2 mt-3 mt-sm-0 d-flex justify-content-center"><a class="btn btn-outline-secondary disabled" data-bs-toggle="modal" data-bs-target="#modal" role="button"><i class="fa-regular fa-clock"></i> 1:00 PM </a></div>
                    
                    <div class="col-5 col-sm-3 col-lg-2 mt-3 mt-sm-0 d-flex justify-content-center"><a class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modal" role="button"><i class="fa-regular fa-clock"></i> 1:30 PM </a></div>
        
                  </div>
                  <div class="row pt-5 justify-content-center">
        
                    <div class="col-5 col-sm-3 col-lg-2  d-flex justify-content-center"><a class="btn btn-outline-secondary disabled" data-bs-toggle="modal" data-bs-target="#modal" role="button"><i class="fa-regular fa-clock"></i> 2:00 PM </a></div>
                    
                    <div class="col-5 col-sm-3 col-lg-2 d-flex justify-content-center"><a class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modal" role="button"><i class="fa-regular fa-clock"></i> 2:30 PM </a></div>
        
                    <div class="col-5 col-sm-3 col-lg-2 mt-3 mt-sm-0 d-flex justify-content-center"><a class="btn btn-outline-secondary disabled" data-bs-toggle="modal" data-bs-target="#modal" role="button"><i class="fa-regular fa-clock"></i> 3:00 PM </a></div>
                    
                    <div class="col-5 col-sm-3 col-lg-2 mt-3 mt-sm-0 d-flex justify-content-center"><a class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modal" role="button"><i class="fa-regular fa-clock"></i> 3:30 PM </a></div>
        
                  </div>
                  <div class="row pt-5 justify-content-center">
        
                    <div class="col-5 col-sm-3 col-lg-2  d-flex justify-content-center"><a class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modal" role="button"><i class="fa-regular fa-clock"></i> 4:00 PM </a></div>
                    
                    <div class="col-5 col-sm-3 col-lg-2 d-flex justify-content-center"><a class="btn btn-outline-secondary disabled" data-bs-toggle="modal" data-bs-target="#modal" role="button"><i class="fa-regular fa-clock"></i> 4:30 PM </a></div>
        
                    <div class="col-5 col-sm-3 col-lg-2 mt-3 mt-sm-0 d-flex justify-content-center"><a class="btn btn-outline-secondary disabled" data-bs-toggle="modal" data-bs-target="#modal" role="button"><i class="fa-regular fa-clock"></i> 5:00 PM </a></div>
                    
                    <div class="col-5 col-sm-3 col-lg-2 mt-3 mt-sm-0 d-flex justify-content-center"><a class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#modal" role="button"><i class="fa-regular fa-clock"></i> 5:30 PM </a></div>
        
                  </div>
              </div>
          </form>
          <!-- form end -->

          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Reserve a Room Modal -->

  <!-- Modal -->
  <div class="modal fade" id="reserveRoom" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="reserveRoomLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-3" id="reserveRoomLabel">Reservation</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body modalReserveroom">

          <div class="container">

            <form>
              <!-- Form start -->
              <div class="container pt-5 pb-5 bgReserveroom reserveRoomType">

                <div class="row">
                  <h3 class="text-center">Reserve a Room</h3>
                  <div class="col-md">
                    <h2 class="apptDate">August 04, 2023</h2>
                  </div>
                </div>

                <div class="row justify-content-center mt-2">
                  <div class="col-md-6">

                    <form action="#">
                      
                      <div class="row mt-2">
                        <div class="col-12">
                          <label class="radio w-100">
                            <input type="radio" name="add" value="1 bed | ₱5,000" checked />
                            <div
                              class="row justify-content-between p-3 radioRoomType" id="pickRoomType">
                              <div class="col-8">
                                  <span class="roomTypeName">Single Room</span>
                                <div class="row">
                                  <span class="roomTypeDetails">1 bed | ₱5,000</span>
                                </div>
                              </div>
                      
                              <div class="col-3">
                                <i class="fa-solid fa-bed fa-4x float-end"></i>
                              </div>
                            </div>
                          </label>
                        </div>
                      </div>
                      

                      <div class="row mt-2">
                        <div class="col-12">
                          <label class="radio w-100">
                            <input type="radio" name="add" value="1 bed | ₱5,000"/>
                            <div
                              class="row justify-content-between p-3 radioRoomType" id="pickRoomType">
                              <div class="col-8">
                                  <span class="roomTypeName">2-bed Room</span>
                                <div class="row">
                                  <span class="roomTypeDetails">2 bed | ₱5,800</span>
                                </div>
                              </div>
                      
                              <div class="col-3">
                                <i class="fa-solid fa-bed fa-4x float-end"></i>
                              </div>
                            </div>
                          </label>
                        </div>
                      </div>

                      <div class="row mt-2">
                        <div class="col-12">
                          <label class="radio w-100">
                            <input type="radio" name="add" value="1 bed | ₱5,000" />
                            <div
                              class="row justify-content-between p-3 radioRoomType" id="pickRoomType">
                              <div class="col-8">
                                  <span class="roomTypeName">3-bed Room</span>
                                <div class="row">
                                  <span class="roomTypeDetails">3 bed | ₱6,000</span>
                                </div>
                              </div>
                      
                              <div class="col-3">
                                <i class="fa-solid fa-bed fa-4x float-end"></i>
                              </div>
                            </div>
                          </label>
                        </div>
                      </div>

                      <div class="row mt-2">
                        <div class="col-12">
                          <label class="radio w-100">
                            <input type="radio" name="add" value="1 bed | ₱5,000" />
                            <div
                              class="row justify-content-between p-3 radioRoomType" id="pickRoomType">
                              <div class="col-8">
                                  <span class="roomTypeName">4-bed Room</span>
                                <div class="row">
                                  <span class="roomTypeDetails">4 bed | ₱7,000</span>
                                </div>
                              </div>
                      
                              <div class="col-3">
                                <i class="fa-solid fa-bed fa-4x float-end"></i>
                              </div>
                            </div>
                          </label>
                        </div>
                      </div>
                        
                      </form>

                  </div>
                  
                </div>





              </div>
          </form>
          <!-- form end -->

          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </div>
  </div>


    


  </body>

  <!-- javascript -->
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
    crossorigin="anonymous"
  ></script>

  <script src="js/accommodations.js"></script>
  

  <!-- JS of Carousel -->

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

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

              
    <!--   *****   JQuery Link   *****   -->
    
    <!--   *****   Owl Carousel js Link  *****  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

    <!-- modal jquery link -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>


</html>
