<?php

include ("../init.php");


?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
<title>Apt Iba Pa</title>
</head>

<body>
<div class="container-fluid">
<nav>
  <ul class="nav nav-pills nav-justified">
    <li style="background-color: #FFF8DC"><a  href="index.php">Dashboard</a></li>
    <li style="background-color: #FAF0E6"><a  href="properties.php">Accommodations</a></li>
    <li class="active" style="background-color: #FFFAF0"><a  href="about.php">About Us</a></li>
    <?php if (isset($user_id)){ ?>
        <li style="background-color: #FAFAF0"><a  href="../../logout.php">Logout</a></li>
    <?php } else { ?>
        <li style="background-color: #FAFAF0"><a  href="../../tenant-login.php">Login</a></li>
    <?php } ?>
  </ul>
  <a href="../../logout.php">Logout</a>
</nav>

<h1>About Us</h1>
</body>
</html>
