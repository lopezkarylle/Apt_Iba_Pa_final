<?php

include "../../init.php";
use Models\User;

    $user_id = $_GET['user_id'];
    $user = new User('', '', '', '', '','','');
    $user->setConnection($connection);
    $user->getById($user_id);

    $user_id = $user->getId();
    $first_name = $user->getFirstName();
    $last_name = $user->getLastName();
    $contact_number = $user->getContactNumber();
    $email = $user->getEmail();
    $password = $user->getPassword();
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
	<title>Users</title>
</head>
<body>

<div class="container-fluid">
<ul class="nav nav-pills nav-justified">
  <li style="background-color: #FFF8DC"><a  href="../home.php">Dashboard</a></li>
  <li style="background-color: #FAF0E6"><a  href="../landlord/index.php">Manage Landlords</a></li>
  <li class="active" style="background-color: #FFFAF0"><a  href="index.php">Manage Users</a></li>
  <li style="background-color: #FFFACD"><a  href="../property/index.php">Manage Properties</a></li>
  <li style="background-color: #FAFAF0"><a  href="../application-request/index.php">Application Requests</a></li>
</ul>
</nav>

<div class="container-fluid">
	<form action="edit.php" method="POST" enctype="multipart/form-data">
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
				<label for="" class="control-label">Contact #</label>
				<input type="text" class="form-control" name="contact_number"  value="<?php echo isset($contact_number) ? $contact_number :'' ?>" required>
			</div>
		</div>
		<div class="form-group row">
			<div class="col-md-4">
				<label for="" class="control-label">Email</label>
				<input type="email" class="form-control" name="email"  value="<?php echo isset($email) ? $email :'' ?>" required>
			</div>
			<div class="col-md-4">
				<label for="" class="control-label">pass</label>
				<input type="text" class="form-control" name="password"  value="<?php echo isset($password) ? $password :'' ?>" required>
			</div>
		</div>
        <button class="btn btn-sm btn-outline-danger" type="submit">Update</button>
	</form>
</div>
</body>
</html>
<?php 
