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
    
    
    //get all rooms of property
	$room = new Room();
	$room->setConnection($connection);
	$rooms = $room->getRooms($property_id);

    //each room information
    foreach($rooms as $roomie){
        print_r($roomie);
        echo "<br><br>";
    }
    
?>

