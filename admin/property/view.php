<?php
use Models\Property;
use Models\Amenity;
include "../../init.php";
include ("../session.php");

    $property_id = $_GET['property_id'];
    $property = new Property('', '', '', '','','','','', '', '', '','','','');
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
	//var_dump($property_name);

	//add photos
	//location
	//add reviews

	$amenity = new Amenity('','','');
	$amenity->setConnection($connection);
	$amenities = $amenity->getAmenities($property_id);
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
</nav>

<!-- View and Edit Property Information -->
<div class="container-fluid">
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
				<input type="text" class="form-control" name="first_name"  value="<?php echo isset($first_name) ? $first_name :'' ?>" required>
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
<div name="amenities_checkbox" class="container-fluid">
<h2>Amenities</h2>
<form action="edit.php" method="POST">
		<input type="hidden" name="property_id" value="<?php echo isset($property_id) ? $property_id : '' ?>">
		<div class="row form-group">
            <div class="col-md-4">
			<?php foreach($amenities as $amenityz){
				$is_available = $amenityz['is_available'];

				if($is_available==1){
					$checked = 'checked';
				}
				else{
					$checked = '';
				} ?>
					<input type="checkbox" class="form-control" name="amenities[]"  value="<?php echo $amenityz['amenity_name']?>" <?php echo $checked ?>>
					<label for="" class="control-label"><?php echo $amenityz['amenity_name']?></label><br>
			<?php } ?>
			</div>
		</div>
        <button class="btn btn-sm btn-outline-danger" name="edit_amenities" type="submit">Update</button>
	</form>
</div>

<!-- View and Edit Photos -->
<div name="amenities_checkbox" class="container-fluid">
<h2>Photos</h2>
<form action="edit.php" method="POST">
		<input type="hidden" name="property_id" value="<?php ?>">
		<div class="row form-group">
            <div class="col-md-4">
				<?php //foreach photo ganon?>
				<label for="" class="control-label">PHOTO123</label>
				<?php ?>
				<input type="file" class="form-control" name="photos[]"><br>
			</div>
		</div>
        <button class="btn btn-sm btn-outline-danger" name="edit_photos" type="submit">Update</button>
	</form>
</div>

<!-- View and Edit Reviews -->
<div name="amenities_checkbox" class="container-fluid">
<h2>Reviews</h2>
<form action="edit.php" method="POST">
		<input type="hidden" name="property_id" value="<?php ?>">
		<div class="row form-group">
            <div class="col-md-4">
				<?php //foreach REVIEW ganon?>
				<label for="" class="control-label">REVIEWS123</label>
				<?php ?>
			</div>
		</div>
        <button class="btn btn-sm btn-outline-danger" name="edit_reviews" type="submit">Update</button>
	</form>
</div>
</body>
</html>