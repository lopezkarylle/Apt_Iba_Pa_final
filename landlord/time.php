<?php
use Models\DateTime;

include ("../init.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if(isset($_POST['date'])){
        $date = $_POST['date'];
        $formattedDate = "'$date'";
        $property_id = 1;
        $time = new DateTime('','','');
        $time->setConnection($connection);
        $time = $time->getAllTime($formattedDate, $property_id);
        //var_dump($time);
        //print_r ($time);
    }
}
?>