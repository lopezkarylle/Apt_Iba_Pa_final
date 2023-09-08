<?php
use Models\Schedule; 
use Models\Appointment; 
use Models\Property; 
use Models\User; 
use Models\Notification; 
include ("init.php");
include ("session.php");


//if(isset($_POST['set_appointment'])){
//   $property_id = $_POST['property_id'];
//   $user_id = $_POST['user_id'];
//   $appointment_date = $_POST['date'];
//   $appointment_time = $_POST['appointment_time'];

$property_id = 26;
$user_id = 33;
$appointment_date = '2023-09-09';
$appointment_time = '3:00 PM';

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

    header("Location: view.php?property_id=" . $property_id);
    exit();
  //var_dump($unavailable_dates);
  
//}
?>

<!DOCTYPE html>
<html>

<body>

  <h1>Content for Selected Date:<?php echo isset($set_date) ? $set_date : ''; ?></h1>
  <div id="contentContainer">
    <p>Select a date on the calendar to see the content for that day.</p>
  </div>

  <form action="set-appointment.php" method="POST" id="check_time">

    <input type="date" id="datepicker" value="<?= isset($set_date) ? $set_date : '' ?>" placeholder="<?= isset($set_date) ? $set_date : '' ?>" required>
    <input type="hidden" name="date" id="date" value="<?= isset($date_check) ? $date_check : '' ?>">

    <button id="fetchButton" name="set_date" type="submit">Select this date</button>
  </form>

  <form action="set-appointment.php" method="POST" id="appointment-form">
    <input type="hidden" name="date" id="date" value="<?= isset($date_check) ? $date_check : '' ?>">
    <input type="hidden" name="user_id" id="user_id" value="<?= $user_id?>">
    <input type="hidden" name="property_id" id="property_id" value="<?= $property_id?>">
    <?php 
    if(!isset($date)) { 
      $disabled = 'disabled';
    }
    foreach($time_slots as $slots){
            if(!empty($unavailable_time)){
              $unavailable = in_array($slots, $unavailable_time);
            } else {
              $unavailable = false;
            }
            
    ?>
    <input type="radio" id="radio" name="appointment_time" value="<?=$slots?>" <?php echo isset($disabled) ? $disabled : ''; echo $unavailable ? 'disabled' : '' ?>><?=$slots?><br>
    <?php } ?>


    <input name="set_appointment" id="set_appointment" type="submit" disabled value="Set appointment"></input>

  </form>

  <!-- JavaScript code -->
  <script>
    // Get references to the radio buttons and the button
    var radioButtons = document.querySelectorAll('input[name="appointment_time"]');
    var setUnavailableButton = document.getElementById('set_appointment');

    // Add event listeners to radio buttons
    radioButtons.forEach(function(radio) {
      radio.addEventListener('change', function() {
        // Enable the button when a radio button is selected
        setUnavailableButton.disabled = false;
      });
    });
    
    // Add an event listener to the button to fetch content
    $("#fetchButton").on("click", handleFetchButtonClick);

    function handleFetchButtonClick() {
      var selectedDate = $("#datepicker").val(); 
      var inputElement = document.getElementById("date");
      inputElement.value = selectedDate;
    }

    
    // Initialize the datepicker with the beforeShowDay option
    $(document).ready(function() {
    var currentDate = new Date();
    var localDate = currentDate.toLocaleDateString('en-PH', {
      year: 'numeric',
      month: 'long',
      day: 'numeric'
    });

    var disabledDates = <?php echo json_encode($disabled_dates); ?>;

    $("#datepicker").datepicker({
      dateFormat: "MM d, yy",
      minDate: localDate,
      beforeShowDay: function(date) {
        var formattedDate = $.datepicker.formatDate("yy-mm-dd", date);
        if (disabledDates.includes(formattedDate)) {
        return [false];
        } else if (formattedDate === localDate) {
        return [true];
        }
      }
    });
    });
  </script>
  
</body>

  
  
</html>


