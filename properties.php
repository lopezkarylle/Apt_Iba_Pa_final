<?php
use Models\Property;
include ("init.php");

$property = new Property('','', '', '', '','','','','', '', '', '','','','','','');
$property->setConnection($connection);
$properties = $property->getProperties();

$user_id = 5;
//if user_type != 2...
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
    <li class="active" style="background-color: #FAF0E6"><a  href="properties.php">Accommodations</a></li>
    <li style="background-color: #FFFAF0"><a  href="about.php">About Us</a></li>
    <?php if (isset($user_id)){ ?>
        <li style="background-color: #FAFAF0"><a  href="../../logout.php">Logout</a></li>
    <?php } else { ?>
        <li style="background-color: #FAFAF0"><a  href="../../tenant-login.php">Login</a></li>
    <?php } ?>
  </ul>
  <a href="../../logout.php">Logout</a>
</nav>

<?php foreach($properties as $property){
  $full_address = $property['street'] . " " . $property['street'] . ", Barangay " . $property['barangay'] . ", " . $property['city'];
?>
<div class="card" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title"><?= $property['property_id'] . ' ' . $property['property_name']?></h5>
    <p class="card-text"><?= $full_address?></p>
    <p class="card-text"><?= $property['description']?></p>
    <a href="view.php?property_id=<?= $property['property_id']?>">View Property</a>
    <!-- <a href="view.php?property_id=" class="btn btn-primary">Go somewhere</a> -->
  </div>
</div>
<?php }?>
</body>
</html>
