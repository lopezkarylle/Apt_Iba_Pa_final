<!-- Change appointment time based on selected date -->
<?php 
use Models\Schedule; //remove when included in php page
use Models\Appointment; //remove when included in php page

$property_id = $_SESSION['property_view_id'];
$disabled_dates = [];
$date_time = new Schedule('','','');
$date_time->setConnection($connection);
$date_time = $date_time->getDateTime($property_id);

foreach($date_time as $date_item){
  $unavailable_date = $date_item['date'];
  $time_list = $date_item['time'];
  $time_list = explode(",", $time_list);
  if ((count($time_list))===21){
    $disabled_dates[]=$unavailable_date;
  }
}

//var_dump($disabled_dates);

?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
