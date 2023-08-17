<?php 
use Models\Reservation;

include ("init.php");

$user_id = $_SESSION['user_id'];
$property_id = $_POST['property_id'];
$room_id = $_POST['room_id'];
$payment_status = 'unpaid';

$reservation = new Reservation($user_id, $property_id, $room_id, $payment_status, $status);
$reservation->setConnection($connection);
$reservation = $reservation->addReservation();

echo "<script>alert('Successfully applied for reservation!)</script>";