<?php
use Models\Property;
use Models\Amenity;
use Models\Room;
use Models\RoomAmenity;
use Models\Image;
use Models\Review;
include "../../init.php";
include ("../session.php");

    $property_id = $_GET['property_id'];
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
	$first_name = $details['first_name'];
	$last_name = $details['last_name'];

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
<title>Admin Dashboard</title>

</head>
<body>
<nav>
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

<!-- View and Edit Property Information -->
<div class="container-fluid" id="property_information">
	<form action="edit.php" method="POST" id="property-details">
		<input type="hidden" name="property_id" value="<?php echo isset($property_id) ? $property_id : '' ?>">
		<input type="hidden" name="owner_id" value="<?= $owner_id ?>">
		<div class="row form-group">
            <div class="col-md-4">
				<label for="property_type" class="control-label">Property Type</label>                <select name="property_type" class="form-control form-control-md" id="property_type" required>
                    <option value="<?php echo isset($property_type) ? $property_type : '' ?>" selected disabled><?php echo isset($property_type) ? $property_type : '' ?></option>
                    <option value="Apartment">Apartment</option>
                    <option value="Dormitory">Dormitory</option>
                    <option value="" data-new-option>Other</option>
                </select>
                <input name="property_type" class="form-control form-control-md" id="property_type_input" style="display: none;" placeholder="Type of your property" required/>
                <button type="button" id="revert-input" style="display: none;">Select from existing instead</button>
			</div>
            <div class="col-md-4">
				<label for="property_name" class="control-label">Property Name</label>
				<input type="text" class="form-control" value="<?php echo isset($property_name) ? $property_name : '' ?>" name="property_name" id="property_name" required>
			</div>
            <div class="col-md-4">
				<label for="property_number" class="control-label">Lot Number</label>
				<input type="text" class="form-control" value="<?php echo isset($property_number) ? $property_number : '' ?>" name="property_number" id="property_number" required>
			</div>
            <div class="col-md-4">
				<label for="street" class="control-label">Street</label>
				<input type="text" class="form-control" value="<?php echo isset($street) ? $street : '' ?>" name="street" id="street" required>
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
				<input type="text" class="form-control" value="<?php echo isset($postal_code) ? $postal_code : '' ?>" name="postal_code" id="postal_code" required>
			</div>
		</div>
		<div class="form-group row">
            <div class="col-md-4">
				<label for="total_floors" class="control-label">How many floors in total?</label>
				<input type="text" class="form-control" name="total_floors" id="total_floors" value="<?php echo isset($total_floors) ? $total_floors : '' ?>" required>
			</div>
            <div class="col-md-4">
				<label for="total_rooms" class="control-label">How many rooms in total?</label>
				<input type="text" class="form-control" value="<?php echo isset($total_rooms) ? $total_rooms : '' ?>" name="total_rooms" id="total_rooms" required>
			</div>
            <div class="col-md-4">
				<label for="description" class="control-label">Describe your property.</label>
				<textarea type="text" class="form-control" name="description" id="description" required><?php echo isset($description) ? $description : '' ?></textarea>
			</div>
		</div>
		<div class="form-group row">
            <div class="col-md-4">
				<label for="latitude" class="control-label">Latitude</label>
				<input type="text" class="form-control" name="latitude" value="<?php echo isset($latitude) ? $latitude : '' ?>" required>
			</div>
            <div class="col-md-4">
				<label for="longitude" class="control-label">Longitude</label>
				<input type="text" class="form-control" value="<?php echo isset($longitude) ? $longitude : '' ?>" name="longitude" required>
			</div>
            <div class="col-md-4">
				<label for="reservation" class="control-label">Reservation Fee</label>
				<input type="text" class="form-control" name="reservation" id="reservation" value="<?php echo isset($reservation) ? $reservation : '' ?>" required>
			</div>
			<div class="col-md-4">
				<label for="deposit" class="control-label">Advance Deposit</label>
				<input type="text" class="form-control" name="deposit" id="deposit"value="<?php echo isset($deposit) ? $deposit : '' ?>"required>
			</div>
		</div>
			</div>
		</div>
        <button class="btn btn-sm btn-outline-danger" name="edit_property" type="submit" disabled>Update</button>
	</form>
</div>

<!-- View and Edit Amenities -->
<div name="amenities_checkbox" class="container-fluid" id="property_amenities">
<h2>Property Amenities</h2>
<form action="edit.php" method="POST">
		<input type="hidden" name="property_id" value="<?php echo isset($property_id) ? $property_id : '' ?>">
		<div class="row form-group">
            <div class="col-md-4">
			<?php 
			$availableAmenities = array("wifi","parking","reception","food hall","lounge","study area","laundromat","elevator","drinking water","microwave","refrigerator","tv","roof deck","sink","security","cctv","fire exit");
			
			foreach($availableAmenities as $amenity) {
				$is_available = in_array($amenity, $amenities_array);
			?>
				<input type="checkbox" class="form-control" id="amenities" name="amenities[]"  value="<?= $amenity?>" <?php echo $is_available ? 'checked' : '' ?>>
				<label for="" class="control-label"><?= $amenity?></label><br>
			<?php } ?>
			</div>
		</div>
        <button class="btn btn-sm btn-outline-danger" name="edit_amenities" type="submit">Update</button>
	</form>
</div>

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
<form action="edit.php" method="POST">
<div name="amenities_checkbox" class="container-fluid" id="room_amenities">
<h2><?= $room['total_beds'] ?> beds</h2>
<h3><?= $room['furnished_type'] ?> furnished</h3>
		<input type="hidden" name="property_id" value="<?php echo isset($property_id) ? $property_id : '' ?>">
		<input type="hidden" name="room_id" value="<?php echo isset($room_id) ? $room_id : '' ?>">
		<div class="row form-group">
            <div class="col-md-4">
			<?php 
			$availableAmenities = array("aircon","cushion","drinking water","refrigerator","electric fan","wifi");
			
			foreach($availableAmenities as $roomAmenity) {
				$is_available = in_array($roomAmenity, $roomAmenities_array);
			?>
				<input type="checkbox" class="form-control" name="roomAmenities[]"  value="<?= $roomAmenity?>" <?php echo $is_available ? 'checked' : '' ?>>
				<label for="" class="control-label"><?= $roomAmenity?></label><br>
			<?php } ?>
			</div>
		</div>
	</form>
	<button class="btn btn-sm btn-outline-danger" name="edit_room_amenities" type="submit">Update</button>
</div>
<?php }?>


<!-- View and Edit Images -->
<div name="property_images" class="container-fluid" id="property_images">
<h2>Images</h2>
		<div class="row form-group">
            <div class="col-md-4">
			<form action="delete-image.php" method="POST">
			<?php
				$images = new Image();
				$images->setConnection($connection);
				$getImages = $images->getImages($property_id);
				foreach($getImages as $img){
			?>
				<img src="../../resources/images/properties/<?= $img['image_path']?>" height="200" width="200" alt="property photo">
				<input type="hidden" name="image_id" value="<?= $img['image_id']?>">
				<input type="hidden" name="property_id" value="<?php echo isset($property_id) ? $property_id : '' ?>">
				<input type="hidden" name="image_path" value="../../resources/images/properties/<?= $img['image_path']?>">
				<input type="submit" name="delete_image" value="Delete">
				
				<?php }?>
				</form>
                <br><br>

				<form action="upload.php" method="POST" enctype="multipart/form-data">
				<input type="hidden" name="property_id" value="<?php echo isset($property_id) ? $property_id : '' ?>">
				<input type="file" class="form-control" name="images[]" id="image" multiple><br>
                <input type="text" class="form-control" name="image_title" id="image_title" placeholder="Insert caption for image">
			</div>
		</div>
        <button class="btn btn-sm btn-outline-danger" name="add_image" id="add_image" type="submit">Upload Images</button>
	</form>
    <a class="btn btn-sm btn-outline-primary" type="button" href="view-gallery.php?property_id=<?php echo $property_id?>">View Gallery</a>
</div>

<!-- View and Edit Reviews -->
<div name="property_reviews" class="container-fluid" id="property_reviews">
<h2>Reviews</h2>
		<div class="row form-group">
            <div class="col-md-4">
			<?php
				$reviews = new Review();
				$reviews->setConnection($connection);
				$getReviews = $reviews->getReviews($property_id);
				foreach($getReviews as $review){ 
			?>  
				<form action="edit.php" method="POST">
				<input type="hidden" name="review_id" value="<?= $review['review_id']?>">
				<input type="hidden" name="property_id" value="<?= $review['property_id']?>">
				<h1><?= $review['first_name'] . ' ' . $review['last_name']?></h1>
				<body class="control-label"><?= $review['description']?></body>
				<button class="btn btn-sm btn-outline-danger" name="delete_review" type="submit">Delete</button>
				</form>
				<?php }?>
			</div>
		</div>
</div>
<script>
const select = document.getElementById('property_type');
const input = document.getElementById('property_type_input');
const revertButton = document.getElementById('revert-input');

revertButton.addEventListener('click', () => {
    input.value = '';
    input.style.display = 'none';
    revertButton.style.display = 'none';
    select.style.display = 'block';
});

select.addEventListener('change', () => {
    if (select.value === '') {
        input.style.display = 'block';
        input.value = select.getAttribute('data-new-option-text');
        revertButton.style.display = 'block';
        select.style.display = 'none';
        select.setAttribute('required', false);
    } else {
        input.setAttribute('required', false);
        input.style.display = 'none';
        select.style.display = 'block';
    }
});
</script>
<script>
    const editPropertyButton = document.getElementById('edit_property');
const propertyTypeSelect = document.getElementById('property_type');
const propertyNameInput = document.getElementById('property_name');
const propertyNumberInput = document.getElementById('property_number');
const streetInput = document.getElementById('street');
const totalFloorsInput = document.getElementById('total_floors');
const postalCodeInput = document.getElementById('postal_code');
const totalRoomsInput = document.getElementById('total_rooms');
const reservationInput = document.getElementById('reservation');
const depositInput = document.getElementById('deposit');
const descriptionTextarea = document.getElementById('description');

let isEnabled = true;

propertyTypeSelect.addEventListener('change', () => {
    isEnabled = true;
});

propertyNameInput.addEventListener('input', () => {
    isEnabled = propertyNameInput.value.trim().length > 0;
});

propertyNumberInput.addEventListener('input', () => {
    isEnabled = propertyNumberInput.value.trim().length > 0;
});

streetInput.addEventListener('input', () => {
    isEnabled = streetInput.value.trim().length > 0;
});

totalFloorsInput.addEventListener('input', () => {
    isEnabled = totalFloorsInput.value.trim().length > 0 && !totalFloorsInput.value.includes(',');
});

postalCodeInput.addEventListener('input', () => {
    isEnabled = postalCodeInput.value.trim().length > 0 && postalCodeInput.value.length === 6 && !postalCodeInput.value.includes(',');
});

totalRoomsInput.addEventListener('input', () => {
    isEnabled = totalRoomsInput.value.trim().length > 0 && !totalRoomsInput.value.includes(',');
});

reservationInput.addEventListener('input', () => {
    isEnabled = reservationInput.value.trim().length > 0 && !reservationInput.value.includes(',') && reservationInput > 0;
});

depositInput.addEventListener('input', () => {
    isEnabled = depositInput.value.trim().length > 0 && !depositInput.value.includes(',') && depositInput > 0;
});

descriptionTextarea.addEventListener('input', () => {
    isEnabled = descriptionTextarea.value.trim().length > 0;
});

editPropertyButton.disabled = !isEnabled;
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="ph-address-selector.js"></script>
<script src="geo.js"></script>
<script src="room.js"></script>
<script src="map.js"></script>
<script src="rules.js"></script>
</body>




<!-- <script>
$(document).ready(function() {
  // Attach click event listener to the button
  $("#submit-all-forms").on("click", function() {
    // Select all forms with the class "multi-form"
    var forms = $(".multi-form");

    // Loop through each form and submit it
    forms.each(function(index, form) {
      form.submit();
    });
  });
});
</script> -->
</html>