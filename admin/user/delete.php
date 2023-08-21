<?php 
include "../../init.php";
include ("../session.php");

use Models\User;
use Models\Auth;
use Models\UserImage;

$user_id = $_GET['user_id']??null;
try {
	if (isset($user_id)) {

        $landlord = new User('','','','','');
        $landlord->setConnection($connection);
        $landlord->deleteUser($user_id);

        $users = new Auth();
        $users->setConnection($connection);
        $users->deleteAccount($user_id);

        $image = new UserImage();
        $image->setConnection($connection);
        $image->deleteImage($user_id);

        header("Location: index.php");
        exit();
	}
}

catch (Exception $e) {
	echo "<script>window.location.href='index.php?error='" . $e->getMessage() . ";</script>";
        exit();
}   