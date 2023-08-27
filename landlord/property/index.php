<?php
use Models\Property;
include ("../../init.php");
include ("session.php");

$landlord_id = $_SESSION['user_id'];

$property = new Property();
$property->setConnection($connection);
$properties = $property->getProperty($landlord_id); //change to property per landlord

if (isset($_SESSION['property_id'])) {
unset($_SESSION['property_id']);
}
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
<title>Properties</title>
</head>

<body>
<div class="container-fluid">
<nav>
  <ul class="nav nav-pills nav-justified">
    <li style="background-color: #FFF8DC"><a  href="../index.php">Dashboard</a></li>
    <li class="active" style="background-color: #FAF0E6"><a  href="index.php">Properties</a></li>
    <li style="background-color: #FFFAF0"><a  href="../appointment/index.php">Appointments</a></li>
    <li style="background-color: #FFFACD"><a  href="../reservation/index.php">Reservations</a></li>
    <li style="background-color: #FAFAF0"><a  href="../../logout.php">Logout</a></li>
  </ul>
  <a href="../../logout.php">Logout</a>
</nav>

  <form method="POST" action="add.php">
      <button class="btn btn-success" style="margin-top:10px;">Apply a New Property</button>
  </form>				
<?php foreach($properties as $property){
  $full_address = $property['street'] . " " . $property['street'] . ", Barangay " . $property['barangay'] . ", " . $property['city'];
?>
<div class="card" style="width: 18rem;">
  <div class="card-body">
    <h5 class="card-title"><?= $property['property_name']?></h5>
    <p class="card-text"><?= $full_address?></p>
    <p class="card-text"><?= $property['description']?></p>
    <form action="view.php" method="POST">
        <input type="hidden" name="property_id" value="<?= $property['property_id']?>">
        <input type="submit" value="Edit Property">
    </form>
    <!-- <a href="view.php?property_id=" class="btn btn-primary">Go somewhere</a> -->
  </div>
</div>
<?php }?>
</body>
</html>
