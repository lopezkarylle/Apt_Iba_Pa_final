<?php
use Models\Property;
include ("init.php");
include ("session.php");

$property = new Property();
$property->setConnection($connection);
$properties = $property->getProperties();

$user_id = $_SESSION['user_id'] ?? NULL;


?>

<!-- header -->
<ul class="nav nav-pills nav-justified">
    <li class="active"><a href="index.php">Dashboard</a></li>
    <li><a  href="accommodations.php">Accommodations</a></li>
    <li><a  href="about.php">About Us</a></li>
</ul>
    <a href="apply.php">Apply My Property</a><br>
    <?php if(isset($user_id)) {?>
    <a href="logout.php">Logout</a>
    <?php } else {?>
    <a href="login.php">Login</a>
    <?php }?>
  </nav>

  <!-- search -->
  

  <!-- browse properties per barangay -->
<form action="brgy_browse.php" method="POST">
<button type="submit" value="Lourdes Sur East" name="barangay">Lourdes Sur East</button>
<button type="submit" value="Salapungan" name="barangay">Salapungan</button>
<button type="submit" value="Claro M. Recto" name="barangay">Claro M. Recto</button>
</form>


<!-- featured properties -->
<ul>
    <?php 
    shuffle($properties); 
    foreach ($properties as $featured_properties) { 
    ?>
        <li><?php echo $featured_properties['property_name']; ?></li>
    <?php } ?>
</ul>

<!-- footer -->