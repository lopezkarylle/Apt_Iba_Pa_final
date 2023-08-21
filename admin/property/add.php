<?php

use Models\Property;
use Models\Amenity;
use Models\Rule;
use Models\Room;
use Models\RoomAmenity;
use Models\Request;
use Models\User;

include "../../init.php";
//include ("../../session.php");

$landlords = new User('','','','','','');
$landlords->setConnection($connection);
$landlords = $landlords->getLandlords();
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="style.css">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<title>Add Property</title>
</head>
<body>
<div class="container-fluid">
<nav>
<div class="container-fluid">
<ul class="nav nav-pills nav-justified">
  <li style="background-color: #FFF8DC"><a  href="../index.php">Dashboard</a></li>
  <li style="background-color: #FAF0E6"><a  href="../landlord/index.php">Manage Landlords</a></li>
  <li style="background-color: #FFFAF0"><a  href="../user/index.php">Manage Users</a></li>
  <li class="active" style="background-color: #FFFACD"><a  href="index.php">Manage Properties</a></li>
  <li style="background-color: #FAFAF0"><a  href="../application-request/index.php">Application Requests</a></li>
</ul>
<a href="../../logout.php">Logout</a>
</nav>

<div class="container-fluid">
	<form action="add.php" method="POST" id="property-form">
		<div class="row form-group">
            <div class="col-md-4">
				<label for="landlord_id" class="control-label">Assign Landlord</label>
				<select name="landlord_id" class="form-control form-control-md" id="landlord_id" required>
                    <option value="" selected disabled>Select a landlord</option>
                    <?php foreach($landlords as $landlord){ ?>
                    <option value="<?php echo $landlord['user_id']?>"><?php echo $landlord['first_name'] . ' ' . $landlord['last_name']?></option>
                    <?php } ?>
                </select>
			</div>
            <div class="col-md-4">
				<label for="property_type" class="control-label">Property Type</label>
				<select name="property_type" class="form-control form-control-md" id="property_type" required>
                    <option value="Apartment">Apartment</option>
                    <option value="Dormitory">Dormitory</option>
                </select>
			</div>
            <div class="col-md-4">
				<label for="property_name" class="control-label">Property Name</label>
				<input type="text" class="form-control" id="property_name" name="property_name" required>
			</div>
            <div class="col-md-4">
				<label for="property_number" class="control-label">Lot Number</label>
				<input type="text" class="form-control" id="property_number" name="property_number" required>
			</div>
            <div class="col-md-4">
				<label for="street" class="control-label">Street</label>
				<input type="text" class="form-control" id="street" name="street" required>
			</div>
            <div class="col-md-4">
				<label for="region" class="control-label">Region</label>
				<select name="region" class="form-control form-control-md" id="region" required></select>
                <input type="hidden" class="form-control form-control-md" name="region_text" id="region-text" required>
			</div>
            <div class="col-md-4">
				<label for="province" class="control-label">Province</label>
				<select name="province" class="form-control form-control-md" id="province" required></select>
                <input type="hidden" class="form-control form-control-md" name="province_text" id="province-text" required>
			</div>
            <div class="col-md-4">
				<label for="city" class="control-label">City / Municipality</label>
				<select name="city" class="form-control form-control-md" id="city" required></select>
                <input type="hidden" class="form-control form-control-md" name="city_text" id="city-text" required>
			</div>
            <div class="col-md-4">
				<label for="barangay" class="control-label">Barangay</label>
				<select name="barangay" class="form-control form-control-md" id="barangay" required></select>
                <input type="hidden" class="form-control form-control-md" name="barangay_text" id="barangay-text" required>
			</div>
            <div class="col-md-4">
				<label for="postal_code" class="control-label">Postal Code</label>
				<input type="text" class="form-control" name="postal_code" id="postal_code" required>
			</div>
		</div>
		<div class="form-group row">
            <div class="col-md-4">
				<label for="total_floors" class="control-label">How many floors in total?</label>
				<input type="number" min="0" class="form-control" id="total_floors" name="total_floors" required>
			</div>
            <div class="col-md-4">
				<label for="total_rooms" class="control-label">How many rooms in total?</label>
				<input type="text" class="form-control" id="total_rooms" name="total_rooms" required>
			</div>
            <div class="col-md-4">
				<label for="description" class="control-label">Describe your property.</label>
				<textarea type="text" class="form-control" id="description" name="description" required></textarea>
			</div>
		</div>
        <div class="form-group row">
            <div class="col-md-4">
                    <label for="" class="control-label">What amenities does your property offer?</label>

                    <?php 
                    $availableAmenities = array("wifi","parking","reception","food hall","lounge","study area","laundromat","elevator","drinking water","microwave","refrigerator","tv","roof deck","sink","security","cctv","fire exit");
                    foreach($availableAmenities as $amenity){?>
                    <input type="checkbox" id="amenities" name="amenities[]" value="<?=$amenity?>">
                    <label for="amenities"><?=$amenity?></label><br>
                    <?php } ?>
            </div>
            <div class="col-md-4">
            <h3>Room Details</h3>
            <div id="room-container">
                <input type="hidden" name="rooms[]" value="">
                <div class="room-fields">
                <label for="total_beds">Type of room</label>
                <select name="total_beds[]" id="total_beds" required>
                    <option value="" selected disabled>Select Room</option>
                    <option value="1">Room for one</option>
                    <option value="2">Room for two</option>
                    <option value="3">Room for three</option>
                    <option value="4">Room for four</option>
                    <option value="5">Room for five</option>
                    <option value="6">Room for six</option>
                    <option value="7">Room for seven</option>
                    <option value="8">Room for eight</option>
                </select>
                <br>
                <label for="monthly_rent">Rate per person</label>
                <input type="text" id="monthly_rent" name="monthly_rent[]" required>
                <br>
                <label for="furnished_type">Furnished type</label>
                <select name="furnished_type[]" id="furnished_type" required>
                    <option value="" selected disabled>Select Furnished Type</option>
                    <option value="Furnished">Furnished</option>
                    <option value="Semi-furnished">Semi-furnished</option>
                    <option value="Unfurnished">Unfurnished</option>
                </select>
                <br>
                <label class="control-label">Amenities:</label>
                <?php 
                $roomAmenities = array("aircon","cushion","drinking water","refrigerator","electric fan","wifi");
                foreach($roomAmenities as $amenity){?>
                <input type="checkbox" id="room_amenities" name="room_amenities[][<?=$amenity?>]" value="<?=$amenity?>">
                <label for="room_amenities"><?=$amenity?></label><br>
                <?php } ?>
            </div>
            </div>
            <button type="button" id="add-room">Add Another Room</button>
            <input type="hidden" id="hiddenInput" name="selected_amenities">
        </div>
        <div class="form-group row">
            <h3>House Rules</h3>
            <div class="col-md-4">
				<label for="short_term" class="control-label">Do you allow short-term stay?</label>
				<input type="radio" name="short_term" value="1" checked>
                <label for="html">Yes</label><br>
                <input type="radio" name="short_term" value="0">
                <label for="css">No</label><br>
			</div>
            <div class="col-md-4">
				<label for="min_weeks" class="control-label">Minimum stay allowed</label>
				<select name="min_weeks" id="min_weeks" required>
                    <option value="" selected disabled>Select minimum no. of week</option>
                    <option value="1">1 Week</option>
                    <option value="2">2 Weeks</option>
                    <option value="3">3 Weeks</option>
                    <option value="4">4 Weeks</option>
                    <option value="5">5 Weeks</option>
                    <option value="6">6 Weeks</option>
                    <option value="7">7 Weeks</option>
                    <option value="8">8 Weeks</option>
                </select>
			</div>
            <div class="col-md-4">
                <label for="mix_gender" class="control-label">Do you allow coed or mixed-gender?</label>
				<input type="radio" name="mix_gender" value="1" checked>
                <label for="html">Yes</label><br>
                <input type="radio" name="mix_gender" value="0">
                <label for="css">No</label><br>
			</div>
            <div class="col-md-4">
                <label for="curfew" class="control-label">Do you have curfew?</label>
				<input type="radio" name="curfew" value="1" id="withCurfew" checked>
                <label for="html">Yes</label><br>
                <input type="radio" name="curfew" value="0" id="withoutCurfew">
                <label for="css">No</label><br>
			</div>
            <div class="col-md-4">
                <label for="from_curfew" class="control-label">From</label>
				<select name="from_curfew" id="from_curfew">
                    <option value="" selected disabled>Select hour</option>
                    <option value="6pm">6pm</option>
                    <option value="7pm">7pm</option>
                    <option value="8pm">8pm</option>
                    <option value="9pm">9pm</option>
                    <option value="10pm">10pm</option>
                    <option value="11pm">11pm</option>
                    <option value="12mn">12mn</option>
                    <option value="1am">1am</option>
                </select><br>
                <label for="to_curfew" class="control-label">To</label>
				<select name="to_curfew" id="to_curfew">
                    <option value="" selected disabled>Select hour</option>
                    <option value="4am">4am</option>
                    <option value="5am">5am</option>
                    <option value="6am">6am</option>
                    <option value="7am">7am</option>
                </select>
			</div>
            <div class="col-md-4">
                <label for="cooking" class="control-label">Do you allow cooking?</label>
				<input type="radio" name="cooking" value="1"checked>
                <label for="html">Yes</label><br>
                <input type="radio" name="cooking" value="0">
                <label for="css">No</label><br>
			</div>
            <div class="col-md-4">
                <label for="pets" class="control-label">Do you allow pets?</label>
				<input type="radio" name="pets" value="1" checked>
                <label for="html">Yes</label><br>
                <input type="radio" name="pets" value="0">
                <label for="css">No</label><br>
			</div>
            <div class="col-md-4">
                <label for="visitors" class="control-label">Do you allow visitors?</label>
				<input type="radio" name="visitors" value="1" checked>
                <label for="html">Yes</label><br>
                <input type="radio" name="visitors" value="0">
                <label for="css">No</label><br>
			</div>
		</div>
        <div class="form-group row">
            <div class="col-md-4">
				<label for="reservation_fee" class="control-label">Reservation fee</label>
				<input type="text" class="form-control" name="reservation_fee" id="reservation_fee" required>
			</div>
            <div class="col-md-4">
				<label for="advance_deposit" class="control-label">Advance deposit</label>
				<input type="text" class="form-control" name="advance_deposit" id="advance_deposit" required>
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
        <button class="btn btn-sm btn-outline-danger" id="submit-button" type="submit">Add</button>
	</form>
</div>
<!-- <script src="form-validate.js"></script> -->
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
    if(isset($_POST['property_type'], $_POST['property_name'], $_POST['landlord_id'], $_POST['total_rooms'],$_POST['total_floors'],$_POST['description'],$_POST['property_number'],$_POST['street'],$_POST['region_text'],$_POST['province_text'],$_POST['city_text'],$_POST['barangay_text'],$_POST['postal_code'],$_POST['latitude'],$_POST['longitude'],$_POST['reservation_fee'],$_POST['advance_deposit'])){
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
        $status = 1;
        $lowest_rate = 0;
        $rent = $_POST['monthly_rent'];
        foreach($rent as $rate){
            if((intval($rate))>=(intval($lowest_rate))){
                $lowest_rate = $rate;
            }
        }
        //add to properties table but status=2=pending
        
        $property = new Property();
        $property->setConnection($connection);
        $property_id = $property->addProperty($property_type, $property_name, $landlord_id, $total_rooms,$total_floors,$description,$property_number,$street,$region_text,$province_text,$city_text,$barangay_text,$postal_code,$latitude,$longitude,$lowest_rate,$reservation_fee,$advance_deposit, $status);

        //add to property amenities table but status=2=pending
        $amenities = $_POST['amenities'];
        $amenities_csv = implode(",", $amenities);
        $status = 1;

        $property_amenities = new Amenity($property_id, $amenities_csv, $status);
        $property_amenities->setConnection($connection);
        $property_amenities->addAmenities();

        //add to property rules table but status=2=pending
        $status = 1;
        $rules = new Rule($property_id, $_POST['short_term'], $_POST['min_weeks'], $_POST['mix_gender'], $_POST['curfew'], $_POST['from_curfew'], $_POST['to_curfew'], $_POST['cooking'], $_POST['pets'], $_POST['visitors'],$status);
        $rules->setConnection($connection);
        $rules->addRules();

        //add to rooms table but status=2=pending
        $beds = $_POST['total_beds']; 
        $rent = $_POST['monthly_rent']; 
        $type = $_POST['furnished_type']; 
        $occupied_beds = 0;

        $selected_amenities = $_POST['selected_amenities'];
        $amenities = json_decode($selected_amenities, true); 

            for ($x = 0; $x < (count($beds)); $x++) {
                $total_beds = $beds[$x];
                $monthly_rent = $rent[$x];
                $furnished_type = $type[$x];
                $status = 1;
                
                $room = new Room($property_id, $total_beds, $occupied_beds, $furnished_type, $monthly_rent, $status);
                $room->setConnection($connection);
                $room_id = $room->addRoom();

                $room_amenities = $amenities[$x];
                $room_amenities_csv = implode(",", $room_amenities);

                $room_amenities = new RoomAmenity($room_id, $room_amenities_csv, $status);
                $room_amenities->setConnection($connection);
                $room_amenities->addRoomAmenities();
            }

        echo "<script>window.location.href='index.php?success=1';</script>";
        exit();
    } else {
        echo "<script>alert('Failed to add property. Please check your inputs.</script>";
    }
} catch (Exception $e) {
    echo "<script>window.location.href='index.php?error='" . $e->getMessage() . ";</script>";
    exit();
}