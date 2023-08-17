<?php 
use Models\Property;
include "../../init.php";
include ("../session.php");

$landlord_id = $_GET['landlord_id']??null;
try {
	if (isset($landlord_id)) {

        $landlord = new Property('','', '', '', '','','','','', '', '', '','','','');
        $landlord->setConnection($connection);
        $landlord->getById($landlord_id);
        $landlord->deleteLandlord();

        header("Location: index.php");
        exit();
	}
}

catch (Exception $e) {
	echo "<script>window.location.href='index.php?error='" . $e->getMessage() . ";</script>";
        exit();
}   