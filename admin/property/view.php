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
    $property = new Property('','', '', '', '','','','','', '', '', '','','','');
    $property->setConnection($connection);
    $details = $property->getPropertyDetails($property_id);

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

	$room = new Room('','','','','','','');
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
	<form action="edit.php" method="POST">
		<input type="hidden" name="property_id" value="<?php echo isset($property_id) ? $property_id : '' ?>">
		<h2><?php echo isset($property_name) ? $property_name :'' ?></h2>
		<div class="row form-group">
            <div class="col-md-4">
				<label for="" class="control-label">Property Name</label>
				<input type="text" class="form-control" name="property_name"  value="<?php echo isset($property_name) ? $property_name :'' ?>" required>
			</div>
		    <div class="col-md-4">
				<label for="" class="control-label">Landlord</label>
				<input type="text" class="form-control" name="owner_id"  value="<?php echo isset($owner_id) ? $owner_id :'' ?>" required>
			</div>
		</div>
		<div class="row form-group">
            <div class="col-md-4">
				<label for="" class="control-label">Total Rooms</label>
				<input type="text" class="form-control" name="total_rooms"  value="<?php echo isset($total_rooms) ? $total_rooms :'' ?>" required>
			</div>
		    <div class="col-md-4">
				<label for="" class="control-label">Total Floors</label>
				<input type="text" class="form-control" name="total_floors"  value="<?php echo isset($total_floors) ? $total_floors :'' ?>" required>
			</div>
			<div class="col-md-4">
				<label for="" class="control-label">Description</label>
				<input type="text" class="form-control" name="description"  value="<?php echo isset($description) ? $description :'' ?>" required>
			</div>
		</div>
		<div class="form-group row">
			<div class="col-md-4">
				<label for="" class="control-label">#</label>
				<input type="text" class="form-control" name="property_number"  value="<?php echo isset($property_number) ? $property_number :'' ?>" required>
			</div>
			<div class="col-md-4">
				<label for="" class="control-label">Street</label>
				<input type="text" class="form-control" name="street"  value="<?php echo isset($street) ? $street :'' ?>" required>
			</div>
			<div class="col-md-4">
				<label for="" class="control-label">Barangay</label>
				<input type="text" class="form-control" name="barangay"  value="<?php echo isset($barangay) ? $barangay :'' ?>" required>
			</div>
			<div class="col-md-4">
				<label for="" class="control-label">City</label>
				<input type="text" class="form-control" name="city"  value="<?php echo isset($city) ? $city :'' ?>" required>
			</div>
		</div>
        <button class="btn btn-sm btn-outline-danger" name="edit_property" type="submit">Update</button>
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
				<input type="checkbox" class="form-control" name="amenities[]"  value="<?= $amenity?>" <?php echo $is_available ? 'checked' : '' ?>>
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
			$availableAmenities = array("aircon","cushion","drinking_water","refrigerator","electric fan","wifi");
			
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
<div name="amenities_checkbox" class="container-fluid" id="property_images">
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
				<input type="hidden" name="image_path" value="<?= $img['image_path']?>">
				<input type="submit" name="delete_image" value="Delete">
				
				<?php }?>
				</form>

				<form action="upload.php" method="POST" enctype="multipart/form-data">
				<input type="hidden" name="property_id" value="<?php echo isset($property_id) ? $property_id : '' ?>">
				<input type="file" class="form-control" name="images[]" multiple><br>
			</div>
		</div>
        <button class="btn btn-sm btn-outline-danger" name="add_image" id="add_image" type="submit">Upload Images</button>
	</form>
</div>

<!-- View and Edit Reviews -->
<div name="amenities_checkbox" class="container-fluid" id="property_reviews">
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
</body>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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