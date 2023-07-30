<?php 
include "../../init.php";
use Models\User;

try {
	if (isset($_POST['user_id'])) {
		$dmp = $_POST['new_picture'];
		var_dump($dmp);
		if(($_POST['new_picture'])!=''){
            
            $folder = "../../resources/images/users/";
            $image_file=$_FILES['new_picture']['name'];
            $file = $_FILES['new_picture']['tmp_name'];
            $path = $folder . $image_file;  
            $target_file=$folder.basename($image_file);
            $imageFileType=pathinfo($target_file,PATHINFO_EXTENSION);
            //Allow only JPG, JPEG, PNG & GIF etc formats
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
            $error[] = 'Sorry, only JPG, JPEG, & PNG files are allowed';   
            }
            //Set image upload size 
                if ($_FILES["new_picture"]["size"] > 1048576) {
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
		} else{
			$image_file = NULL;
		}
			
		$user_id = $_POST['user_id'];
		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$contact_number = $_POST['contact_number'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$birthdate = $_POST['birthdate'];
		$street_address = $_POST['street_address'];
		$barangay = $_POST['barangay'];
		$city = $_POST['city'];
		$postal_code = $_POST['postal_code'];
		$picture_path = $image_file;

		var_dump($picture_path);
		// $user = new User('', '', '', '','','','','','','','','');
		// $user->setConnection($connection);
		// $user->getById($user_id);

		// $user->updateUser($first_name, $last_name, $contact_number, $email, $password, $birthdate, $street_address, $barangay, $city, $postal_code, $picture_path);
		
		// var_dump($user);
		// header("Location: view.php?user_id=" . $user_id);
		// exit();
		}
	
}

catch (Exception $e) {
	echo "<script>window.location.href='index.php?error='" . $e->getMessage() . ";</script>";
        exit();
}   