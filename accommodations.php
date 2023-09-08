<?php
use Models\Property;
use Models\Image;
include ("init.php");
include ("session.php");

if(isset($_POST['query'])){
    $query = $_POST['query'];
} elseif(isset($_GET['barangay'])){
    $query = $_GET['barangay'];

}
$barangay_list = array('Lourdes Sur East', 'Salapungan', 'Claro M. Recto'); //can be converted or taken from csv

$property = new Property();
$property->setConnection($connection);
$properties = $property->getProperties();

$user_id = $_SESSION['user_id'] ?? NULL;

$current_page = "| Accommodations";
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
      <h1 class="text-center fw-bold display-1 mt-5 accommodationTitle">ACCOMMODATIONS</h1>
      <section class="accommodations">

        <div class="container-md">
          <div class="row">
            <div class="wrapper">

                <!-- Search -->
                <div class="row justify-content-center mb-3">
                <div class="col-12 col-md-8 col-lg-6">
                    <input class="form-control" type="text" name="query" id="search_bar" placeholder="Search.." aria-label="Search" value="<?php echo $query ?? ''?>">
                </div>
                </div>
                <!-- End of search -->
              
                <div class="d-none d-md-block">
                    <div class="d-md-flex align-items-md-center" >
                        <div class="h2">
                            <i class="fa-solid fa-filter-list"></i> Filter
                        </div>
                    </div>
                </div>
                <hr class="d-block d-md-none">
              <!-- <form id="filter_form"> -->


              <!-- <divs class="d-lg-flex align-items-lg-center pt-2"> -->
              <div class="row">

                <div class="col-12 col-lg-auto col-xl-auto d-block d-md-none d-lg-block">
                <label class="filterTitle">Location:</label>
                <div class="form-inline d-flex justify-content-lg-start justify-content-md-center align-items-center my-2 checkbox bg-light border mx-lg-2"> 
                    <div class="row">
                    <?php 
                            foreach ($barangay_list as $barangay){ 
                                if(isset($_POST['barangay'])){
                                    $isChecked = ($query === $barangays) ? 'checked' : '';
                                }
                        ?>
                    <div class="col-12 col-md-0 col-lg-auto">
                        <label class="tick"><?= $barangay ?> <input type="checkbox"> 
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
            <div class="row mt-5 mb-5 justify-content-center">
                <a href="accomodations.php" class="btnViewAll">View All</a>
            </div>
          </div>
        </div>
      </section>
    </div>

    <!-- Featured ends -->


    <!-- Footer -->

    
      <footer class="site-footer">
        <div class="container-fluid">
          <div class="container">
          <div class="row">
              <div class="col-sm-12 col-md-8">
              <h2>APT IBA PA</h2>
                <div class="row">
                  <div class="col-sm-12 col-md-8">
                    <p class="text-justify">
                      Our platform serves as a comprehensive guide, providing a vast database of dormitories and apartments in the area surrounding AUF. Through our interactive map interface, users can easily navigate and explore different locations, allowing them to make informed decisions based on their preferences and requirements.
                    </p>
                  </div>
                </div>
              </div>
  
              <div class="col-xs-6 col-md-2 me-auto pt-4">
              <h6>Pages</h6>
              <ul class="footer-links">
                  <li><a href="http://scanfcode.com/category/c-language/">Accomodations</a><li>
                  <li>
                  <a href="http://scanfcode.com/category/front-end-development/">About Us</a>
                  </li>
                  <li>
                  <a href="http://scanfcode.com/category/back-end-development/">Apply My Property</a>
              </ul>
              </div>
  
              <div class="col-xs-6 col-md-2 pt-4">
              <h6>Features</h6>
              <ul class="footer-links">
                  <li><a href="http://scanfcode.com/about/">Favorites</a></li>
                  <li><a href="http://scanfcode.com/contact/">Reserve a Room</a></li>
                  <li>
                  <a href="http://scanfcode.com/contribute-at-scanfcode/">Schedule a Visit</a>
              </ul>
              </div>
          </div>
          <hr />
          </div>
          <div class="container">
          <div class="row">
              <div class="col-md-8 col-sm-6 col-xs-12">
              <p class="copyright-text">
                  Copyright &copy; 2023 All Rights Reserved by
                  <a href="#">APT IBA PA</a>.
              </p>
              </div>
  
              <div class="col-md-4 col-sm-6 col-xs-12">
              <ul class="social-icons">
                  <li>
                  <a class="facebook" href="#"><i class="fa fa-facebook"></i></a>
                  </li>
                  <li>
                  <a class="twitter" href="#"><i class="fa fa-twitter"></i></a>
                  </li>
                  <li>
                  <a class="dribbble" href="#"><i class="fa fa-dribbble"></i></a>
                  </li>
                  <li>
                  <a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a>
                  </li>
              </ul>
              </div>
          </div>
          </div>
        </div>
      </footer>
      
  
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

    // Listen for form submission
    // $('#filter_form').on('submit', function (e) {
    //     e.preventDefault(); // Prevent the form from submitting normally

    //     performAjax({
    //         price: $('input[name="price"]:checked').val(),
    //         property_type: $('input[name="property_type[]"]:checked').map(function () {
    //             return $(this).val();
    //         }).get(),
    //         barangay: $('input[name="barangay[]"]:checked').map(function () {
    //             return $(this).val();
    //         }).get(),
    //         submit_filter: $('#submit_filter').val()
    //     }); // Perform AJAX request when the form is submitted
    // });

    $('input[name="price"], input[name="property_type[]"], input[name="barangay[]"]').on('change', function () {
    performAjax({
        price: $('input[name="price"]:checked').val(),
        property_type: $('input[name="property_type[]"]:checked').map(function () {
            return $(this).val();
        }).get(),
        barangay: $('input[name="barangay[]"]:checked').map(function () {
            return $(this).val();
        }).get(),
        submit_filter: $('#submit_filter').val()
    });
});
});
</script>
</html>
