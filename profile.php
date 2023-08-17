<?php
use Models\Property;
include ("init.php");
include ("session.php");

if(!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 2){
    echo "<script>window.location.href='index.php';</script>";
    exit();
}

$user_id = $_SESSION['user_id'] ?? NULL;

$user = new User('','','','','','','','');
$user->setConnection($connection);
$user = $user->getById($user_id);

$first_name = $this->getFirstName();
$last_name = $this->getLastName();
$contact_number = $this->getContactNumber();
$email = $this->getEmail();
$password = $this->getPassword();
?>

<input type="text" value="<?php $first_name ?>">
<input type="text" value="<?php $last_name ?>">
<input type="text" value="<?php $contact_number ?>">
<input type="text" value="<?php $email ?>">
<input type="text" value="<?php $password ?>">