<?php

use Models\Property;
use Models\Amenity;
use Models\Rule;
use Models\Room;
use Models\Request;
use Models\User;
use Models\Auth;
use Models\Image;
use Models\UserImage;
use Models\Notification;
include "init.php";
include "session.php";

try {
    if(isset($_POST['apply_property'])){


        $user_id = $_POST['user_id'] ?? NULL; 

        //Basic Details
        $property_name = ucfirst($_POST['property_name']); 
        $property_type = $_POST['property_type']; 
        
        //Property Location
        $property_number = $_POST['property_number'];
        $street = ucfirst($_POST['street']);
        $region_text = $_POST['region_text'];
        $province_text = $_POST['province_text'];
        $city_text = $_POST['city_text'];
        $barangay_text = $_POST['barangay_text'];
        $latitude = $_POST['latitude'];
        $longitude = $_POST['longitude'];
        $status = 2;
        

        if($user_id===''){
            //Create account
            $first_name = ucfirst($_POST['first_name']);
            $last_name = ucfirst($_POST['last_name']);
            $contact_number = $_POST['contact_number'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $salt = bin2hex(random_bytes(16));
            $hashedPassword = hash('sha256', $password . $salt);
            

            $register_user = new Auth();
            $register_user->setConnection($connection);
            $register_user = $register_user->registerUser($email, $hashedPassword, $salt, 1);
            
            $user_auth = $register_user['statement'] ?? null;
            $user_id = $register_user['lastInsertedId'] ?? null;

            $register_info = new User('','','','','','');
            $register_info->setConnection($connection);
            $register_info->registerUserInfo($user_id, $first_name, $last_name, $contact_number, 1);
        }

        //Upload user image
        $userImage = $_FILES["picture"] ?? NULL;

        if(isset($userImage)){
                // Get the image properties
                $userImageName = $userImage['name'];
                $userTmpImg = $userImage['tmp_name'];
            
                // Move the uploaded image to a directory on the server
                $uploadDirectory = "resources/images/landlords/";
                $targetFilePath = $uploadDirectory . basename($userImageName);
                move_uploaded_file($userTmpImg, $targetFilePath);
            
                $images = new UserImage();
                $images->setConnection($connection);
                $insert = $images->addImage($user_id, $userImageName, $targetFilePath, $status);

                if($insert){ 
                    $statusMsg = "Images are uploaded successfully."; 
                }else{ 
                    $statusMsg = "Sorry, there was an error uploading your file."; 
                } 
        }

        //Property Details
        $description = $_POST['description'];
        $total_floors = $_POST['total_floors'];
        $room_count = $_POST['total_rooms'];
        $total_rooms = array_sum($room_count);
        $aircon = $_POST['aircon'] ?? 0;
        $cabinet = $_POST['cabinet'] ?? 0;
        $cctv = $_POST['cctv'] ?? 0;
        $drinking_water = $_POST['drinking_water'] ?? 0;
        $elevator = $_POST['elevator'] ?? 0;
        $emergency_exit = $_POST['emergency_exit'] ?? 0;
        $food_hall = $_POST['food_hall'] ?? 0;
        $laundry = $_POST['laundry'] ?? 0;
        $lounge = $_POST['lounge'] ?? 0;
        $microwave = $_POST['microwave'] ?? 0;
        $parking = $_POST['parking'] ?? 0;
        $refrigerator = $_POST['refrigerator'] ?? 0;
        $roof_deck = $_POST['roof_deck'] ?? 0;
        $security = $_POST['security'] ?? 0;
        $sink = $_POST['sink'] ?? 0;
        $study_area = $_POST['study_area'] ?? 0;
        $tv = $_POST['tv'] ?? 0;
        $wifi = $_POST['wifi'] ?? 0;
        
        //Fees
        $electric_bill = $_POST['electric_bill'];
        $water_bill = $_POST['water_bill'];
        $reservation_fee = $_POST['reservation_fee'];
        $advance_deposit = $_POST['advance_deposit'];

        $lowest_rate = 0;
        $rent = $_POST['monthly_rent'];
        foreach($rent as $rate){
            if((intval($rate))>=(intval($lowest_rate))){
                $lowest_rate = $rate;
            }
        }
        
        //add to properties table but status=2=pending
        
        $property = new Property();
        $property->setConnection($connection);
        $property_id = $property->addProperty($property_type, $property_name, $user_id, $total_rooms,$total_floors,$description,$property_number,$street,$region_text,$province_text,$city_text,$barangay_text,$latitude,$longitude,$lowest_rate,$electric_bill,
        $water_bill,$reservation_fee,$advance_deposit, $status);

        //add to property amenities table but status=2=pending
        $property_amenities = new Amenity();
        $property_amenities->setConnection($connection);
        $property_amenities->addAmenities($property_id,$aircon, $cabinet,$cctv,$drinking_water,$elevator,$emergency_exit,$food_hall,$laundry, $lounge, $microwave, $parking,$refrigerator,$roof_deck,$security, $sink,$study_area, $tv,$wifi,$status);

        //add to property rules table but status=2=pending
        $rules = new Rule();
        $rules->setConnection($connection);
        $rules->addRules($property_id, $_POST['short_term'], $_POST['min_weeks'], $_POST['mix_gender'], $_POST['curfew'], $_POST['from_curfew'], $_POST['to_curfew'], $_POST['cooking'], $_POST['pets'], $_POST['visitors'], $_POST['from_visit'], $_POST['to_visit'], $_POST['alcohol'], $_POST['smoking'], $status);

        //Room Details
        $bed_per_room = $_POST['bed_per_room'];
        $type = $_POST['furnished_type']; 
        $rent = $_POST['monthly_rent']; 
        $total_rooms = $_POST['total_rooms']; 
        $occupied_beds = 0;

        for ($x = 0; $x < (count($bed_per_room)); $x++) {
            $bed_count = $bed_per_room[$x];
            if($bed_count===1){
                $room_type='Single Bed Room';
            } elseif($bed_count===2){
                $room_type='Double Bed Room';
            } elseif($bed_count===3){
                $room_type='Triple Bed Room';
            } elseif($bed_count===4){
                $room_type='Quad Bed Room';
            } elseif($bed_count===5){
                $room_type='5-Bed Room';
            } elseif($bed_count===6){
                $room_type='6-Bed Room';
            } elseif($bed_count===7){
                $room_type='7-Bed Room';
            } elseif($bed_count===8){
                $room_type='8-Bed Room';
            }
            $room_total = $total_rooms[$x];
            $total_beds = intval($bed_count) * intval($room_total);
            $furnished_type = $type[$x];
            $monthly_rent = $rent[$x];

            $room = new Room();
            $room->setConnection($connection);
            $room_id = $room->addRoom($property_id, $type_room, $bed_count, $room_total, $total_beds, $occupied_beds, $furnished_type, $monthly_rent, $status);
        }

        $imageData = $_FILES["images"] ?? NULL;

        // Loop through the uploaded images
        if(isset($imageData)){
            for ($i = 0; $i < count($imageData['name']); $i++) {
                // Get the image properties
                $imageName = $imageData['name'][$i];
                $imageTmpName = $imageData['tmp_name'][$i];
                $title = $_POST['add_title'][$i];
            
                // Move the uploaded image to a directory on the server
                $uploadDirectory = "resources/images/properties/";
                $targetFilePath = $uploadDirectory . basename($imageName);
                move_uploaded_file($imageTmpName, $targetFilePath);
            
                $images = new Image();
                $images->setConnection($connection);
                $insert = $images->addImage($property_id, $imageName, $title, $status);

                if($insert){ 
                    $statusMsg = "Images are uploaded successfully."; 
                }else{ 
                    $statusMsg = "Sorry, there was an error uploading your file."; 
                } 
            }
        }

        $request = new Request();
        $request->setConnection($connection);
        $request = $request->addRequest($user_id, $property_id, $status);
        //add success message

        $admin_id = 22;
        $notification_text = 'An application has been made for the property ' . $property_name . ' by the user ' . $first_name . ' ' . $last_name;
        $notification_type = 'application';
        $isRead = 0;
        $status = 1;

        $notification = new Notification();
        $notification->setConnection($connection);
        $notification->sendNotification($admin_id, $notification_text, $notification_type, $isRead, $status);

        echo "<script>window.location.href='index.php?success=1';</script>";
        exit();
    } else {
        echo "<script>alert('Failed to add property. Please check your inputs.</script>";
    }
} catch (Exception $e) {
    echo "<script>window.location.href='index.php?error='" . $e->getMessage() . ";</script>";
    exit();
}
