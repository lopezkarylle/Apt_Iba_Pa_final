<?php 
include "../../init.php";
use Models\Reservation;

try {
    if(isset($_POST['confirm_reservation'])){
        $array_values = $_POST['reservation_id'];
        $reservation_id = explode(",", $array_values);
        var_dump($reservation_id);

        foreach($reservation_id as $id){
            $reservation = new Reservation('','','','','');
            $reservation->setConnection($connection);
            $reservation = $reservation->acceptReservation($id);
        }

        // Determine the result and set a message
        $result = ($reservation) ? 'success_confirm' : 'failed_confirm';

        // Redirect with a query parameter
        header("Location: index.php?result=$result");
        exit();
    } 
    
    elseif (isset($_POST['decline_reservation'])){
        $array_values = $_POST['reservation_id'];
        $reservation_id = explode(",", $array_values);
        var_dump($reservation_id);

        foreach($reservation_id as $id){
            $reservation = new Reservation('','','','','');
            $reservation->setConnection($connection);
            $reservation = $reservation->declineReservation($id);
        }

        // Determine the result and set a message
        $result = ($reservation) ? 'success_confirm' : 'failed_confirm';

        // Redirect with a query parameter
        header("Location: index.php?result=$result");
        exit();        
    }
} 

catch (Exception $e) {
	echo "<script>window.location.href='index.php?error='" . $e->getMessage() . ";</script>";
        exit();
}   