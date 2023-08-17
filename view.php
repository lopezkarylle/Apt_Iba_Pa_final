<?php
use Models\Property;
use Models\Amenity;
use Models\Room;
use Models\RoomAmenity;
use Models\Image;
use Models\Review;
include ("init.php");
//include ("../session.php");

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
<div class="container-fluid">
<nav>
  <ul class="nav nav-pills nav-justified">
    <li class="active" style="background-color: #FFF8DC"><a  href="index.php">Dashboard</a></li>
    <li style="background-color: #FAF0E6"><a  href="properties.php">Accommodations</a></li>
    <li style="background-color: #FFFAF0"><a  href="about.php">About Us</a></li>
    <?php if (isset($user_id)){ ?>
        <li style="background-color: #FAFAF0"><a  href="../../logout.php">Logout</a></li>
    <?php } else { ?>
        <li style="background-color: #FAFAF0"><a  href="../../tenant-login.php">Login</a></li>
    <?php } ?>
  </ul>
  <a href="../../logout.php">Logout</a>
</nav>

<!-- View and Edit Property Information -->
<div class="container-fluid" id="property_information">
<div class="col-sm-6">	
    <form method="POST" action="appointment.php">
        <input type="hidden" name="property_id" value="<?php echo $property_id ?>">
        <button class="btn btn-success" style="margin-top:10px;">Request a visit</button>
    </form>		
    <form method="POST" action="reserve.php">
        <input type="hidden" name="property_id" value="<?php echo $property_id ?>">
        <button class="btn btn-success" style="margin-top:10px;">Reserve a room</button>
    </form>			
</div>
<table class="table table-striped table-hover">
				<thead>
					<tr>
                        <th scope="col">Property</th>
                        <th scope="col">Owner</th>
                        <th scope="col">Available Rooms</th>
                        <th scope="col">Floors</th>
                        <th scope="col">Description</th>
						<th scope="col">Lot</th>
						<th scope="col">Street</th>
                        <th scope="col">Barangay</th>
                        <th scope="col">City</th>
                        <th scope="col">Province</th>
					</tr>
				</thead>
				<tbody>
            <tr>
                <td><?php echo $property_name?></td>
                <td><?php echo $first_name . ' ' . $last_name?></td>
                <td><?php echo $total_rooms?></td>
                <td><?php echo $total_floors?></td>
                <td><?php echo $description?></td>
                <td><?php echo $property_number?></td>
                <td><?php echo $street?></td>
                <td><?php echo $barangay?></td>
                <td><?php echo $city?></td>
                <td><?php echo $province?></td>

            </tr>
				</tbody>
			</table>
</div>

<!-- View  Amenities -->
<div name="property_amenities" class="container-fluid" id="property_amenities">
<h2>Property Amenities</h2>
		<div class="row form-group">
            <div class="col-md-4">
			<?php 		
            foreach($property_amenities as $amenity) {
			?>
				<ul>
                    <li><?php echo $amenity?></li>
                </ul>
			<?php } ?>
			</div>
		</div>
</div>

<!-- View Rooms -->
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
<h2><?php echo $room_type ?> </h2>
<ul>
    <?php foreach($room_amenities as $amenities):?>
    <li><?php echo $amenities;?></li>
    <?php endforeach;?>
</ul>
<?php  }?>

    
<?php //endforeach; ?>

<!-- View Images -->
<div name="property_images" class="container-fluid" id="property_images">
<h2>Images</h2>
		<div class="row form-group">
            <div class="col-md-4">
			<?php
				$images = new Image();
				$images->setConnection($connection);
				$getImages = $images->getImages($property_id);
                
                
				foreach($getImages as $img){
			?>
				<img src="../resources/images/properties/<?= $img['image_path']?>" height="200" width="200" alt="property photo">
				<input type="hidden" name="image_id" value="<?= $img['image_id']?>">
				<input type="hidden" name="property_id" value="<?php echo isset($property_id) ? $property_id : '' ?>">
				<input type="hidden" name="image_path" value="<?= $img['image_path']?>">
				<?php }?>
			</div>
		</div>
</div>

<!-- View Reviews -->
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
				<h3><?= $review['first_name'] . ' ' . $review['last_name']?></h3>
				<body class="control-label"><?= $review['description']?></body>
				<?php }?>
			</div>
		</div>
</div>
</body>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</html>