<?php
    use Models\Property;
    use Models\Unit;
    include "../init.php";
    include "session.php";

    if(isset($_POST['property_id'], $_POST['unit_id'], $_POST['available_units'])){
        $property_id = $_POST['property_id'];
        $unit_id = $_POST['unit_id'];
        $available_units = $_POST['available_units'];


        $occupy = new Unit();
        $occupy->setConnection($connection);
        $check_total = $occupy->getUnit($unit_id);
        $total = $check_total['total_units'];
        $occupied_units = intval($total) - intval($available_units);

        $occupy->occupyUnit($unit_id, $property_id, $occupied_units);
    }
?>