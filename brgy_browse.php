<?php
use Models\Property;
include ("init.php");
include ("session.php");

$barangay = $_POST['barangay'];
$property = new Property();
$property->setConnection($connection);
$properties = $property->getPropertiesByBarangay($barangay);

$user_id = $_SESSION['user_id'] ?? NULL;

var_dump($properties);

?>

