<?php

include "../../init.php";
use Models\Landlord;

?>

<div class="container-fluid">
	<form action="add.php" method="POST" enctype="multipart/form-data">
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
				<input type="file" class="form-control" name="id_picture_path" required>
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

		$target_dir = "../../resources/images/users/";
		$target_file = $target_dir . basename($_FILES["id_picture_path"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

		// Check if image file is a actual image or fake image
		if(isset($_POST["submit"])) {
		$check = getimagesize($_FILES["id_picture_path"]["tmp_name"]);
		if($check !== false) {
			echo "File is an image - " . $check["mime"] . ".";
			$uploadOk = 1;
		} else {
			echo "File is not an image.";
			$uploadOk = 0;
		}
		}

		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
		echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		$uploadOk = 0;
		}

		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
		echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
		if (move_uploaded_file($_FILES["id_picture_path"]["tmp_name"], $target_file)) {
			echo "The file ". htmlspecialchars( basename( $_FILES["id_picture_path"]["name"])). " has been uploaded.";
		} else {
			echo "Sorry, there was an error uploading your file.";
		}
		}

		//$pic = $_POST['id_picture_path'];
		//var_dump($target_file);
        $landlord = new Landlord($_POST['first_name'], $_POST['last_name'], $_POST['contact_number'], $_POST['email'], $_POST['password'], $_POST['birthdate'], $_POST['street_address'], $_POST['barangay'], $_POST['city'], $_POST['postal_code'], $_POST['id_type'], $target_file, $_POST['picture_path'],1);
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