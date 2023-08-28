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

<!-- Featured section starts -->


          <?php 
            foreach ($properties as $property) { 
                $property_name = $property['property_name'];
                $barangay = $property['barangay'];
                $lowest_rate = $property['lowest_rate'];
                $property_type = $property['property_type'];

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

            <div class="row gx-5 mb-3">
              <div class="col-md-6">
                <div class="box">
                    <div class="row">
                        <div class="col-10">
                            <h3 class="name"><?= $property_name?></h3>
                            <div class="row">
                                <div class="h4 mt-3 col-sm-8">
                                    <div>
                                    <i class="fas fa-map-marker-alt"></i> <?= $barangay ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                            <div class="col-2 ps-4 justify-content-end">
                              <Button onclick="Toggle1()" id="btnBm" class="btn btnBookmark"><i class="fa-solid fa-bookmark fa-3x"></i></Button>
                            </div>

                    </div>

                  <div class="thumb">
                    <p class="total-images">
                      <i class="far fa-image"></i><span>4</span>
                    </p>
                    <p class="type"><span><?= $property_type ?></span></p>

                    <img src="resources/images/properties/<?= $image ?>" alt="" />
                  </div>
                  <div class="row">
                    
                    <div class="col-sm-6 rentName">
                      Rent starts at
                      <div class="price">&#8369;<?= $lowest_rate ?></div>
                    </div>
                    <div class="col-sm-6">
                        <p class="btnRating"><i class="fa-solid fa-star-half-stroke starRating"></i> 4.8 (73 reviews)</p>
                      </div>
                  </div>
                  
                  <div class="row">
                    <div class="col-sm">
                    <button type="submit" name="view_property">View Property</button>
                    </div>
                  </div>
                </div>
                </div>
              </div>
              <?php } ?>

    <!-- Featured ends -->
