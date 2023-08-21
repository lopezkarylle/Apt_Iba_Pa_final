<?php 
include "../../init.php";
include ("../session.php");
use Models\Auth;
use Models\User;
use Models\UserImage;

try {
    if ((isset($_GET['user_id']))) {
        $user_id = $_GET['user_id'];

        $user = new User('','','','','');
        $user->setConnection($connection);
        $user = $user->getById($user_id);
        
        $user_id = $user['user_id'];
        $first_name = $user['first_name'];
        $last_name = $user['last_name'];
        $contact_number = $user['contact_number'];

        $email = $user['email'];
        $password = $user['password'];
        $salt = $user['salt'];

        $user_image_name = $user['image_name'] ?? NULL;
        $user_image_path = $user['image_path'] ?? NULL;
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
  <li style="background-color: #FAF0E6"><a  href="../landlord/index.php">Manage Landlords</a></li>
  <li class="active" style="background-color: #FFFAF0"><a  href="index.php">Manage Users</a></li>
  <li style="background-color: #FFFACD"><a  href="../property/index.php">Manage Properties</a></li>
  <li style="background-color: #FAFAF0"><a  href="../application-request/index.php">Application Requests</a></li>
</ul>
<a href="../../logout.php">Logout</a>
</nav>

<div class="container-fluid">
	<form action="edit.php" method="POST" enctype="multipart/form-data">
		<input type="hidden" name="user_id" value="<?php echo isset($user_id) ? $user_id : '' ?>">
		<div class="row form-group">
            <div class="col-md-4">
                <?php if(isset($user_image_name)){?>
                <input type="hidden" name="user_image_name" value="<?php echo $user_image_name ?>">
                <img src="<?php echo $user_image_path . $user_image_name ?>" height="100" width="100">
                <?php } ?>
                <input type="file" id="image" name="image"/>
            </div>
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
	if ((isset($_POST['update_user'])) && (isset($_POST['user_id']))) {
        
        $user_id = $_POST['user_id'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $contact_number = $_POST['contact_number'];
        $email = $_POST['email'];
        
        $update = new User('','','','','');
        $update->setConnection($connection);
        $update->updateUser($user_id, $first_name, $last_name, $contact_number);
        
        $account = new Auth();
        $account->setConnection($connection);
        $account_details = $account->getAccount($user_id);

        $password = $account_details['password'];
        $salt = $account_details['salt'];

        if(isset($_POST['new_password']) && $_POST['new_password']!='')
        {
            $new_password = $_POST['new_password'];

            $salt = bin2hex(random_bytes(16));
            $password = hash('sha256', $new_password . $salt);
        }

        $account->updateAccount($user_id, $email, $password, $salt);

        if(isset($_FILES['image'])){
            $image_name = $_FILES['image']['name'];
            $temp_name = $_FILES['image']['tmp_name'];
            
            $image = new UserImage();
            $image->setConnection($connection);

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

            if(!isset($_POST['user_image_name'])){
                $image->addImage($user_id, $image_name, $uploadDirectory);
            } else {
                $image->updateImage($user_id, $image_name, $uploadDirectory);
            }
            
        }
        
        echo "<script>window.location.href='edit.php?user_id=$user_id';</script>";
        exit();
	}
}
catch (Exception $e) {
	echo "<script>window.location.href='index.php?error='" . $e->getMessage() . ";</script>";
        exit();
}  
?>