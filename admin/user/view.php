<?php

include "../../init.php";
use Models\User;

    $user_id = $_GET['user_id'];
    $user = new User('', '', '', '', '','','','','','','','');
    $user->setConnection($connection);
    $user->getById($user_id);

    $user_id = $user->getId();
    $first_name = $user->getFirstName();
    $last_name = $user->getLastName();
    $contact_number = $user->getContactNumber();
    $email = $user->getEmail();
    $password = $user->getPassword();
    $birthdate = $user->getBirthdate();
    $street_address = $user->getStreetAddress();
    $barangay = $user->getBarangay();
    $city = $user->getCity();
    $postal_code = $user->getPostalCode();
    $picture_path = $user->getPicturePath();
?>

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
			<div class="col-md-4">
				<label for="" class="control-label">bday</label>
				<input type="text" class="form-control" name="birthdate"  value="<?php echo isset($birthdate) ? $birthdate :'' ?>" required>
			</div>
		</div>
        <div class="form-group row">
			<div class="col-md-4">
				<label for="" class="control-label">street</label>
				<input type="text" class="form-control" name="street_address"  value="<?php echo isset($street_address) ? $street_address :'' ?>" required>
			</div>
			<div class="col-md-4">
				<label for="" class="control-label">brgy</label>
				<input type="text" class="form-control" name="barangay"  value="<?php echo isset($barangay) ? $barangay :'' ?>" required>
			</div>
			<div class="col-md-4">
				<label for="" class="control-label">city</label>
				<input type="text" class="form-control" name="city"  value="<?php echo isset($city) ? $city :'' ?>" required>
			</div>
            <div class="col-md-4">
				<label for="" class="control-label">postal</label>
				<input type="text" class="form-control" name="postal_code"  value="<?php echo isset($postal_code) ? $postal_code :'' ?>" required>
			</div>
		</div>
        <div class="form-group row">
            <div class="col-md-4">
                <?php if (isset($picture_path)) { ?>hahaha
				<img src="../../resources/images/users/<?php echo isset($picture_path) ? $picture_path :'' ?>" height="50" width="50" alt="wala">
			</div>
			<div class="col-md-4">
				<label for="" class="control-label">upload image</label>
				<input type="file" class="form-control" name="new_picture" value="<?php echo isset($picture_path) ? $picture_path :'' ?>">
			</div>
                <?php } else { ?>hehehe
            <div class="col-md-4">
				<label for="new_picture" class="control-label">upload image</label>
				<input type="file" class="form-control" name="new_picture" value="">
			</div>
                <?php } ?>
		</div>
        <button class="btn btn-sm btn-outline-danger" type="submit">Update</button>
	</form>
</div>

<?php 
