<?php

include "vendor/autoload.php";
include "config/database.php";

use Models\Connection;

$connObj = new Connection($host, $database, $user, $password);
$connection = $connObj->connect();

$success = $_GET['success'] ?? null;
$error = $_GET['error'] ?? null;

if ($success==1){
	$success  = "Successfully Added! x";
}
if ($success==2){
	$success  = "Successfully Updated! x";
}

if ($success==3){
	$success  = "Successfully Deleted! x";
}

if ($success==4){
	$success  = "Successfully Reset Password! x";
}