<?php 
use Models\User;
include "../../init.php";
include ("../session.php");
 
    try {
        if ((isset($_GET['user_id']))) {
            $user_id = $_GET['user_id'];

            $landlord = new User('','','','','','','','');
            $landlord->setConnection($connection);
            $landlord->getById($user_id);

            $user_id = $landlord->getId();
            $first_name = $landlord->getFirstName();
            $last_name = $landlord->getLastName();
            $contact_number = $landlord->getContactNumber();
            $email = $landlord->getEmail();
            $password = $landlord->getPassword();
            $salt = $landlord->getSalt();
        }
    }
    catch (Exception $e) {
        echo "<script>window.location.href='index.php?error='" . $e->getMessage() . ";</script>";
            exit();
    }  
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
  <li class="active" style="background-color: #FAF0E6"><a  href="index.php">Manage Landlords</a></li>
  <li style="background-color: #FFFAF0"><a  href="../user/index.php">Manage Users</a></li>
  <li style="background-color: #FFFACD"><a  href="../property/index.php">Manage Properties</a></li>
  <li style="background-color: #FAFAF0"><a  href="../application-request/index.php">Application Requests</a></li>
</ul>
<a href="../../logout.php">Logout</a>
</nav>

<div class="container-fluid">
	<form action="edit.php" method="POST">
		<input type="hidden" name="user_id" value="<?php echo isset($user_id) ? $user_id : '' ?>">
		<div class="row form-group">
            <div class="col-md-4">
				<label for="" class="control-label">First Name</label>
				<input type="text" class="form-control" name="first_name"  value="<?php echo isset($first_name) ? $first_name :'' ?>" required>
			</div>
		    <div class="col-md-4">
				<label for="" class="control-label">Last Name</label>
				<input type="text" class="form-control" name="last_name"  value="<?php echo isset($last_name) ? $last_name :'' ?>" required>
			</div>
            <div class="col-md-4">
				<label for="" class="control-label">Contact Number</label>
				<input type="text" class="form-control" name="contact_number"  value="<?php echo isset($contact_number) ? $contact_number :'' ?>" required>
                <span id="contact-error" style="color: red;"></span>
			</div>
		</div>
		<div class="form-group row">
			<div class="col-md-4">
				<label for="" class="control-label">Email</label>
                <input type="hidden" class="form-control" id="existingEmail" name="existingEmail"  value="<?php echo isset($email) ? $email :'' ?>" required>
				<input type="email" class="form-control" id="email" name="email"  value="<?php echo isset($email) ? $email :'' ?>" required>
                <span id="email-exist" style="color: red;"></span>
			</div>
			<button type="button" id="change-password-button">Change Password</button><br>
                        <div id="password-fields" style="display: none;">
                                <label for="new_password">New Password:</label>
                                <input type="password" id="password" name="new_password"><br>
                                <span id="password-error" style="color: red;"></span><br>

                                <label for="confirm_password">Confirm New Password:</label>
                                <input type="password" id="confirm_password" name="confirm_password"><br>
								<span id="confpass-error" style="color: red;"></span><br>
                        </div>
		</div>
        <button class="btn btn-sm btn-outline-danger" name="update_user" id="submit" type="submit">Update</button>
	</form>
</div>
<script src="email-validation-edit.js"></script>
<script src="form-validate-edit.js"></script>
<script src="contact-validate.js"></script>

</body>
</html>

<?php
try {
	if ((isset($_POST['update_user']))&& (isset($_POST['user_id']))) {
        
        $user_id = $_POST['user_id'];
        //var_dump($user_id);
        $update = new User('','','','','','','','');
        $update->setConnection($connection);
        $update->getById($user_id);
    
        $password = $update->getPassword();
        $salt = $update->getSalt();

        $user_id = $_POST['user_id'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $contact_number = $_POST['contact_number'];
        $email = $_POST['email'];
        
        if(isset($_POST['new_password']) && $_POST['new_password']!='')
        {
            $new_password = $_POST['new_password'];
            $salt = bin2hex(random_bytes(16));
            $password = hash('sha256', $password . $salt);
        }else{
            $password = $password;
        }
        
        $update->updateUser($user_id, $first_name, $last_name, $contact_number, $email, $password, $salt);
        echo "<script>window.location.href='edit.php?user_id=$user_id';</script>";
        exit();
	}
}
catch (Exception $e) {
	echo "<script>window.location.href='index.php?error='" . $e->getMessage() . ";</script>";
        exit();
}  
?>