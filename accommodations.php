<!-- Browse All Properties Page -->
<?php
use Models\Property;
use Models\Image;
include ("init.php");
include ("session.php");

if(isset($_POST['query'])){
    $query = $_POST['query'];
} elseif(isset($_POST['barangay'])){
    $query = $_POST['barangay'];

}
$barangay_list = array('Lourdes Sur East', 'Salapungan', 'Claro M. Recto'); //can be converted or taken from csv

$property = new Property();
$property->setConnection($connection);
$properties = $property->getProperties();

$user_id = $_SESSION['user_id'] ?? NULL;

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Apt Iba Pa | Accommodations</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM"
      crossorigin="anonymous"
    />
    <script
    src="https://kit.fontawesome.com/868f1fea46.js"
    crossorigin="anonymous"
  ></script>
    <link href="css/accommodations.css" rel="stylesheet" />
    <link href="css/all.css" rel="stylesheet" />
  </head>
  <body>
     <!-- Navbar -->
     <?php include('navbar.php') ?>
     <!-- Navbar ends -->

    <!-- Featured section starts -->

    <div class="container-fluid accomJumbuildings">
      <h1 class="text-center fw-bold display-1 mt-5">ACCOMMODATIONS</h1>
      <section class="accommodations">

        <div class="container-md">

          <div class="row">
            <div class="wrapper">
              
              <div class="row justify-content-center mb-3">
                <div class="col-12 col-md-8 col-lg-6">
                  <div class="input-group">
                    <input class="form-control" type="text" name="query" id="search_bar" placeholder="Search for your home" aria-label="search-loc" aria-describedby="button-addon2" value="<?php echo $query ?? ''?>">
                  </div>
                </div>
            </div>
              <div class="d-none d-md-block">
                <div class="d-md-flex align-items-md-center" >
                    <div class="h2"><i class="fa-solid fa-filter-list"></i> Filter</div>
                </div>
              </div>

              
                <hr class="d-block d-md-none">

              
                
                <div class="row">

                    <div class="col-12 col-lg-auto col-xl-auto d-block d-md-none d-lg-block">
                    <label class="filterTitle">Location:</label>
                    <div class="form-inline d-flex justify-content-lg-start justify-content-md-center align-items-center my-2 checkbox bg-light border mx-lg-2"> 
                        <div class="row">
                        <?php 
                                foreach ($barangay_list as $barangay){ 
                                    if(isset($_POST['barangay'])){
                                        $isChecked = ($query === $barangay) ? 'checked' : '';
                                    }
                            ?>
                        <div class="col-12 col-md-0 col-lg-auto">
                            <label class="tick"><?= $barangay ?> <input type="checkbox" name="barangay[]" value="<?= $barangay ?>" <?= $isChecked ?? '' ?>> 
                                <span class="check"></span> 
                            </label> 
                        </div>
                        <?php } ?>
                        
                        </div>
                    </div>
                    </div>
    
                    <div class="col-12 col-md-6 col-lg-auto">
                    <label class="filterTitle">Price:</label>
                    <div class="form-inline d-flex align-items-center my-2 radio bg-light border"> 
                        <label class="options">Any 
                            <input type="radio" name="price" value="all" checked>
                            <span class="checkmark"></span> 
                        <label class="options">Highest First 
                            <input type="radio" name="price" value="high">
                            <span class="checkmark"></span> 
                        </label> <label class="options">Lowest First 
                            <input type="radio" name="price" value="low">
                            <span class="checkmark"></span> </label> 
                    </div>
                    </div>
    
                    <div class="col-12 col-md-6 col-lg-auto">
                    <label class="filterTitle">Type:</label>
                    <div class="form-inline d-flex align-items-center my-2 checkbox bg-light border mx-lg-2"> 
                        <label class="tick">Apartment 
                            <input type="checkbox" name="property_type[]" value="Apartment"> 
                            <span class="check"></span> 
                        </label> 
    
                        <label class="tick">Dormitory 
                            <input type="checkbox" name="property_type[]" value="Dormitory">
                            <span class="check"></span> 
                        </label> 
    
                        <label class="tick">Apartelle 
                            <input type="checkbox" name="property_type[]" value="Apartelle">
                            <span class="check"></span> 
                        </label> 
                    </div>
                    </div>
    
                    </div>
    
                    </div>
                    </div>
    
            <!-- Contains each accommodations -->
            
            <div class="box-container" id="results"></div>
                  
            <!-- End of accommodations display -->
              </div>
            </div>
          </section>
        </div>

    <!-- Featured ends -->


    <!-- Footer -->
    <?php include('footer.php'); ?>
    <!-- Footer ends -->
  



    


  </body>

  <!-- javascript -->
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
    crossorigin="anonymous"
  ></script>

  <script src="js/accommodations.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function () {
    // Initialize the query variable with an empty string
    var query = $('#search_bar').val();
    // Make the initial AJAX request when the page loads
    performAjax({ query: query }); // Use an empty query initially

    // Function to perform the AJAX request
    function performAjax(data) {
        $.ajax({
            url: 'search.php',
            type: 'POST',
            data: data,
            success: function (response) {
                $('#results').html(response);
            }
        });
    }

    // Listen for input changes in the search bar
    $('#search_bar').on('input', function () {
        // Update the query variable with the current search bar value
        query = $('#search_bar').val();

        // Perform AJAX request to fetch results
        performAjax({ query: query });
    });

    $('input[name="price"], input[name="property_type[]"], input[name="barangay[]"]').on('change', function () {

    performAjax({
        price: $('input[name="price"]:checked').val(),
        property_type: $('input[name="property_type[]"]:checked').map(function () {
            return $(this).val();
        }).get(),
        barangay: $('input[name="barangay[]"]:checked').map(function () {
            return $(this).val();                                                                           
        }).get()
    });
});
});
</script>

</html>
