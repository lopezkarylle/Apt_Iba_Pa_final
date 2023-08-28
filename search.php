<?php
use Models\Property;
use Models\Image;
include("init.php");
include("session.php");

$property = new Property();
$property->setConnection($connection);
$properties = $property->getProperties();
//var_dump($properties);

if (isset($_POST['query'])) {
    $query = $_POST['query'];

    // Define a callback function to filter the array
    $filteredProperties = array_filter($properties, function ($item) use ($query) {
        return (
            stripos($item['property_type'], $query) !== false ||
            stripos($item['property_name'], $query) !== false ||
            stripos($item['barangay'], $query) !== false ||
            stripos($item['city'], $query) !== false ||
            stripos($item['province'], $query) !== false ||
            stripos($item['region'], $query) !== false
        );
    });

    // Convert the filtered properties back to a numerically indexed array
    $properties = array_values($filteredProperties);
}

// Handle filtering
if (isset($_POST['submit_filter'])) {
    $price = $_POST['price'];

    if ($price === "high") {
        usort($properties, function ($a, $b) {
            return $b['lowest_rate'] - $a['lowest_rate'];
        });
    } elseif ($price === "low") {
        usort($properties, function ($a, $b) {
            return $a['lowest_rate'] - $b['lowest_rate'];
        });
    }

    $property_type = $_POST['property_type'] ?? array();
    $barangay = $_POST['barangay'] ?? array();

    $filteredProperties = array_filter($properties, function ($item) use ($property_type, $barangay) {
        return (empty($property_type) || in_array($item['property_type'], $property_type)) &&
            (empty($barangay) || in_array($item['barangay'], $barangay));
    });

    // Convert the filtered properties back to a numerically indexed array
    $properties = array_values($filteredProperties);
}
?>

<!-- properties -->
<ul>
    <?php 
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
<!-- end of properties -->
