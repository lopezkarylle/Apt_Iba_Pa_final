<?php

use Models\Bookmark;

include "init.php";
include "session.php";

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
    if(isset($_POST['property_id'])){
         $property_id = $_POST['property_id'];
         $current_status = $_POST['status'];
        //$property_id = 26;
        //$current_status = 1;
        //var_dump($current_status==1);
        if($current_status==0){
            $status = 1;
            $bookmark = new Bookmark();
            $bookmark->setConnection($connection);
            $bookmark = $bookmark->addBookmark($property_id, $user_id, $status);
            echo 1;
        }elseif($current_status==1){
            $status = 2;
            $bookmark = new Bookmark();
            $bookmark->setConnection($connection);
            $bookmark = $bookmark->updateBookmark($property_id, $user_id, $status);
            
            echo 2;
        }elseif($current_status==2){
            $status = 1;
            $bookmark = new Bookmark();
            $bookmark->setConnection($connection);
            $bookmark = $bookmark->updateBookmark($property_id, $user_id, $status); 
            echo 1;
        }

    }
} else {
    header('login.php');
    exit();
}
