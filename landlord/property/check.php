<?php

use Models\Property;
include "../../init.php";
//include ("../../session.php");


try {
    if(isset($_POST['rooms'])){

        $total_beds = $_POST['total_beds'];
        $monthly_rent = $_POST['monthly_rent'];
        $furnished_type = $_POST['furnished_type'];
        $selected_amenities = $_POST['selected_amenities'];
        $amenities = json_decode($selected_amenities, true);
        //var_dump($amenities[0]);

        for($i=0; $i<count($total_beds); $i++){
            $room_amenities = $amenities[$i];
            $room_amenities_csv = implode(",", $room_amenities);
        }
    }
} catch (Exception $e) {
    echo "<script>window.location.href='index.php?error='" . $e->getMessage() . ";</script>";
    exit();
}

