<?php 
use Models\Reservation;
use Models\Notification;

include ("init.php");
include ("session.php");

if(isset($_SESSION['user_id']) || $_SESSION['user_type'] != 2){
    $user_id = $_SESSION['user_id'];
    $property_id = $_POST['property_id'];
    $landlord_id = $_POST['landlord_id'];
    $property_name = $_POST['property_name'];
    $room_type = $_POST['room_type'];
    $room_id = $_POST['room_id'];
    $payment_status = 'unpaid';
    $status = 2;

    $reservation = new Reservation();
    $reservation->setConnection($connection);
    $reservation = $reservation->addReservation($user_id, $property_id, $room_id, $payment_status, $status);

    $full_name = $_POST['full_name'];

    $notification_text = 'An reservation has been request for a ' . $room_type . ' on your property, ' . $property_name . ' by ' . $full_name ;
    $notification_type = 'reservation';
    $isRead = 0;
    $status = 1;

    $notification = new Notification();
    $notification->setConnection($connection);
    $notification->sendNotification($landlord_id, $notification_text, $notification_type, $isRead, $status);

    echo "<script>alert('Successfully applied for reservation!)</script>";
} else {
    header('location: index.php');
    exit();
}
