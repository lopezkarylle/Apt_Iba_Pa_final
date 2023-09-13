<?php
use Models\Property;
use Models\Image;
use Models\Review;
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
if (isset($_POST['price']) || isset($_POST['property_type']) || isset($_POST['barangay'])) {
    
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

<form action="view.php" method="POST">
            
        

        <?php $propertyCounter = 0; ?>
        <?php 
    foreach ($properties as $property) { 
        $property_name = $property['property_name'];
        $address = $property['barangay'] . ', ' . $property['city'];
        $lowest_rate = $property['lowest_rate'];
        $property_type = $property['property_type'];

        $property_id = $property['property_id'];
        $images = new Image();
        $images->setConnection($connection);
        $images = $images->getDisplayImage($property_id);
        
        if($images){
            $image = $images['image_path'];
        }

        $reviews = new Review();
        $reviews->setConnection($connection);
        $reviews = $reviews->getRatings($property_id);
        
        if(count($reviews)>0){
            $total_ratings = 0;
            $total_reviews = count($reviews);
            
            foreach ($reviews as $review) {
                $total_ratings += $review["rating"];
            }

            $average_rating = $total_ratings / $total_reviews;

            if($total_reviews>1){
                $show_reviews = $average_rating . ' ( ' . $total_reviews . ' Reviews )';
            } else{
                $show_reviews = $average_rating . ' ( ' . $total_reviews . ' Review )';
            }
        } else{
            $show_reviews = "No reviews yet";
        }
    ?>
        <?php if ($propertyCounter % 2 == 0) { ?>
            <div class="row gx-5 mb-3">
            <?php } ?>
              <div class="col-md-6">
                <div class="box">
                    <div class="row">
                        <div class="col-10">
                            <h3 class="name"><?= $property_name ?></h3>
                            <input type="hidden" value="<?=$property_id?>" name="property_id">
                            <div class="row">
                                <div class="h4 mt-3 col-sm-8">
                                    <div>
                                    <i class="fas fa-map-marker-alt"></i> <?= $address ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                            <div class="col-2 ps-4 justify-content-end">
                              <Button onclick="Toggle1()" id="btnBm" class="btn btnBookmark"><i class="fa-solid fa-bookmark fa-3x"></i></Button>
                            </div>

                    </div>

                  <div class="thumb">
                    <p class="type"><span><?= $property_type ?></span></p>

                    <img src="resources/images/properties/<?= $image ?>" alt="" />
                  </div>
                  <div class="row">
                    
                    <div class="col-sm-6 rentName">
                      Rent starts at
                      <div class="price">&#8369;<?= $lowest_rate ?></div>
                    </div>
                    <div class="col-sm-6">
                        <p class="btnRating"><i class="fa-solid fa-star-half-stroke starRating"></i> <?= $show_reviews ?></p>
                      </div>
                  </div>
                  
                  <div class="row">
                    <div class="col-sm"> 
                      <a href="view.php?property_id=<?= $property_id ?>" class="btnView">View property</a>
                    </div>
                  </div>

                </div>
              </div>
              <?php if ($propertyCounter % 2 == 1 || $propertyCounter == count($properties) - 1) { ?>
              
            </div>
            <?php } ?>
        <?php $propertyCounter++; ?>
    <?php } ?>

    </form>
<!-- end of properties -->

