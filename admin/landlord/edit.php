<?php 
include "../../init.php";
use Models\Landlord;

try {
	if (isset($_POST['landlord_id'])) {
        $landlord_id = $_POST['landlord_id'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $contact_number = $_POST['contact_number'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $birthdate = $_POST['birthdate'];
        $street_address = $_POST['street_address'];
        $barangay = $_POST['barangay'];
        $city = $_POST['city'];
        $postal_code = $_POST['postal_code'];
        $id_type = $_POST['id_type'];
        $id_picture_path = $_POST['id_picture_path'];
        $picture_path = $_POST['picture_path'];

        $landlord = new Landlord('', '', '', '','','','','','','','','','','');
        $landlord->setConnection($connection);
        $landlord->getById($landlord_id);

        $landlord->updateLandlord($landlord_id, $first_name, $last_name, $contact_number, $email, $password, $birthdate, $street_address, $barangay, $city, $postal_code, $id_type, $id_picture_path, $picture_path);
        
        header("Location: view.php?landlord_id=" . $landlord_id);
        exit();
	}
}

catch (Exception $e) {
	echo "<script>window.location.href='index.php?error='" . $e->getMessage() . ";</script>";
        exit();
}   