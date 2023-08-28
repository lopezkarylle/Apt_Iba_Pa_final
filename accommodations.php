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
<html>
<head>
    <title>Accommodations</title>
</head>
<body>
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

<!-- Search -->
<h2>Search</h2>
<div>
    <input type="text" name="query" id="search_bar" placeholder="Search for properties..." value="<?php echo $query ?? ''?>">
</div>
<!-- End of search -->

<!-- Filter -->
<h2>Filter Results</h2>

<div>
    <form id="filter_form">
        <label>Price</label>
        <input type="radio" name="price" value="all" checked> Any
        <input type="radio" name="price" value="high"> High to low
        <input type="radio" name="price" value="low"> Low to high
        <br>
        <label>Type of property</label>
        <input type="checkbox" name="property_type[]" value="Dormitory"> Dormitory
        <input type="checkbox" name="property_type[]" value="Apartment"> Apartment
        <br>
        <label>Located in</label>

        <?php foreach($barangay_list as $barangays){
            if(isset($_POST['barangay'])){
            $isChecked = ($query === $barangays) ? 'checked' : '';
            }
        ?>
            <input type="checkbox" name="barangay[]" value="<?php echo $barangays ?>" <?php echo $isChecked ?? '' ?>> <?php echo $barangays ?>
        <?php } ?>
        
        <br>
        <button type="submit" id="submit_filter" name="submit_filter" value="submit_filter">Filter</button>
    </form>
</div>
<!-- End of filter -->

<!-- properties result -->
<h2>Properties</h2>
<div id="results">

</div>
<!-- end of properties -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function () {
    // Initialize the query variable with an empty string
    var query = $('#search_bar').val();
    // Make the initial AJAX request when the page loads
    performAjax({ query: query }); // Use an empty query initially

    //var barangay = $('#brgy').val();
    // if(barangay!==''){
    //     query = barangay;
    // } else {
    //     query = $('#search_bar').val();
    // }

    // performAjax({ query: query});

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
    $('#filter_form').on('submit', function (e) {
        e.preventDefault(); // Prevent the form from submitting normally

        performAjax({
            price: $('input[name="price"]:checked').val(),
            property_type: $('input[name="property_type[]"]:checked').map(function () {
                return $(this).val();
            }).get(),
            barangay: $('input[name="barangay[]"]:checked').map(function () {
                return $(this).val();
            }).get(),
            submit_filter: $('#submit_filter').val()
        }); // Perform AJAX request when the form is submitted
    });
});


</script>
</body>