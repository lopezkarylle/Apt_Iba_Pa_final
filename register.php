<?php 
include ("init.php");
use Models\Auth;
use Models\User;
session_start();

$last_page = isset($_POST['last_page'])

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
<title>Register | Apt Iba Pa</title>
</head>

<body>
<div class="container-fluid">

<div class="container">
    <h3 style="font-weight: bold; text-align: center;">Create an account</h3><hr><br><br>
    <form id="registration-form" action="register.php" method="POST">
        <label for="first_name">First Name:</label>
        <input type="text" class="form-control" id="first_name" name="first_name" required><br>
        
        <label for="last_name">Last Name:</label>
        <input type="text" class="form-control" id="last_name" name="last_name" required><br>

        <label for="contact_number">Contact Number:</label>
        <input type="text" class="form-control" id="contact_number" name="contact_number" required>
        <span id="contact-error" style="color: red;"></span><br>

        <label for="email">Email:</label>
        <input type="email" class="form-control" id="email" name="email" required><span id="email-exist" style="color: red;"></span><br>
        <span id="email-error" style="color: red;"></span><br>

        <label for="password">Password:</label>
        <input type="password" class="form-control" id="password" name="password" required><br>
        <span id="password-error" style="color: red;"></span><br>

        <label for="confpass">Confirm Password:</label>
        <input type="password" class="form-control" id="confpass" name="confpass" required><br>
        <span id="confpass-error" style="color: red;"></span><br>
        
        <input type="submit" class="btn btn-primary btn-block" value="Register" id="submit" disabled>

        <div class="form-group">
            Already have an account? <a href="login.php">Login</a> 
        </div>
    </form>
</div>
    <script src="email-validation.js"></script>
	<script src="contact-validate.js"></script>
    <script src="form-validate.js"></script>
</body>
</html>

<?php
try {
    if(isset($_POST['first_name'], $_POST['last_name'], $_POST['contact_number'], $_POST['email'], $_POST['password'])){
        $first_name = ucfirst($_POST['first_name']);
        $last_name = ucfirst($_POST['last_name']);
        $contact_number = $_POST['contact_number'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $salt = bin2hex(random_bytes(16));
        $hashedPassword = hash('sha256', $password . $salt);
        $status = 1;
        
        $register_user = new Auth();
        $register_user->setConnection($connection);
        $register_user = $register_user->registerUser($email, $hashedPassword, $salt);
        
        $user_auth = $register_user['statement'] ?? null;
        $user_id = $register_user['lastInsertedId'] ?? null;

        $register_info = new User();
        $register_info->setConnection($connection);
        $register_info->registerUserInfo($user_id, $first_name, $last_name, $contact_number);

        $_SESSION['user_id'] = $user_id;

        // if($user_auth != NULL && $user_id != NULL){
        //     header('location:' . $last_page);
        //     exit();
        // }
        if($user_auth != NULL && $user_id != NULL){
            header('location:index.php');
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