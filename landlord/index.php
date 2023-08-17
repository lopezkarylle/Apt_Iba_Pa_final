<!DOCTYPE html>
<html lang="en">
<?php 
use Models\User;

include ("../init.php");

// session_start();

// if(!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 1){
//     echo "<script>window.location.href='../landlord-login.php';</script>";
//     exit();
// }

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
<title>Landlord</title>
</head>

<body
<div class="container-fluid">
  <nav>
  <ul class="nav nav-pills nav-justified">
    <li class="active" style="background-color: #FFF8DC"><a  href="index.php">Dashboard</a></li>
    <li style="background-color: #FAF0E6"><a  href="../landlord/property/index.php">Properties</a></li>
    <li style="background-color: #FFFAF0"><a  href="../landlord/appointment/index.php">Appointments</a></li>
    <li style="background-color: #FFFACD"><a  href="../landlord/reservation/index.php">Reservations</a></li>
    <li style="background-color: #FAFAF0"><a  href="../../logout.php">Logout</a></li>
  </ul>
  <a href="../../logout.php">Logout</a>
  </nav>

  
  <main id="view-panel" >

  </main>

</body>

</html>