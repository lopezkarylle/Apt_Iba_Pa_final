<?php
use Models\Property;
use Models\Amenity;
use Models\Room;
use Models\RoomAmenity;
use Models\Image;
use Models\Review;
include ("init.php");
include ("session.php");

    $user_id = $_SESSION['user_id'] ?? NULL;
    $property_id = $_POST['property_id'];
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
    $postal_code = $details['postal_code'];
	$latitude = $details['latitude'];
	$longitude = $details['longitude'];

    $amenities_array = $details['amenity_name'];
    $property_amenities = explode(",", $amenities_array);

    $full_address = $property_number . ' ' . $street . ', ' . $barangay . '
     ' . $city . ' ' . $province;

    //landlord information
	$first_name = $details['first_name'];
	$last_name = $details['last_name'];
    
    //property amenities
    $propertyAmenities = array("wifi","parking","reception","food hall","lounge","study area","laundromat","elevator","drinking water","microwave","refrigerator","tv","roof deck","sink","security","cctv","fire exit"); //can be from csv
    
    //room amenities
    $roomAmenities = array("aircon","cushion","drinking water","refrigerator","electric fan","wifi","cabinet","tv"); //can be from csv

    //get all rooms of property
	$room = new Room();
	$room->setConnection($connection);
	$rooms = $room->getRooms($property_id);

    //get all images
    $images = new Image();
    $images->setConnection($connection);
    $images = $images->getImages($property_id);
    
    
    echo"<br>";
    //each room information
    
    
?>
<!-- header -->
<h2>Header</h2>
<ul class="nav nav-pills nav-justified">
    <li class="active"><a href="index.php">Dashboard</a></li>
    <li><a  href="accommodations.php">Accommodations</a></li>
    <li><a  href="about.php">About Us</a></li>
</ul>
    <a href="apply.php">Apply My Property</a><br>
    <?php if(isset($user_id)) {?>
    <h2><?php echo 'Hi ' . $full_name ?></h2>
    <a href="logout.php">Logout</a>
    <?php } else {?>
    <a href="login.php">Login</a>
    <?php }?>
  </nav>

<!-- end of header -->

<!-- Property Information -->
<h2>Property Information</h2><br>
<h1><?php echo $property_name ?></h1>
<div>
    <?php foreach($images as $img){
        $image = $img['image_path'];
        $title = $img['title'];
    ?>
        <img src='resources/images/properties/<?php echo $image ?>' name="image" height='100' width='100'>
        <label for="image"><?php echo $title ?></label>
        <div>
    <?php } ?>
</div>
<div>
    <h2><?php echo $property_name ?></h2>
    <div><?php echo $full_address ?></div>
    <br>
    <h4>Description</h4>
    <div><?php echo $description ?></div>
</div>
<div>
    <form action="appointment.php" method="POST">
        <input type="hidden" name="property_id" value="<?php echo $property_id ?>">
        <button type="input" name="appointment" disabled>Set Appointment</button>
    </form>
    <form action="reserve.php" method="POST">
        <input type="hidden" name="property_id" value="<?php echo $property_id ?>">
        <button type="input" name="reserve" disabled>Reserve a Room</button>
    </form>
</div>
<div>
    <h4>Rent start at </h4>
    <h2>₱<?php echo $lowest_rate ?></h2>
</div>
<div>
    <h4>Property Amenities</h4>
    <?php 
    foreach($propertyAmenities as $amenity) {
        $is_available = in_array($amenity, $property_amenities);
    ?>
        <input type="checkbox" id="amenities" name="amenities[]"  value="<?= $amenity?>" <?php echo $is_available ? 'checked' : '' ?>>
        <label for="" class="control-label"><?= $amenity?></label><br>
    <?php } ?>
</div>
<div>
    <h4>Rooms</h4>
    <?php
        $room_types = [
            '1' => 'Single Bed Room',
            '2' => 'Double Bed Room',
            '3' => 'Triple Bed Room',
            '4' => 'Quad Bed Room',
            '5' => 'Five Bed Room',
            '6' => 'Six Bed Room',
            '7' => 'Seven Bed Room',
            '8' => 'Eight Bed Room',
          ];
          
          foreach($rooms as $roomie){
            $room_id = $roomie['room_id'];
    
            $room_amenity = new RoomAmenity('','','');
            $room_amenity->setConnection($connection);
            $room_amenity = $room_amenity->getAmenities($room_id);
    
            $room_amenities_array = $room_amenity['amenity_name'];
            $room_amenities = explode(",", $room_amenities_array);
            
            $room_type = $roomie['room_type'];
            $room_type = $room_types[$room_type] ?: 'Single Bed Room';
            
            $monthly_rent = $roomie['monthly_rent'];
            $total_beds = $roomie['total_beds'];
            $occupied_beds = $roomie['occupied_beds'];
    
            $available_beds = $total_beds - $occupied_beds;
        }
    ?>
    <h5><?php echo $room_type ?></h5>
    <h5>₱<?php echo $monthly_rent ?></h5>
    <h5>Available beds: <?php echo $available_beds ?></h5>
    <span>
        <?php 
        foreach($roomAmenities as $roomAmenity) {
            $is_available = in_array($roomAmenity, $room_amenities);
        ?>
            <input type="checkbox" name="roomAmenities[]"  value="<?= $roomAmenity?>" <?php echo $is_available ? 'checked' : '' ?>>
            <label for="" class="control-label"><?= $roomAmenity?></label><br>
        <?php } ?>
    </span>
</div>
<div>
    <h4>Map</h4>
</div>
<div>
    <h4>Reviews</h4>
</div>
