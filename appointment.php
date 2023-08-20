<?php

// FOR USER WHEN SELECTING APPOINTMENT DATES

use Models\Schedule;
use Models\Appointment;

include ("../init.php");

$property_id = 1;
$user_id = 5; //change with session
$disabled_dates = [];
$date_time = new Schedule('','','');
$date_time->setConnection($connection);
$date_time = $date_time->getDateTime($property_id);

foreach($date_time as $date_item){
  $unavailable_date = $date_item['date'];
  $time_list = $date_item['time'];
  $time_list = explode(", ", $time_list);
  if ((count($time_list))===21){
    $disabled_dates[]=$unavailable_date;
  }
}
//var_dump($disabled_dates);

$unavailable_time = [];

if(isset($_POST['set_date'])){
  $set_date = $_POST['date'];
  //var_dump($set_date);
  $timestamp = strtotime($set_date);
  
  $date_check = date("Y-m-d", $timestamp); 
  //var_dump($date_check);
  foreach($date_time as $date){
    $dates = $date['date'];

    if($dates===$date_check){
      $time_date = $date['time'];
      $unavailable_time = explode(", ", $time_date);
    } 
  }
} 

$time_slots = array("08:00 AM","08:30 AM","09:00 AM","09:30 AM","10:00 AM","10:30 AM","11:00 AM","11:30 AM","12:00 NN","12:30 PM","01:00 PM","01:30 PM","02:00 PM","02:30 PM","03:00 PM", "03:30 PM","04:00 PM","04:30 PM","05:00 PM","05:30 PM","06:00 PM");

if(isset($_POST['set_appointment'])){
  $property_id = $_POST['property_id'];
  $user_id = $_POST['user_id'];
  $appointment_date = $_POST['date'];
  $appointment_time = $_POST['appointment_time'];

  //var_dump($property_id, $user_id, $appointment_date, $appointment_time);

  $matchFound = false;

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
  
}
?>

<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>
<body>
<nav>
  <ul class="nav nav-pills nav-justified">
    <li style="background-color: #FFF8DC"><a  href="index.php">Dashboard</a></li>
    <li class="active" style="background-color: #FAF0E6"><a  href="accommodations.php">Accommodations</a></li>
    <li style="background-color: #FFFAF0"><a  href="about.php">About Us</a></li>
    <?php if (isset($user_id)){ ?>
        <li style="background-color: #FAFAF0"><a  href="../../logout.php">Logout</a></li>
    <?php } else { ?>
        <li style="background-color: #FAFAF0"><a  href="../../tenant-login.php">Login</a></li>
    <?php } ?>
  </ul>
  <a href="../../logout.php">Logout</a>
</nav>

  <h1>Content for Selected Date:<?php echo isset($set_date) ? $set_date : ''; ?></h1>
  <div id="contentContainer">
    <p>Select a date on the calendar to see the content for that day.</p>
  </div>

  <form action="appointment.php" method="POST" id="check_time">

    <input type="text" id="datepicker" value="<?= isset($set_date) ? $set_date : '' ?>" placeholder="<?= isset($set_date) ? $set_date : '' ?>" required>
    <input type="hidden" name="date" id="date" value="<?= isset($date_check) ? $date_check : '' ?>">

    <button id="fetchButton" name="set_date" type="submit">Select this date</button>
  </form>

  <form action="appointment.php" method="POST" id="appointment-form">
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
        }
        return [true];
      }
    });
    });
  </script>
  
</body>

  
  
</html>


