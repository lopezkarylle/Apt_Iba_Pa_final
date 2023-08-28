<?php
use Models\Property;
use Models\Image;
use Models\User;
include ("init.php");
include ("session.php");

$property = new Property();
$property->setConnection($connection);
$properties = $property->getProperties();

if(isset($_SESSION['user_id'])){
$user_id = $_SESSION['user_id'];

$user = new User();
$user->setConnection($connection);
$user = $user->getById($user_id);

$full_name = $user['first_name'] . ' ' . $user['last_name'];
}

$barangay_list = array('Lourdes Sur East', 'Salapungan', 'Claro M. Recto'); //can be converted or taken from csv
?>

<!-- header -->
<h2>Header</h2>
<ul class="nav nav-pills nav-justified">
    <li class="active"><a href="index.php">Dashboard</a></li>
    <li><a  href="accommodations.php">Accommodations</a></li>
    <li><a  href="about.php">About Us</a></li>
</ul>

    <a href="apply.php">Apply My Property</a><br>
    <?php if(isset($user_id)) {?>
    <h2><?php echo 'Hi ' . $full_name ?></h2>
    <a href="logout.php">Logout</a>
    <?php } else {?>
    <a href="login.php">Login</a>
    <?php }?>
  </nav>

<!-- end of header -->

<!-- search -->
<h2>Search</h2>
<div>
    <form action="accommodations.php" method="POST">
    <input type="text" name="query" id="search_bar" placeholder="Search for properties...">
    <button type="submit" name="search">Search</button>
    </form>
</div>
<!-- end of search -->

<!-- browse properties per barangay -->
<h2>Browse by barangay</h2>
<form action="accommodations.php" method="POST">

<button type="submit" value="Lourdes Sur East" name="barangay">Lourdes Sur East</button>
<button type="submit" value="Salapungan" name="barangay">Salapungan</button>
<button type="submit" value="Claro M. Recto" name="barangay">Claro M. Recto</button>

</form>


<!-- featured properties -->
<h2>Featured Properties</h2>
<ul>
    <?php 
    shuffle($properties); 
    foreach ($properties as $property) { 
        $property_name = $property['property_name'];
        $barangay = $property['barangay'];
        $lowest_rate = $property['lowest_rate'];

        $property_id = $property['property_id'];
        $images = new Image();
        $images->setConnection($connection);
        $images = $images->getDisplayImage($property_id);
        
        if($images){
            $image = $images['image_path'];
        }
        ?>
            <form action="view.php" method="POST">
            <input type="hidden" value="<?=$property_id?>" name="property_id">
            <h3><?= $property_name?></h3>
            <h4>Barangay <?= $barangay ?></h4>
            <img src='resources/images/properties/<?= $image ?>' height='100' width='100'></img>
            <h4>Rate starts at ₱<?= $lowest_rate ?></h4>
            <button type="submit" name="view_property">View Property</button>
            </form>
        
    <?php } ?>
</ul>

<!-- footer -->