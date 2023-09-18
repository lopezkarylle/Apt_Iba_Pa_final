<?php
use Models\Schedule; 
use Models\Appointment; 
use Models\Property; 
use Models\User; 
use Models\Notification; 
include ("init.php");
include ("session.php");

if(!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 2){
    header('location: index.php');
    exit();
}
if(isset($_POST['set_appointment'])){
   $property_id = $_POST['property_id'];
   $user_id = $_SESSION['user_id'];
   $appointment_date = $_POST['set_date'];
   $appointment_time = $_POST['set_time'];

   //echo $property_id, $user_id, $appointment_date, $appointment_time;
// $property_id = 26;
// $user_id = 33;
// $appointment_date = '2023-09-09';
// $appointment_time = '3:00 PM';

  $formatted_date = date("F j, Y", strtotime($appointment_date));
  //var_dump($property_id, $user_id, $appointment_date, $appointment_time);

  $matchFound = false;
  $date_time = new Schedule('','','');
  $date_time->setConnection($connection);
  $date_time = $date_time->getDateTime($property_id);
 
  foreach($date_time as $date_item){
    $unavailable_date = $date_item['date'];
    //$check_time = $date_item['time'];
    //var_dump($unavailable_date, $check_time);
      if ($appointment_date === $unavailable_date) {
        $check_time = $date_item['time'];
        $check_time .= ', ' . $appointment_time;
        $matchFound = true;
      }
  }
  //var_dump($check_time);
  //var_dump($property_id, $user_id, $appointment_date, $check_time, $matchFound);

  $appointment = new Appointment($property_id, $user_id, $appointment_date,$appointment_time,1);
  $appointment->setConnection($connection);
  $appointment->setAppointment();

  $user = new User();
  $user->setConnection($connection);
  $user = $user->getById($user_id);
  $full_name = $user['first_name'] . ' ' . $user['last_name'];

  $property = new Property();
  $property->setConnection($connection);
  $property = $property->getPropertyDetails($property_id);
  $property_name = $property['property_name'];
  $landlord_id = $property['landlord_id'];
  $notification_text = 'An appointment has been scheduled for your property, ' . $property_name . ', on ' . $formatted_date . ' at ' . $appointment_time . ' by ' . $full_name;
  $notification_type = 'appointment';
  $isRead = 0;
  $status = 1;

  $notification = new Notification();
  $notification->setConnection($connection);
  $notification->sendNotification($landlord_id, $notification_text, $notification_type, $isRead, $status);

    if ($matchFound) {
      $unavailable = new Schedule('','','');
      $unavailable->setConnection($connection);
      $unavailable->updateUnavailable($property_id, $appointment_date, $check_time);
    } else {
      //var_dump($property_id, $appointment_date, $appointment_time);
      $unavailable = new Schedule($appointment_date, $appointment_time, $property_id);
      $unavailable->setConnection($connection);
      $unavailable->setUnavailable();
    }

    echo "Appointment set successfully";
  //var_dump($unavailable_dates);
  
}
?>



