<?php

include "../../init.php";
use Models\User;
use Models\Request;
use Models\Property;

    $application_id = $_POST['application_id'];

    if(isset($application_id)){
        $application = new Request();
        $application->setConnection($connection);
        $request = $application->getRequest($application_id);
    } else {
        echo "<script>window.location.href='index.php';</script>";
        exit();
    }
?>

<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<title>Users</title>
</head>
<body>

<div class="container-fluid">
<ul class="nav nav-pills nav-justified">
  <li style="background-color: #FFF8DC"><a  href="../index.php">Dashboard</a></li>
  <li style="background-color: #FAF0E6"><a  href="../landlord/index.php">Manage Landlords</a></li>
  <li style="background-color: #FFFAF0"><a  href="index.php">Manage Users</a></li>
  <li style="background-color: #FFFACD"><a  href="../property/index.php">Manage Properties</a></li>
  <li class="active" style="background-color: #FAFAF0"><a  href="../application-request/index.php">Application Requests</a></li>
</ul>
</nav>

<form action="view.php" method="view.php">
<button type="submit" value="accept_request" name="accept_request">Accept</button>
<button type="submit" value="decline_request" name="decline_request">Decline</button>
</form>
</body>
</html>
<?php 

try{
    if(isset($_POST['application_id'], $_POST['accept_request'])){
        $status = 1;
        $application->editRequest($application_id, $status);
        echo "<script>window.location.href='index.php';</script>";
        exit();

    } elseif (isset($_POST['application_id'], $_POST['decline_request'])) {
        $status = 3;
        $application->editRequest($application_id, $status);
        echo "<script>window.location.href='index.php';</script>";
        exit();

    } elseif (isset($_POST['application_id'], $_POST['delete_request'])){
        $status = 0;
        $application->editRequest($application_id, $status);
        echo "<script>window.location.href='index.php';</script>";
        exit();
    }
} catch (Exception $e) {
    error_log($e->getMessage());
}