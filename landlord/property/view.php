<?php

use Models\Property;
use Models\Amenity;
use Models\Rule;
use Models\Room;
use Models\RoomAmenity;
use Models\Request;
use Models\User;
use Models\Image;
use Models\Review;

include "../../init.php";
include ("session.php");

if(isset($_POST['property_id']) || isset($_SESSION['property_id'])){

    if(!isset($_SESSION['property_id'])){
    $_SESSION['property_id'] = $_POST['property_id'];
    }
    $landlords = new User('','','','','','');
    $landlords->setConnection($connection);
    $landlords = $landlords->getLandlords();

    $property_id = $_SESSION['property_id'];
    $property = new Property();
    $property->setConnection($connection);
    $details = $property->getPropertyDetails($property_id);

    $property_type = $details['property_type'];
    $property_name = $details['property_name'];
    $landlord_id = $details['landlord_id'];
    $total_rooms = $details['total_rooms'];
    $total_floors = $details['total_floors'];
    $description = $details['description'];
    $property_number = $details['property_number'];
    $street = $details['street'];
    $region = $details['region'];
    $province = $details['province'];
    $city = $details['city'];
    $barangay = $details['barangay'];
    $postal_code = $details['postal_code'];
    $latitude = $details['latitude'];
    $longitude = $details['longitude'];
    $reservation = $details['reservation_fee'];
    $deposit = $details['advance_deposit'];
    $lowest_rate = $details['lowest_rate'];
    $first_name = $details['first_name'];
    $last_name = $details['last_name'];
    $full_name = $first_name . ' ' . $last_name;

    $amenity = new Amenity('','','');
    $amenity->setConnection($connection);
    $amenities = $amenity->getAmenities($property_id);

    if($amenities){
        $amenities_csv = $amenities['amenity_name'];
        $amenities_array = explode(",", $amenities_csv);
    }
    else {
        $amenities_array = array();
    }

    $room = new Room('','','','','','');
    $room->setConnection($connection);
    $rooms = $room->getRooms($property_id);
} else {
    echo "<script>window.location.href='index.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<title><?= $property_name ?></title>
</head>
<body>
<div class="container-fluid">
<nav>
<div class="container-fluid">
<ul class="nav nav-pills nav-justified">
  <li style="background-color: #FFF8DC"><a  href="../index.php">Dashboard</a></li>
  <li style="background-color: #FAF0E6"><a  href="../landlord/index.php">Manage Landlords</a></li>
  <li style="background-color: #FFFAF0"><a  href="../user/index.php">Manage Users</a></li>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <li class="active" style="background-color: #FFFACD"><a  href="index.php">Manage Properties</a></li>
  <li style="background-color: #FAFAF0"><a  href="../application-request/index.php">Application Requests</a></li>
</ul>
<a href="../../logout.php">Logout</a>
</nav>

<div class="container-fluid">
	<form action="view.php" method="POST" id="property-form">
        <input type="hidden" name="property_id" value="<?= $property_id ?>">
		<div class="row form-group">
            <div class="col-md-4">
				<label for="landlord_id" class="control-label">Assign Landlord</label>
				<select name="landlord_id" class="form-control form-control-md" id="landlord_id" required>
                    <option value="<?= $landlord_id ?>" selected><?= $full_name ?></option>
                    <?php foreach($landlords as $landlord){ ?>
                    <option value="<?php echo $landlord['user_id']?>"><?php echo $landlord['first_name'] . ' ' . $landlord['last_name']?></option>
                    <?php } ?>
                </select>
			</div>
            <div class="col-md-4">
				<label for="property_type" class="control-label">Property Type</label>
				<select name="property_type" class="form-control form-control-md" id="property_type" required>
                    <option value="<?= $property_type ?>" selected><?= $property_type ?></option>
                    <option value="Apartment">Apartment</option>
                    <option value="Dormitory">Dormitory</option>
                </select>
			</div>
            <div class="col-md-4">
				<label for="property_name" class="control-label">Property Name</label>
				<input type="text" class="form-control" id="property_name" name="property_name" value="<?= $property_name ?>" required>
			</div>
            <div class="col-md-4">
				<label for="property_number" class="control-label">Lot Number</label>
				<input type="text" class="form-control" id="property_number" name="property_number" value="<?= $property_number ?>" required>
			</div>
            <div class="col-md-4">
				<label for="street" class="control-label">Street</label>
				<input type="text" class="form-control" id="street" name="street" value="<?= $street ?>"required>
			</div>
            <div class="col-md-4">
				<label for="region" class="control-label">Region - <?php echo isset($region) ? $region : '' ?></label>
				<select name="region" class="form-control form-control-md" id="region"></select>
                <input type="hidden" class="form-control form-control-md" name="region_text" id="region-text" value="<?php echo isset($region) ? $region : '' ?>" required>
			</div>
            <div class="col-md-4">
				<label for="province" class="control-label">Province - <?php echo isset($province) ? $province : '' ?></label>
				<select name="province" class="form-control form-control-md" id="province"></select>
                <input type="hidden" class="form-control form-control-md" name="province_text" id="province-text" value="<?php echo isset($province) ? $province : '' ?>" required>
			</div>
            <div class="col-md-4">
				<label for="city" class="control-label">City / Municipality - <?php echo isset($city) ? $city : '' ?></label>
				<select name="city" class="form-control form-control-md" id="city"></select>
                <input type="hidden" class="form-control form-control-md" name="city_text" id="city-text" value="<?php echo isset($city) ? $city : '' ?>" required>
			</div>
            <div class="col-md-4">
				<label for="barangay" class="control-label">Barangay - <?php echo isset($barangay) ? $barangay : '' ?></label>
				<select name="barangay" class="form-control form-control-md" id="barangay"></select>
                <input type="hidden" class="form-control form-control-md" name="barangay_text" id="barangay-text" value="<?php echo isset($barangay) ? $barangay : '' ?>" required>
			</div>
            <div class="col-md-4">
				<label for="postal_code" class="control-label">Postal Code</label>
				<input type="text" class="form-control" name="postal_code" id="postal_code" value="<?= $postal_code ?>" required>
			</div>
		</div>
		<div class="form-group row">
            <div class="col-md-4">
				<label for="total_floors" class="control-label">How many floors in total?</label>
				<input type="number" min="0" class="form-control" id="total_floors" name="total_floors" value="<?= $total_floors ?>" required>
			</div>
            <div class="col-md-4">
				<label for="total_rooms" class="control-label">How many rooms in total?</label>
				<input type="text" class="form-control" id="total_rooms" name="total_rooms" value="<?= $total_rooms ?>"required>
			</div>
            <div class="col-md-4">
				<label for="description" class="control-label">Describe your property.</label>
				<textarea type="text" class="form-control" id="description" name="description" required><?= $description ?></textarea>
			</div>
		</div>
        
        <div class="form-group row">
            <div class="col-md-4">
				<label for="reservation_fee" class="control-label">Reservation fee</label>
				<input type="text" class="form-control" name="reservation_fee" id="reservation_fee" value="<?= $reservation ?>" required>
			</div>
            <div class="col-md-4">
				<label for="advance_deposit" class="control-label">Advance deposit</label>
				<input type="text" class="form-control" name="advance_deposit" id="advance_deposit" value="<?= $deposit ?>" required>
			</div>
            <div class="col-md-4">
				<label for="lowest_rate" class="control-label">Lowest Rate</label>
				<input type="text" class="form-control" name="lowest_rate" id="lowest_rate" value="<?= $lowest_rate ?>" required>
			</div>
		</div>
        <div class="form-group row">
            <div class="col-md-4">
                    <label for="" class="control-label">What amenities does your property offer?</label>

                    <?php 
                    $availableAmenities = array("wifi","parking","reception","food hall","lounge","study area","laundromat","elevator","drinking water","microwave","refrigerator","tv","roof deck","sink","security","cctv","fire exit");
                    foreach($availableAmenities as $amenity) {
                        $is_available = in_array($amenity, $amenities_array);
                    ?>
                        <input type="checkbox" id="amenities" name="amenities[]"  value="<?= $amenity?>" <?php echo $is_available ? 'checked' : '' ?>>
                        <label for="" class="control-label"><?= $amenity?></label><br>
                    <?php } ?>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-4">
                        <!-- View and Edit Rooms -->
            <?php foreach($rooms as $room){
                $room_id = $room['room_id'];
                $roomAmenity = new RoomAmenity('','','');
                $roomAmenity->setConnection($connection);
                $roomAmenities = $roomAmenity->getAmenities($room_id);

                if($roomAmenities){
                    $roomAmenities_csv = $roomAmenities['amenity_name'];
                    $roomAmenities_array = explode(",", $roomAmenities_csv);
                }
                else {
                    $roomAmenities_array = array();
                }?>
            <div name="amenities_checkbox" id="room_amenities"> 
            <h2><?= $room['total_beds'] ?> beds</h2>
            <h3></h3>
            <select id="furnished_type" name="furnished_type">
                <option value="<?= $room['furnished_type'] ?>" selected disabled><?= $room['furnished_type'] ?></option>
                <option value="Furnished">Furnished</option>
                <option value="Semi-furnished">Semi-furnished</option>
                <option value="Unfurnished">Unfurnished</option>
            </select>
                    <input type="hidden" name="room_id" value="<?php echo isset($room_id) ? $room_id : '' ?>">
                    <div class="row form-group">
                        <div class="col-md-4">
                        <?php 
                        $availableAmenities = array("aircon","cushion","drinking water","refrigerator","electric fan","wifi");
                        
                        foreach($availableAmenities as $roomAmenity) {
                            $is_available = in_array($roomAmenity, $roomAmenities_array);
                        ?>
                            <input type="checkbox" name="roomAmenities[]"  value="<?= $roomAmenity?>" <?php echo $is_available ? 'checked' : '' ?>>
                            <label for="" class="control-label"><?= $roomAmenity?></label><br>
                        <?php } ?>
                        </div>
                        </div>
            </div>
            <?php }?>
            </div>
        </div>
        <div class="form-group row">
                <div class="col-md-4">
                        <label for="" class="control-label">Locate your property</label>
                        <!-- <div id='map' style='width: 400px; height: 300px;'></div> -->
                        <input type="hidden" name="latitude" value="15.145113074763598">
                        <input type="hidden" name="longitude" value="120.5950306751359">
                </div>
		</div>

        <button class="btn btn-sm btn-outline-danger" name="update_property" type="submit">Save</button>
	</form>
</div>
<!-- <script src="form-validate.js"></script> -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const newRoomButton = document.getElementById('new-room');
        const showRoomDiv = document.getElementById('show-room');

        newRoomButton.addEventListener('click', function() {
            if (showRoomDiv.style.display === 'none') {
                showRoomDiv.style.display = 'block';
                newRoomButton.textContent = 'Cancel';
            } else {
                showRoomDiv.style.display = 'none';
                newRoomButton.textContent = 'Add a Room';
            }
        });
    });
</script>
<script src="ph-address-selector.js"></script>
<script src="geo.js"></script>
<script src="room.js"></script>
<script src="map.js"></script>
<script src="rules.js"></script>

</body>

<style>
    .marker {
    background-image: url('mapbox-icon.png');
    background-size: cover;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    cursor: pointer;
    }
    .mapboxgl-popup {
    max-width: 200px;
    }

    .mapboxgl-popup-content {
    text-align: center;
    font-family: 'Open Sans', sans-serif;
    }
</style>
</html>

<?php 
try {
        
    if(isset($_POST['property_id']) && isset($_POST['update_property']) ){

        $property_id = $_POST['property_id'];
        $property_type = $_POST['property_type']; 
        $property_name = ucfirst($_POST['property_name']); 
        $landlord_id = $_POST['landlord_id']; 
        $total_rooms = $_POST['total_rooms'];
        $total_floors = $_POST['total_floors'];
        $description = $_POST['description'];
        $property_number = $_POST['property_number'];
        $street = ucfirst($_POST['street']);
        $region_text = $_POST['region_text'];
        $province_text = $_POST['province_text'];
        $city_text = $_POST['city_text'];
        $barangay_text = $_POST['barangay_text'];
        $postal_code = $_POST['postal_code'];
        $latitude = $_POST['latitude'];
        $longitude = $_POST['longitude'];
        $reservation_fee = $_POST['reservation_fee'];
        $advance_deposit = $_POST['advance_deposit'];
        $lowest_rate = $_POST['lowest_rate'];
        // $rent = $_POST['monthly_rent'];
        // foreach($rent as $rate){
        //     if((intval($rate))>=(intval($lowest_rate))){
        //         $lowest_rate = $rate;
        //     }
        // }
        //Update apt_properties, apt_property_details, apt_property_locations
        
        //var_dump($property_id, $property_type, $property_name, $landlord_id, $total_rooms,$total_floors,$description,$property_number,$street,$region_text,$province_text,$city_text,$barangay_text,$postal_code,$latitude,$longitude,$lowest_rate,$reservation_fee,$advance_deposit);
        
        $property = new Property();
        $property->setConnection($connection);
        $property = $property->updateProperty($property_id, $property_type, $property_name, $landlord_id, $total_rooms,$total_floors,$description,$property_number,$street,$region_text,$province_text,$city_text,$barangay_text,$postal_code,$latitude,$longitude,$lowest_rate,$reservation_fee,$advance_deposit);
        
    //     //add to property amenities table but status=2=pending
        $amenities = $_POST['amenities'];
        $amenities_csv = implode(",", $amenities);
        $status = 1;

        $property_amenities = new Amenity('','','');
        $property_amenities->setConnection($connection);
        $property_amenities->updateAmenities($property_id, $amenities_csv);

    //     //add to property rules table but status=2=pending
    //     $status = 1;
    //     $rules = new Rule($property_id, $_POST['short_term'], $_POST['min_weeks'], $_POST['mix_gender'], $_POST['curfew'], $_POST['from_curfew'], $_POST['to_curfew'], $_POST['cooking'], $_POST['pets'], $_POST['visitors'],$status);
    //     $rules->setConnection($connection);
    //     $rules->addRules();

    //     //add to rooms table but status=2=pending
    //     $beds = $_POST['total_beds']; 
    //     $rent = $_POST['monthly_rent']; 
    //     $type = $_POST['furnished_type']; 
    //     $occupied_beds = 0;

    //     $selected_amenities = $_POST['selected_amenities'];
    //     $amenities = json_decode($selected_amenities, true); 

    //         for ($x = 0; $x < (count($beds)); $x++) {
    //             $total_beds = $beds[$x];
    //             $monthly_rent = $rent[$x];
    //             $furnished_type = $type[$x];
    //             $status = 1;
                
    //             $room = new Room($property_id, $total_beds, $occupied_beds, $furnished_type, $monthly_rent, $status);
    //             $room->setConnection($connection);
    //             $room_id = $room->addRoom();

    //             $room_amenities = $amenities[$x];
    //             $room_amenities_csv = implode(",", $room_amenities);

    //             $room_amenities = new RoomAmenity($room_id, $room_amenities_csv, $status);
    //             $room_amenities->setConnection($connection);
    //             $room_amenities->addRoomAmenities();
    //         }

        echo "<script>window.location.href='view.php';</script>";
        exit();
    } else {
        echo "<script>alert('Failed to add property. Please check your inputs.</script>";
    }
} catch (Exception $e) {
    echo "<script>window.location.href='index.php?error='" . $e->getMessage() . ";</script>";
    exit();
}