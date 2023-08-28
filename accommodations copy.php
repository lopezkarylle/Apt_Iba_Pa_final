<?php
use Models\Property;
use Models\Image;
include ("init.php");
include ("session.php");

//if($_GET)
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
<div>
    <input type="text" name="query" id="search_bar" placeholder="Search for properties..." value>
</div>
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
        <input type="checkbox" name="barangay[]" value="Lourdes Sur East"> Lourdes Sur East
        <input type="checkbox" name="barangay[]" value="Salapungan"> Salapungan
        <input type="checkbox" name="barangay[]" value="Claro M. Recto"> Claro M. Recto
        <br>
        <button type="submit" id="submit_filter" name="submit_filter" value="submit_filter">Filter</button>
    </form>
</div>
<!-- properties result -->
<div id="results">

</div>
<!-- end of properties -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function () {
    // Initialize the query variable with an empty string
    var query = '';

    // Initial AJAX request when the page loads (with an empty query)
    $.ajax({
        url: 'search.php',
        type: 'POST',
        data: { query: query }, // Send the empty query
        success: function (response) {
            $('#results').html(response);
        }
    });

    // Listen for input changes in the search bar
    $('#search_bar').on('input', function () {
        // Update the query variable with the current search bar value
        query = $('#search_bar').val();

        // Perform AJAX request to fetch results
        $.ajax({
            url: 'search.php',
            type: 'POST',
            data: { query: query },
            success: function (response) {
                $('#results').html(response);
            }
        });
    }); 

    $('#filter_form').on('submit', function (e) {
        var submit_filter = $('#submit_filter').val();
        var price = $('input[name="price"]:checked').val();
        var property_type = $('input[name="property_type[]"]:checked').map(function () {
            return $(this).val();
        }).get();

        var barangay = $('input[name="barangay[]"]:checked').map(function () {
            return $(this).val();
        }).get();

        $.ajax({
            url: 'search.php',
            type: 'POST',
            data: { 
                price: price, 
                property_type: property_type, 
                barangay: barangay, 
                submit_filter: submit_filter
            },
            success: function (response) {
                $('#results').html(response);
            }
        });
    });
});

</script>
</body>