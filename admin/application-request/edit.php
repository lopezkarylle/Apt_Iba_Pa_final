<?php 
include "../../init.php";
use Models\User;

try {
	if (isset($_POST['user_id'])) {

		$user_id = $_POST['user_id'];
		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$contact_number = $_POST['contact_number'];
		$email = $_POST['email'];
		$password = $_POST['password'];

		$user = new User('', '', '', '','','','');
		$user->setConnection($connection);
		$user->getById($user_id);
		$user->updateUser($first_name, $last_name, $contact_number, $email, $password);
		
		header("Location: view.php?user_id=" . $user_id);
		exit();
		}
	
}

catch (Exception $e) {
	echo "<script>window.location.href='index.php?error='" . $e->getMessage() . ";</script>";
        exit();
}   