<?php 
use Models\Schedule; 
use Models\Appointment; 
include ("init.php");
include ("session.php");

$property_id = $_POST['property_id'];
//$property_name = $_POST['property_name'];
//$property_id = 26;
$date_time = new Schedule('','','');
$date_time->setConnection($connection);
$date_time = $date_time->getDateTime($property_id);

//var_dump($date_time);

if(isset($_POST['set_date'])){
    
    $set_date = $_POST['set_date'];
    //$set_date = '2023-09-07';
    $unavailable_time = [];
    foreach($date_time as $date){
        $dates = $date['date'];
        //var_dump($dates);
        
        if($dates===$set_date){
            $time_date = $date['time'];       
            $unavailable_time = explode(",", $time_date);
        } 
    }

    //var_dump($unavailable_time);
    
    $unavailable_morning = array();
    $unavailable_afternoon = array();

    foreach ($unavailable_time as $time_slot) {
        // Extract the time part from the time slot (e.g., "08:00 AM" -> "08:00")
        $time_parts = explode(", ", $time_slot);
        $time_value = $time_parts[0];
  
    
        // Check if the time is in the morning (from "08:00 AM" to "11:30 AM")
        if ($time_value >= "08:00" && $time_value < "12:00") {
            $unavailable_morning[] = $time_slot;
        } else {
            $unavailable_afternoon[] = $time_slot;
        }
    }
    
    //var_dump($unavailable_morning);
    
} 

?>

<div class="row ps-4 h3 mt-2">
    <h2 class="dayzone">
    <img src="images/dayzone1.png" alt=""/>
    Morning
    </h2>
    <h2 class="timezone">8:00 AM to 11:30 AM</h2>
</div>

<?php
$morning_slots = array("08:00 AM","08:30 AM","09:00 AM","09:30 AM","10:00 AM","10:30 AM","11:00 AM","11:30 AM");

$passed_time_slots = [];
date_default_timezone_set('Asia/Manila');
$current_date = date("Y-m-d");
$current_time = date("h:i A");

if($set_date === $current_date){
    usort($morning_slots, function ($a, $b) {
        $time_a = strtotime($a);
        $time_b = strtotime($b);
        return $time_a - $time_b;
    });
    
    // Find the time slots that have already passed
    $passed_time_slots = array_filter($morning_slots, function ($time_slot) use ($current_time) {
        return strtotime($time_slot) < strtotime($current_time);
    });
}

$row_count = 0;
$col_count = 0;

echo '<div class="row pt-5 justify-content-center">';
foreach ($morning_slots as $time_slot) {
if ($col_count == 4) {
    echo '</div><div class="row pt-5 justify-content-center">';
    $col_count = 0;
}

if(in_array($time_slot, $unavailable_morning) || in_array($time_slot, $passed_time_slots)){
    $unavailable = 'disabled';
  } else {
    $unavailable = '';
  }

echo '<div class="col-6 col-sm-auto col-lg-2 mt-2 mt-md-0 d-flex justify-content-center">
                        
<label class="radio w-100 justify-content-center d-flex">
  <input type="radio" name="time_slot" id="time_slot" value="' . $time_slot . '" required ' . $unavailable . '/>

  <div class="row justify-content-between radioVisitTime px-2 py-1 align-items-center"
    id="pickVisitTime">

    <div class="col-12">
      <span class="requestVisitTime"><i class="fa-regular fa-clock-eight me-2"></i>' . $time_slot . '</span>
    </div>

  </div>
</label>
</div>';
$col_count++;
}
echo '</div>';

?>

<div class="row ps-4 h3 mt-5">
    <hr>
    <h2 class="dayzone pt-4">
    <img src="images/dayzone2.png" alt=""/>
    Afternoon
    </h2>
    <h2 class="timezone">1:00 PM to 5:30 PM</h2>
</div>
    
<?php
$afternoon_slots = array("01:00 PM","01:30 PM","02:00 PM","02:30 PM","03:00 PM", "03:30 PM","04:00 PM","04:30 PM","05:00 PM","05:30 PM","06:00 PM");

$passed_time_slots = [];
date_default_timezone_set('Asia/Manila');
$current_date = date("Y-m-d");
$current_time = date("h:i A");

if($set_date === $current_date){
    usort($afternoon_slots, function ($a, $b) {
        $time_a = strtotime($a);
        $time_b = strtotime($b);
        return $time_a - $time_b;
    });
    
    // Find the time slots that have already passed
    $passed_time_slots = array_filter($afternoon_slots, function ($time_slot) use ($current_time) {
        return strtotime($time_slot) < strtotime($current_time);
    });
}

$row_count = 0;
$col_count = 0;

echo '<div class="row pt-5 justify-content-center">';
foreach ($afternoon_slots as $time_slot) {
if ($col_count == 4) {
    echo '</div><div class="row pt-5 justify-content-center">';
    $col_count = 0;
}

if(in_array($time_slot, $unavailable_afternoon)){
    $unavailable = 'disabled';
  } else {
    $unavailable = '';
  }
  
echo '<div class="col-6 col-sm-auto col-lg-2 mt-2 mt-md-0 d-flex justify-content-center">
                        
<label class="radio w-100 justify-content-center d-flex">
  <input type="radio" name="time_slot" id="time_slot" value="' . $time_slot . '" required ' . $unavailable . '/>

  <div class="row justify-content-between radioVisitTime px-2 py-1 align-items-center"
    id="pickVisitTime">

    <div class="col-12">
      <span class="requestVisitTime"><i class="fa-regular fa-clock-eight me-2"></i>' . $time_slot . '</span>
    </div>

  </div>
</label>
</div>';
$col_count++;
}
echo '</div>';
?>