<?php
use Models\Review;
include ("init.php");
include ("session.php");

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'];
} else {
    header('location: view.php');
    exit();
}

try {
     if(isset($_POST['add_review'], $_POST['rating'], $_POST['description'])){
        $rating = $_POST['rating'];
        $description = $_POST['description'];
        $user_id = $_SESSION['user_id'];
        $property_id = $_SESSION['property_view_id'];
        $status = 1;

        $review = new Review();
        $review->setConnection($connection);
        $review = $review->addReview($rating, $description, $user_id, $property_id, $status);

        if(!$review){
            echo 'Invalid Review';
        }
     }
} catch (Exception $e) {
    echo 'An error occurred: ' . $e->getMessage();
}