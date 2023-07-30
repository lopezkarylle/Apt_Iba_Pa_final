<?php

include "../../init.php";
use Models\User;

?>
<html>
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
				<label for="" class="control-label">picture_path</label>
				<input type="file" class="form-control" name="picture_path">
			</div>
		</div>
        <button class="btn btn-sm btn-outline-danger" name="form_submit" type="submit">Add</button>
	</form>
</div> 
</html>

<?php
try {
    if(isset($_POST['form_submit'])) {
        if(is_uploaded_file($_FILES['picture_path']['name'])){
            
            $folder = "../../resources/images/users/";
            $image_file=$_FILES['picture_path']['name'];
            $file = $_FILES['picture_path']['tmp_name'];
            $path = $folder . $image_file;  
            $target_file=$folder.basename($image_file);
            $imageFileType=pathinfo($target_file,PATHINFO_EXTENSION);
            //Allow only JPG, JPEG, PNG & GIF etc formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            $error[] = 'Sorry, only JPG, JPEG, & PNG files are allowed';   
            }
            //Set image upload size 
                if ($_FILES["picture_path"]["size"] > 1048576) {
            $error[] = 'Sorry, your image is too large. Upload less than 1 MB KB in size.';
            }
            if(!isset($error))
            {
                // move image in folder 
            move_uploaded_file($file,$target_file); 

            }
            
            if(isset($error)){ 

            foreach ($error as $error) { 
                echo '<div class="message">'.$error.'</div><br>'; 	
            }
            }
            $user = new User($_POST['first_name'], $_POST['last_name'], $_POST['contact_number'], $_POST['email'], $_POST['password'], $_POST['birthdate'], $_POST['street_address'], $_POST['barangay'], $_POST['city'], $_POST['postal_code'], $image_file, 1);
            $user->setConnection($connection);
            $user_added = $user->addUser();
            //var_dump($user_added);
            header("Location: index.php");
            //echo "<script>window.location.href='index.php?success=1';</script>";
            exit();
            }
    } 
    }
 catch (Exception $e) {
    echo "<script>window.location.href='index.php?error='" . $e->getMessage() . ";</script>";
    exit();
}