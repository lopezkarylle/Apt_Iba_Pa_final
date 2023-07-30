<?php 
include "../../init.php";
use Models\User;

$user_id = $_GET['user_id']??null;
try {
	if (isset($user_id)) {

        $user = new user('', '', '', '','','','','','','','');
        $user->setConnection($connection);
        $user->getById($user_id);
        $user->deleteUser();

        header("Location: index.php");
        exit();
	}
}

catch (Exception $e) {
	echo "<script>window.location.href='index.php?error='" . $e->getMessage() . ";</script>";
        exit();
}   