<?php 
include "../../init.php";
include ("../session.php");
use Models\Auth;
use Models\User;
use Models\UserImage;

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

        <label for="image">Image:</label>
        <input type="file" id="image" name="image"><br>
        
        <input type="submit" value="Add User" id="submit" disabled>
    </form>
    <script src="email-validation.js"></script>
	<script src="contact-validate.js"></script>
    <script src="form-validate.js"></script>
</body>
</html>

<?php
try {
    if(isset($_POST['first_name'], $_POST['last_name'], $_POST['contact_number'], $_POST['email'], $_POST['password'],)){
        
        $email = $_POST['email'];
        $password = $_POST['password'];
        $salt = bin2hex(random_bytes(16));
        $hashedPassword = hash('sha256', $password . $salt);
        $status = 1;

        $user_auth = new Auth();
        $user_auth->setConnection($connection);
        $user_auth = $user_auth->registerUser($email, $hashedPassword, $salt, $status);
        
        $user_id = $user_auth['lastInsertedId'];
        $first_name = ucfirst($_POST['first_name']);
        $last_name = ucfirst($_POST['last_name']);
        $contact_number = $_POST['contact_number'];

        if(isset($_FILES['image'])){
            $image_name = $_FILES['image']['name'];
            $temp_name = $_FILES['image']['tmp_name'];

            if (!is_uploaded_file($temp_name)) {
            echo 'The file was not uploaded correctly.';
            exit;
            }

            $uploadDirectory = "../../resources/images/users/";
            $targetFilePath = $uploadDirectory . basename($image_name);

            // Check if the file name already exists
            if (file_exists($targetFilePath)) {
              // Generate a new file name
              $image_name = uniqid() . '_' . $image_name;
              $targetFilePath = $uploadDirectory . basename($image_name);
            }

            move_uploaded_file($temp_name, $targetFilePath);

            $image = new UserImage();
            $image->setConnection($connection);
            $image->addImage($user_id, $image_name, $uploadDirectory, $status);
        }
        
        $user = new User();
        $user->setConnection($connection);
        $user = $user->addUser($user_id, $first_name, $last_name, $contact_number, $status);

        if($user != NULL){
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