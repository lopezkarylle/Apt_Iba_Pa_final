<?php 
use Models\User;
include "../../init.php";
include ("../session.php");

$user_id = $_GET['user_id']??null;
try {
	if (isset($user_id)) {

        $landlord = new User('', '', '', '','','','');
        $landlord->setConnection($connection);
        $landlord->getById($user_id);
        $landlord->deleteUser();

        header("Location: index.php");
        exit();
	}
}

catch (Exception $e) {
	echo "<script>window.location.href='index.php?error='" . $e->getMessage() . ";</script>";
        exit();
}   