<?php 
include "../../init.php";
include ("../session.php");
use Models\Auth;
use Models\User;

?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="style.css">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<title>Admin Dashboard</title>
</head>

<body>
<nav>
<div class="container-fluid">
<ul class="nav nav-pills nav-justified">
  <li style="background-color: #FFF8DC"><a  href="../index.php">Dashboard</a></li>
  <li style="background-color: #FAF0E6"><a  href="../landlord/index.php">Manage Landlords</a></li>
  <li class="active" style="background-color: #FFFAF0"><a  href="index.php">Manage Users</a></li>
  <li style="background-color: #FFFACD"><a  href="../property/index.php">Manage Properties</a></li>
  <li style="background-color: #FAFAF0"><a  href="../application-request/index.php">Application Requests</a></li>
</ul>
<a href="../../logout.php">Logout</a>
</nav>

    <form id="registration-form" action="add.php" method="post">
        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" name="first_name" required><br>
        
        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="last_name" required><br>

        <label for="contact_number">Contact Number:</label>
        <input type="text" id="contact_number" name="contact_number" required>
        <span id="contact-error" style="color: red;"></span><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><span id="email-exist" style="color: red;"></span><br>
        <span id="email-error" style="color: red;"></span><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>
        <span id="password-error" style="color: red;"></span><br>

        <label for="confpass">Confirm Password:</label>
        <input type="password" id="confpass" name="confpass" required><br>
        <span id="confpass-error" style="color: red;"></span><br>
        
        <input type="submit" value="Add Landlord" id="submit" disabled>
    </form>
    <script src="email-validation.js"></script>
	<script src="contact-validate.js"></script>
    <script src="form-validate.js"></script>
</body>
</html>

<?php
try {
    if(isset($_POST['first_name'], $_POST['last_name'], $_POST['contact_number'], $_POST['email'], $_POST['password'])){
		
        $email = new Auth();
        $email->setConnection($connection);
        $email = $email->login($_POST['email']);
        
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $contact_number = $_POST['contact_number'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $salt = bin2hex(random_bytes(16));
        $hashedPassword = hash('sha256', $password . $salt);

        $landlord = new User('','','','','','','','');
        $landlord->setConnection($connection);
        $landlord = $landlord->addUser($first_name, $last_name, $contact_number, $email, $hashedPassword, $salt);

        if($landlord != NULL){
            echo '<script>alert("Added User Successfully")</script>';
            exit();
        }
        else {
            echo '<script>alert("Failed Registration")</script>';
        }
    }
}

catch (Exception $e) {
    
}
?>