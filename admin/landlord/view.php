<?php

include "../../init.php";
use Models\Landlord;

    $landlord_id = $_GET['landlord_id'];
    $landlord = new Landlord('', '', '', '', '','','','','','','','','','','');
    $landlord->setConnection($connection);
    $landlord->getById($landlord_id);

    $landlord_id = $landlord->getId();
    $first_name = $landlord->getFirstName();
    $last_name = $landlord->getLastName();
    $contact_number = $landlord->getContactNumber();
    $email = $landlord->getEmail();
    $password = $landlord->getPassword();
    $birthdate = $landlord->getBirthdate();
    $street_address = $landlord->getStreetAddress();
    $barangay = $landlord->getBarangay();
    $city = $landlord->getCity();
    $postal_code = $landlord->getPostalCode();
    $id_type = $landlord->getIdType();
    $id_picture_path = $landlord->getIdPicture();
?>

<div class="container-fluid">
	<form action="edit.php" method="POST" id="manage-tenant">
		<input type="hidden" name="landlord_id" value="<?php echo isset($landlord_id) ? $landlord_id : '' ?>">
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
				<label for="" class="control-label">id_type</label>
				<input type="text" class="form-control" name="id_type"  value="<?php echo isset($id_type) ? $id_type :'' ?>" required>
			</div>
			<div class="col-md-4">
				<label for="" class="control-label">id_picture_path</label>
				<input type="text" class="form-control" name="id_picture_path"  value="<?php echo isset($id_picture_path) ? $id_picture_path :'' ?>" required>
			</div>
			<div class="col-md-4">
				<label for="" class="control-label">picture_path</label>
				<input type="text" class="form-control" name="picture_path"  value="<?php echo isset($picture_path) ? $picture_path :'' ?>">
			</div>
		</div>
        <button class="btn btn-sm btn-outline-danger delete_tenant" type="submit">Update</button>
	</form>
</div>

<?php 
