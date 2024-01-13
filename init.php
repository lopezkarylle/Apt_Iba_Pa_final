<?php

include "vendor/autoload.php";
include "config/database.php";

require_once "stripe-php-master/init.php";

// include 'vendor/PHPMailer/PHPMailer/src/Exception.php'; 
// include 'vendor/PHPMailer/PHPMailer/src/PHPMailer.php'; 
// include 'vendor/PHPMailer/PHPMailer/src/SMTP.php'; 

use Models\Connection;

$connObj = new Connection($host, $database, $user, $password);
$connection = $connObj->connect();

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$mail_username = $_ENV['MAIL_USERNAME'];
$mail_password = $_ENV['MAIL_PASSWORD'];

$stripeDetails = array(
    "secretKey" => "sk_test_51OABq5HBdKJS2207w4Zk2px37xz4bXRNjdc7VJwOqR3FHRFbOl7KtKVp2nKfSn0f6jOabw5TSMFjET8LnwC6BsdI00BFAZdGqS",
    "publishableKey" => "pk_test_51OABq5HBdKJS2207xfZxyPYcS4LwCtADqxVI4x6tpTHV9FCVlywBgThKJtotVed8ngC7FwGU5Ijz3gJ80mkzGd8B004TgmsizS"
);

\Stripe\Stripe::setApiKey($stripeDetails["secretKey"]);

// define('STRIPE_API_KEY', 'sk_test_51OABq5HBdKJS2207w4Zk2px37xz4bXRNjdc7VJwOqR3FHRFbOl7KtKVp2nKfSn0f6jOabw5TSMFjET8LnwC6BsdI00BFAZdGqS'); 
// define('STRIPE_PUBLISHABLE_KEY', 'pk_test_51OABq5HBdKJS2207xfZxyPYcS4LwCtADqxVI4x6tpTHV9FCVlywBgThKJtotVed8ngC7FwGU5Ijz3gJ80mkzGd8B004TgmsizS'); 
// define('STRIPE_SUCCESS_URL', 'localhost/index.php'); //Payment success URL 
// define('STRIPE_CANCEL_URL', 'localhost/index.php'); //Payment cancel URL 