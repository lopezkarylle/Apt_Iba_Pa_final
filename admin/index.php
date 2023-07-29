<!DOCTYPE html>
<html lang="en">
<?php 
include ("../init.php");
use Models\User;
use Models\Landlord;
session_start(); 

if(!isset($_SESSION["email"])){
  header("location:../index.php");
}
?>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="style.css">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<title>Admin Dashboard</title>
</head>

<body
<div class="container-fluid">
  <ul class="nav nav-pills nav-justified">
    <li class="active" style="background-color: #FFF8DC"><a  href="admin/index.php">Dashboard</a></li>
    <li style="background-color: #FAF0E6"><a  href="../admin/landlord/index.php">Manage Landlords</a></li>
    <li style="background-color: #FFFAF0"><a  href="../admin/user/index.php">Manage Users</a></li>
    <li style="background-color: #FFFACD"><a  href="../admin/property/index.php">Manage Properties</a></li>
    <li style="background-color: #FAFAF0"><a  href="../admin/application-request/index.php">Application Requests</a></li>
  </ul>
  </nav>

  
  <main id="view-panel" >

  </main>

</body>

<style>
	body{
        background: #80808045;
  }
  .modal-dialog.large {
    width: 80% !important;
    max-width: unset;
  }
  .modal-dialog.mid-large {
    width: 50% !important;
    max-width: unset;
  }
  #viewer_modal .btn-close {
    position: absolute;
    z-index: 999999;
    /*right: -4.5em;*/
    background: unset;
    color: white;
    border: unset;
    font-size: 27px;
    top: 0;
}
#viewer_modal .modal-dialog {
        width: 80%;
    max-width: unset;
    height: calc(90%);
    max-height: unset;
}
  #viewer_modal .modal-content {
       background: black;
    border: unset;
    height: calc(100%);
    display: flex;
    align-items: center;
    justify-content: center;
  }
  #viewer_modal img,#viewer_modal video{
    max-height: calc(100%);
    max-width: calc(100%);
  }
</style>

