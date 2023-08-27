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

<!-- properties -->
<ul>
    <?php 
    foreach ($properties as $featured_properties) { 
    ?>
        <li><?php echo $featured_properties['property_name']; ?>
            <form action="view.php" method="POST">
            <input type="hidden" value="<?php echo $featured_properties['property_id']?>" name="property_id">
            <button type="submit" name="view_property">View Property</button>
            </form>
        </li>
    <?php } ?>
</ul>