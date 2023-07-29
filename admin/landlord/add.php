<?php

include "../../init.php";
use Models\Landlord;

?>

<div class="container-fluid">
	<form action="add.php" method="POST" id="manage-tenant">
		<div class="row form-group">
            <div class="col-md-4">
				<label for="" class="control-label">First Name</label>
				<input type="text" class="form-control" name="first_name" required>
			</div>
		    <div class="col-md-4">
				<label for="" class="control-label">Last Name</label>
				<input type="text" class="form-control" name="last_name" required>
			</div>
            <div class="col-md-4">
				<label for="" class="control-label">Contact #</label>
				<input type="text" class="form-control" name="contact_number" required>
			</div>
		</div>
		<div class="form-group row">
			<div class="col-md-4">
				<label for="" class="control-label">Email</label>
				<input type="email" class="form-control" name="email" required>
			</div>
			<div class="col-md-4">
				<label for="" class="control-label">pass</label>
				<input type="text" class="form-control" name="password" required>
			</div>
			<div class="col-md-4">
				<label for="" class="control-label">bday</label>
				<input type="text" class="form-control" name="birthdate" required>
			</div>
		</div>
        <div class="form-group row">
			<div class="col-md-4">
				<label for="" class="control-label">street</label>
				<input type="text" class="form-control" name="street_address" required>
			</div>
			<div class="col-md-4">
				<label for="" class="control-label">brgy</label>
				<input type="text" class="form-control" name="barangay" required>
			</div>
			<div class="col-md-4">
				<label for="" class="control-label">city</label>
				<input type="text" class="form-control" name="city" required>
			</div>
            <div class="col-md-4">
				<label for="" class="control-label">postal</label>
				<input type="text" class="form-control" name="postal_code" required>
			</div>
		</div>
        <div class="form-group row">
			<div class="col-md-4">
				<label for="" class="control-label">id_type</label>
				<input type="text" class="form-control" name="id_type" required>
			</div>
			<div class="col-md-4">
				<label for="" class="control-label">id_picture_path</label>
				<input type="text" class="form-control" name="id_picture_path" required>
			</div>
			<div class="col-md-4">
				<label for="" class="control-label">picture_path</label>
				<input type="text" class="form-control" name="picture_path">
			</div>
		</div>
        <button class="btn btn-sm btn-outline-danger delete_tenant" type="submit">Add</button>
	</form>
</div>

<?php 
try {
    if(isset($_POST['first_name'])){
        $landlord = new Landlord($_POST['first_name'], $_POST['last_name'], $_POST['contact_number'], $_POST['email'], $_POST['password'], $_POST['birthdate'], $_POST['street_address'], $_POST['barangay'], $_POST['city'], $_POST['postal_code'], $_POST['id_type'], $_POST['id_picture_path'],$_POST['picture_path'],1);
        $landlord->setConnection($connection);
        $student_added = $landlord->addLandlord();
        var_dump($student_added);
        echo "<script>window.location.href='index.php?success=1';</script>";
        exit();
    }
} catch (Exception $e) {
    echo "<script>window.location.href='index.php?error='" . $e->getMessage() . ";</script>";
    exit();
}