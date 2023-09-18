<?php

use Models\Bookmark;

include "init.php";
include "session.php";

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
    if(isset($_POST['add_bookmark'])){
        $property_id = $_POST['property_id'];
        
    }
} else {
    header('login.php');
    exit();
}
