<?php

use Models\Property;
use Models\Amenity;
use Models\Rule;
use Models\Room;
use Models\Request;
use Models\User;
include "init.php";
include ("session.php");

$user_id = $_SESSION['user_id'] ?? NULL;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Apt Iba Pa | Apply Property</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <!-- Form -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>

    <!-- <link href="https://getbootstrap.com/docs/5.2/assets/css/docs.css" rel="stylesheet"> -->

    <!-- Others -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/868f1fea46.js" crossorigin="anonymous"></script>
    <link href="css/property_enlist.css" rel="stylesheet" />
    <link href="css/all.css" rel="stylesheet" />

  </head>
  <body>
    <!-- Navbar -->
<?php include('navbar.php') ?>

    <!-- Navbar ends -->



<!-- Enlist starts -->

  <div class="container ps-md-0 enlistDetailscon">
    <section class="enlistDetails">
      <!-- <div class="d-none d-md-flex col-md-4 col-lg-6 bg-image">
        <img class="img-fluid" src="images/hero-img.png">
      </div> -->
      <!-- <divd class="col-md-8 col-lg-6 " style="border: 1px solid red;"> -->
        <div class="w-100 d-none d-md-block"><div class="row m-2"></div></div>
          <div class="multisteps-form">
            <div class="row justify-content-center">
              <div class="col-12 col-lg-8 ml-auto mr-auto">
                <div class="multisteps-form__progress">
                  <button class="multisteps-form__progress-btn js-active" type="button" title="BasicDetails">Basic Details</button>
                  <button class="multisteps-form__progress-btn" type="button" title="PropertyDetails">Property Details</button>
                  <button class="multisteps-form__progress-btn" type="button" title="House Rules">House Rules</button>
                  <button class="multisteps-form__progress-btn" type="button" title="Message">Message        </button>
                </div>
              </div>
            </div>
            <div class="container multisteps-form__form mt-sm-0 mt-lg-5">

              <div class="container">
                <div class="row justify-content-center">
                  <div class="col-md-11 col-lg-8">
                      <div class="multisteps-form__panel shadow p-4 rounded bg-white js-active" data-animation="scaleIn">
                        <h3 class="login-heading mb-4 multisteps-form__title">Welcome back!</h3>
                        <div class="multisteps-form__content">

        
                        <!-- Enlist Form -->
                        <form action="add.php" method="POST" id="property-form" enctype="multipart/form-data">

                        <input type="hidden" name="user_id" value="<?php echo isset($user_id) ? '' : NULL ?>">

                        <div class="row mt-3">
                          <h2>Property Details</h2>
                        </div>

                        <div class="row g-2">
                          <div class="col-12 col-sm-6">
                            <div class="form-floating">
                              <input type="text" class="form-control" id="property_name" name="property_name" placeholder="propertyname">
                              <label for="property_name" class="form-label">Property Name</label>
                            </div>
                          </div>
                        </div>

                        <div class="row justify-content-center mt-2 reserveRoomType">
                          <div class="col-md-12 ">
                            <div class="row mt-3">
                              <h4>
                                Property Type
                              </h4>
                            </div>
                              
                              <div class="row mt-2">
                                <div class="col-12 col-md-4">
                                  <label class="radio w-100">
                                    <input type="radio" name="property_type" value="Dormitory" />
                                    <div
                                      class="row justify-content-between p-3 radioRoomType" id="pickRoomType">
                                      <div class="col-8">
                                          <span class="roomTypeName">Dormitory</span>
                                      </div>
                              
                                      <div class="col-3">
                                        <i class="fa-solid fa-people-roof fa-4x float-end"></i>
                                      </div>
                                    </div>
                                  </label>
                                </div>

                                <div class="col-12 col-md-4">
                                  <label class="radio w-100">
                                    <input type="radio" name="property_type" value="Apartment" />
                                    <div
                                      class="row justify-content-between p-3 radioRoomType" id="pickRoomType">
                                      <div class="col-8">
                                          <span class="roomTypeName">Apartment</span>
                                      </div>
                              
                                      <div class="col-3">
                                        <i class="fa-solid fa-house-building fa-4x float-end"></i>
                                      </div>
                                    </div>
                                  </label>
                                </div>

                                <div class="col-12 col-md-4">
                                  <label class="radio w-100">
                                    <input type="radio" name="property_type" value="Apartelle" />
                                    <div
                                      class="row justify-content-between p-3 radioRoomType" id="pickRoomType">
                                      <div class="col-8">
                                          <span class="roomTypeName">Apartelle</span>
                                      </div>
                              
                                      <div class="col-3">
                                        <i class="fa-solid fa-warehouse-full fa-4x float-end"></i>
                                      </div>
                                    </div>
                                  </label>
                                </div>


                              </div>
                              
                                
                    
        
                          </div>
                          
                        </div>

                        <div class="form-group row">
                            <label for="images" class="control-label">Upload at least 5 images</label>
                            <input type="file" class="form-control" name="images[]" id="image" multiple><br>
                            <button class="btn btn-sm btn-outline-primary" id="add_titles" type="button">Add Image Titles</button>
                            <div id="image_titles_container"></div>
                            <div id="image_previews_container"></div>
                        </div>
                        <div class="row mt-4">
                          <h2>Property Location</h2>
                        </div>
                  
                        <div class="row g-2">
                          <div class="col-12 col-md-4">
                            <div class="form-floating">
                            <input type="text" class="form-control" id="property_number" name="property_number" placeholder="housenumber">
                            <label for="property_number" class="form-label">Bldg/House No.</label>
                            </div>
                          </div>
                  
                          <div class="col-12 col-md-4">
                            <div class="form-floating">
                              <input type="text" class="form-control" id="street" name="street" placeholder="housenumber">
                              <label for="street" class="form-label">Street</label>
                            </div>
                          </div>
                  
                          <div class="col-12 col-md-4">
                            <div class="form-floating">
                              <select class="form-select" name="region" id="region" >
                              </select>
                              <input type="hidden" class="form-control form-control-md" name="region_text" id="region-text">
                              <label for="region">Region</label>
                            </div>
                          </div>

                          
                        </div>

                        <div class="row g-2">
                          <div class="col-12 col-md-4">
                            <div class="form-floating">
                              <select class="form-select" name="province" id="province" ></select>
                              <input type="hidden" class="form-control form-control-md" name="province_text" id="province-text">
                              <label for="province">Province</label>
                            </div>
                          </div>

                          <div class="col-12 col-md-4">
                            <div class="form-floating">
                              <select class="form-select" name="city" id="city" ></select>
                              <input type="hidden" class="form-control form-control-md" name="city_text" id="city-text" >
                              <label for="city">City / Municipality</label>
                            </div>
                          </div>

                          <div class="col-12 col-md-4">
                            <div class="form-floating">
                              <select class="form-select" name="barangay" id="barangay" ></select>
                              <input type="hidden" class="form-control form-control-md" name="barangay_text" id="barangay-text" >
                              <label for="barangay">Barangay</label>
                            </div>
                          </div>
                  
                        </div>

                        <?php if(!isset($user_id)){ ?>

                        <div class="row mt-4">
                          <h2>Property Owner Details</h2>
                        </div>
                  
                        <div class="row g-2">
                          <div class="col-12 col-md-4">
                            <div class="form-floating">
                              <input type="text" class="form-control" id="first_name" name="first_name" placeholder="fname">
                              <label for="first_name" class="form-label">First Name</label>
                            </div>
                          </div>
                  
                          <div class="col-12 col-md-4">
                            <div class="form-floating">
                              <input type="text" class="form-control" id="last_name" name="last_name"  placeholder="lname">
                              <label for="last_name" class="form-label">Last Name</label>
                            </div>
                          </div>
                  
                        </div>
                  
                        <div class="row g-2 mt-3">

                        <div class="col-12 col-md-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="contact_number" name="contact_number" placeholder="Contact Number">
                                <label for="contact_number" class="form-label">Phone Number</label>
                            </div>
                        </div>
                  
                          <div class="col-12 col-md-5">
                            <div class="form-floating">
                              <input type="email" class="form-control" id="email" name="email"  placeholder="email">
                              <label for="email" class="form-label">Email</label>
                            </div>
                            <span id="email-error" style="color: red;"></span><br>
                          </div>

                          <div class="col-12 col-md-5">
                            <div class="form-floating">
                              <input type="password" class="form-control" id="password" name="password"  placeholder="password">
                              <label for="password" class="form-label">Password</label>
                            </div>
                          </div>

                          <div class="col-12 col-md-5">
                            <div class="form-floating">
                              <input type="password" class="form-control" id="confpass" name="confpass"  placeholder="password">
                              <label for="password" class="form-label">Confirm Password</label>
                            </div>
                            <span id="confpass-error" style="color: red;"></span><br>
                          </div>

                          <div class="col-12 col-md-5">
                            <div class="form-floating">
                            <input type="file" class="form-control" name="picture" id="picture"><br>
                              <label for="picture" class="form-label">Upload Image</label>
                            </div>
                          </div>
                  
                        </div>

                        <?php } ?>
                           
                        <div class="row g-2 mt-4">                  
                          <div class="row">
                            <h5>*I guarantee that all details provided are accurate and true.</h5>
                          </div>
                          <div class="col-6 col-md-5 ms-md-2 ms-sm-2">
                            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                              <input type="radio" class="btn-check" name="btnradioAgreement" id="btnTrue" checked>
                              <label class="btn btn-outline-primary" for="btnTrue">Yes</label>
                              
                              <input type="radio" class="btn-check" name="btnradioAgreement" id="btnFalse">
                              <label class="btn btn-outline-primary" for="btnFalse">No</label>

                            </div>
                          </div>
                  
                        </div>

                        <!-- <div class="row g-2 mt-3">
                  
                          <div class="col-12 col-md-5">
                            <button type="button" class="btn btn-primary btn-sm">Next Button</button>
                          </div>
                  
                        </div> -->

                        <div class="row">
                          <div class="button-row d-flex mt-4 col-12">
                            <button class="btn btn-primary ml-auto js-btn-next" type="button" title="Next">Next</button>
                          </div>
                        </div>

                        </div>
                    </div>
                
                  </div>
                </div>
              </div>

              <div class="container">
                <div class="row justify-content-center">
                  <div class="col-md-11 col-lg-8 mx-auto justify-content-center">
                    <div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="scaleIn">
                    <h3 class="login-heading mb-4 multisteps-form__title">Welcome back!</h3>
                    <div class="multisteps-form__content">
      
                      <!-- Enlist Form -->
                      <div class="row mt-3">
                        <h2>Property Room Details</h2>
                      </div>

                      <div class="row g-2">
                        <div class="col-12">
                          <div class="propertyDescrip">
                            <label for="description" class="form-label">Property Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Describe your property."></textarea>
                          </div>
                        </div>
                      </div>
                
                      <div class="row g-2 mt-2">
                        <div class="col-12 col-md-4">
                          <div class="form2">
                            <label for="total_floors" class="form-label h5">How many floors?</label>
                            <input type="number" class="form-control" id="total_floors" name="total_floors" min="0" placeholder="No. of floors">
                          </div>
                        </div>
                
                      </div>


                      <div class="row g-2 mt-2">

                        <div class="col-12 col-md-4">
                          <div>
                            <label class="form-label h5">Amenities <span class="h6"> *please click all that applies</span></label>
                          </div>
                        </div>
                        
                          <div class="row">

                            <div class="col col-md-4 d-flex justify-content-center mt-2">
                            <div class="check-amenities">
                                <input type="checkbox" class="btn-check" id="btn-check-1" name="aircon" value="1">
                                <label class="btnA" for="btn-check-1">Aircon</label>
                            </div>
                            </div>

                            <div class="col col-md-4 d-flex justify-content-center mt-2">
                            <div class="check-amenities">
                                <input type="checkbox" class="btn-check" id="btn-check-2" name="cabinet" value="1">
                                <label class="btnA" for="btn-check-2">Cabinet</label>
                            </div>
                            </div>

                            <div class="col col-md-4 d-flex justify-content-center mt-2">
                            <div class="check-amenities">
                                <input type="checkbox" class="btn-check" id="btn-check-3" name="cctv" value="1">
                                <label class="btnA" for="btn-check-3">CCTV</label>
                            </div>
                            </div>

                            <div class="col col-md-4 d-flex justify-content-center mt-2">
                            <div class="check-amenities">
                                <input type="checkbox" class="btn-check" id="btn-check-4" name="drinkingwater" value="1">
                                <label class="btnA" for="btn-check-4">Drinking Water</label>
                            </div>
                            </div>

                            <div class="col col-md-4 d-flex justify-content-center mt-2">
                            <div class="check-amenities">
                                <input type="checkbox" class="btn-check" id="btn-check-5" name="elevator" value="1">
                                <label class="btnA" for="btn-check-5">Elevator</label>
                            </div>
                            </div>

                            <div class="col col-md-4 d-flex justify-content-center mt-2">
                            <div class="check-amenities">
                                <input type="checkbox" class="btn-check" id="btn-check-6" name="fireexit" value="1">
                                <label class="btnA" for="btn-check-6">Fire Exit</label>
                            </div>
                            </div>

                            <div class="col col-md-4 d-flex justify-content-center mt-2">
                            <div class="check-amenities">
                                <input type="checkbox" class="btn-check" id="btn-check-7" name="foodhall" value="1">
                                <label class="btnA" for="btn-check-7">Food Hall</label>
                            </div>
                            </div>

                            <div class="col col-md-4 d-flex justify-content-center mt-2">
                            <div class="check-amenities">
                                <input type="checkbox" class="btn-check" id="btn-check-8" name="laundry" value="1">
                                <label class="btnA" for="btn-check-8">Laundry</label>
                            </div>
                            </div>

                            <div class="col col-md-4 d-flex justify-content-center mt-2">
                            <div class="check-amenities">
                                <input type="checkbox" class="btn-check" id="btn-check-9" name="lounge" value="1">
                                <label class="btnA" for="btn-check-9">Lounge</label>
                            </div>
                            </div>

                            <div class="col col-md-4 d-flex justify-content-center mt-2">
                            <div class="check-amenities">
                                <input type="checkbox" class="btn-check" id="btn-check-10" name="microwave" value="1">
                                <label class="btnA" for="btn-check-10">Microwave</label>
                            </div>
                            </div>

                            <div class="col col-md-4 d-flex justify-content-center mt-2">
                            <div class="check-amenities">
                                <input type="checkbox" class="btn-check" id="btn-check-11" name="parking" value="1">
                                <label class="btnA" for="btn-check-11">Parking</label>
                            </div>
                            </div>

                            <div class="col col-md-4 d-flex justify-content-center mt-2">
                            <div class="check-amenities">
                                <input type="checkbox" class="btn-check" id="btn-check-12" name="reception" value="1">
                                <label class="btnA" for="btn-check-12">Reception</label>
                            </div>
                            </div>

                            <div class="col col-md-4 d-flex justify-content-center mt-2">
                            <div class="check-amenities">
                                <input type="checkbox" class="btn-check" id="btn-check-13" name="refrigerator" value="1">
                                <label class="btnA" for="btn-check-13">Refrigerator</label>
                            </div>
                            </div>

                            <div class="col col-md-4 d-flex justify-content-center mt-2">
                            <div class="check-amenities">
                                <input type="checkbox" class="btn-check" id="btn-check-14" name="roofdeck" value="1">
                                <label class="btnA" for="btn-check-14">Roof Deck</label>
                            </div>
                            </div>

                            <div class="col col-md-4 d-flex justify-content-center mt-2">
                            <div class="check-amenities">
                                <input type="checkbox" class="btn-check" id="btn-check-15" name="security" value="1">
                                <label class="btnA" for="btn-check-15">Security</label>
                            </div>
                            </div>

                            <div class="col col-md-4 d-flex justify-content-center mt-2">
                            <div class="check-amenities">
                                <input type="checkbox" class="btn-check" id="btn-check-16" name="sink" value="1">
                                <label class="btnA" for="btn-check-16">Sink</label>
                            </div>
                            </div>

                            <div class="col col-md-4 d-flex justify-content-center mt-2">
                            <div class="check-amenities">
                                <input type="checkbox" class="btn-check" id="btn-check-17" name="studyarea" value="1">
                                <label class="btnA" for="btn-check-17">Study Area</label>
                            </div>
                            </div>

                            <div class="col col-md-4 d-flex justify-content-center mt-2">
                            <div class="check-amenities">
                                <input type="checkbox" class="btn-check" id="btn-check-18" name="tv" value="1">
                                <label class="btnA" for="btn-check-18">TV</label>
                            </div>
                            </div>

                            <div class="col col-md-4 d-flex justify-content-center mt-2">
                            <div class="check-amenities">
                                <input type="checkbox" class="btn-check" id="btn-check-19" name="wifi" value="1">
                                <label class="btnA" for="btn-check-19">Wifi</label>
                            </div>
                            </div>
                            

                        </div>
                    </div>

                      <div class="row mt-4">
                        <h2>Room Details</h2>
                      </div>
                      <div id="room-container">
                        <div class="row g-2">
                            <div class="col-12 col-md-4">
                            <div class="selectRoomType">
                                <label for="room_type" class="form-label h5">Room type</label>
                                <select class="form-select" name="room_type[]" id="room_type">
                                    <option value="" selected disabled> - Select Type of Room - </option>
                                    <option value="1">Room for 1</option>
                                    <option value="2">Room for 2</option>
                                    <option value="3">Room for 3</option>
                                    <option value="4">Room for 4</option>
                                    <option value="5">Room for 5</option>
                                    <option value="6">Room for 6</option>
                                    <option value="7">Room for 7</option>
                                    <option value="8">Room for 8</option>
                                </select>
                            </div>
                            </div>

                            <div class="col-12 col-md-4">
                            <div class="selectRoomType">
                                <label for="furnished_type" class="form-label h5">Furnished type</label>
                                <select class="form-select" name="furnished_type[]" id="furnished_type" >
                                    <option value="" selected disabled> - Select Type of Furnish - </option>
                                    <option value="Furnished">Furnished</option>
                                    <option value="Semi-furnished">Semi-furnished</option>
                                    <option value="Unfurnished">Unfurnished</option>
                                </select>
                            </div>
                            </div>
                    
                            <div class="col-12 col-md-4">
                                <div class="form2">
                                    <label for="monthly_rent" class="form-label h5">Rate per room</label>
                                    <input type="number" class="form-control" id="monthly_rent" name="monthly_rent[]" placeholder="₱ 0.00">
                                </div>
                            </div>

                            <div class="col-12 col-md-4">
                                <div class="form2">
                                    <label for="total_rooms" class="form-label h5">Number of room/s</label>
                                    <input type="number" class="form-control" id="total_rooms" name="total_rooms[]" placeholder="0">
                                </div>
                            </div>
                            <button type="button" id="add-room">Add Another Room</button>
                        </div>
                    </div>
                
                    <div class="row g-2 mt-2">
                        <div class="col-12 col-md-6">
                          <div class="form2">
                            <label for="electric_bill" class="form-label h5">Average electric bill? (if applicable)</label>
                            <input type="number" class="form-control" id="electric_bill" name="electric_bill" placeholder="₱ 0.00">
                          </div>
                        </div>
                
                        <div class="col-12 col-md-6">
                          <div class="form2">
                            <label for="water_bill" class="form-label h5">Average water bill? (if applicable)</label>
                            <input type="number" class="form-control" id="water_bill" name="water_bill" placeholder="₱ 0.00">
                          </div>
                        </div>
                      </div>
                    
                      <div class="row g-2 mt-2">
                        <div class="col-12 col-md-6">
                          <div class="form2">
                            <label for="reservation_fee" class="form-label h5">Reservation Fee? (if applicable)</label>
                            <input type="number" class="form-control" id="reservation_fee" name="reservation_fee" placeholder="₱ 0.00">
                          </div>
                        </div>
                
                        <div class="col-12 col-md-6">
                          <div class="form2">
                            <label for="advance_deposit" class="form-label h5">Advanced Deposit? (if applicable)</label>
                            <input type="number" class="form-control" id="advance_deposit" name="advance_deposit" placeholder="₱ 0.00">
                          </div>
                        </div>
                      </div>
                      <!-- <div class="row g-2 mt-3">
                
                        <div class="col-12 col-md-5">
                          <button type="button" class="btn btn-secondary btn-sm">Previous Button</button>
                          <button type="button" class="btn btn-primary btn-sm">Next Button</button>
                        </div>
                
                      </div> -->

                      <div class="row">
                        <div class="button-row d-flex mt-4 col-12">
                          <button class="btn btn-primary js-btn-prev" type="button" title="Prev">Prev</button>
                          <button class="btn btn-primary ml-auto js-btn-next" type="button" title="Next">Next</button>
                        </div>
                      </div>
                    
                    </div>
                    </div>
                  </div>
                </div>
              </div>
            

              
              <div class="container">
                <div class="row">
                  <div class="col-md-11 col-lg-8 mx-auto justify-content-center">
                    <div class="multisteps-form__panel shadow p-4 rounded bg-white" data-animation="scaleIn">
                    <h3 class="login-heading mb-4 multisteps-form__title">Welcome back!</h3>
                    <div class="multisteps-form__content">
      
                      <!-- Enlist Form -->
                    <div class="row g-2 mt-4">
                        <div class="row">
                            <h5>Is short-term stay allowed?</h5>
                        </div>
                        <div class="col-6 col-md-5 ms-md-2 ms-sm-2 mt-2">
                            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                            <input type="radio" class="btn-check shortermCheck" id="short_term_yes" name="short_term" value="1">
                            <label class="btn btn-outline-primary" for="short_term_yes">Yes</label>

                            <input type="radio" class="btn-check shortermCheck" id="short_term_no" name="short_term" value="0" checked>
                            <label class="btn btn-outline-primary" for="short_term_no">No</label>
                            </div>
                        </div>
                    </div>

                      <div class="row g-2 mt-4">                  
                        <div class="row">
                          <h5>Minimum stay allowed</h5>
                        </div>
                        <div class="col-8 col-md-6 ms-md-2 ms-sm-2 selectRoomType">
                            <select class="form-select" name="min_weeks" id="min_weeks">
                                <option value="" selected disabled>Select minimum no. of week</option>
                                <option value="1">1 Week</option>
                                <option value="2">2 Weeks</option>
                                <option value="3">3 Weeks</option>
                                <option value="4">4 Weeks</option>
                                <option value="5">5 Weeks</option>
                                <option value="6">6 Weeks</option>
                                <option value="7">7 Weeks</option>
                                <option value="8">8 Weeks</option>
                            </select>
                          </div>
                      </div>

                      <div class="row g-2 mt-4">                  
                        <div class="row">
                          <h5>Is coed or mixed-gender allowed?</h5>
                        </div>
                        <div class="col-6 col-md-5 ms-md-2 ms-sm-2 mt-2">
                          <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                            <input type="radio" class="btn-check genderCheck" id="mix_gender_yes" name="mix_gender" value="1">
                            <label class="btn btn-outline-primary" for="mix_gender_yes">Yes</label>
                            
                            <input type="radio" class="btn-check genderCheck" id="mix_gender_no" name="mix_gender" value="0" checked>
                            <label class="btn btn-outline-primary" for="mix_gender_no">No</label>
    
                          </div>
                        </div>
                      </div>

                      <div class="row g-2 mt-4">                  
                        <div class="row">
                          <h5>Do you have a curfew?</h5>
                        </div>
                        <div class="col-4 col-md-2 ms-md-2 ms-sm-2">
                          <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                            <input type="radio"  onclick="javascript:yesnoCheck1();" class="btn-check curfewCheck" name="curfew" id="curfew_yes" value="1">
                            <label class="btn btn-outline-primary" for="curfew_yes">Yes</label>
                            
                            <input type="radio"  onclick="javascript:yesnoCheck1();" class="btn-check curfewCheck" name="curfew" id="curfew_no" value="2" checked>
                            <label class="btn btn-outline-primary" for="curfew_no">No</label>
    
                          </div>
    
                        </div>
                        
                        <div class="row g-2 mt-2" id="ifYes1" style="display:none;" >
                          <div class="col-8 col-md-6 ms-md-2 ms-sm-2 selectRoomType">
                            <select class="form-select" name="from_curfew" id="from_curfew">
                                <option value="none" selected> - From - </option>
                                <option value="6PM">6PM</option>
                                <option value="7PM">7PM</option>
                                <option value="8PM">8PM</option>
                                <option value="9PM">9PM</option>
                                <option value="10PM">10PM</option>
                                <option value="11PM">11PM</option>
                                <option value="12MN">12MN</option>
                                <option value="1AM">1AM</option>
                            </select>
                          </div>
                          <div class="col-8 col-md-6 ms-md-2 ms-sm-2 selectRoomType">
                            <select class="form-select" name="to_curfew" id="to_curfew">
                              <option value="none" selected> - To - </option>
                              <option value="3AM">3AM</option>
                              <option value="4AM">4AM</option>
                              <option value="5AM">5AM</option>
                              <option value="6AM">6AM</option>
                              <option value="7AM">7AM</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      
                      <div class="row g-2 mt-4">                  
                          <div class="row">
                            <h5>Are pets allowed?</h5>
                          </div>
                        <div class="col-6 col-md-5 ms-md-2 ms-sm-2 mt-2">
                          <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                            <input type="radio" class="btn-check petsCheck" name="pets" value="1" id="pets_yes">
                            <label class="btn btn-outline-primary" for="pets_yes">Yes</label>
                            
                            <input type="radio" class="btn-check petsCheck" name="pets" value="0" id="pets_no" checked>
                            <label class="btn btn-outline-primary" for="pets_no">No</label>
    
                          </div>
                        </div>
                      </div>
    
                      <div class="row g-2 mt-4">                  
                        <div class="row">
                          <h5>Are guests allowed?</h5>
                        </div>
                        <div class="col-4 col-md-4 ms-md-2 ms-sm-2">
                          <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                            <input type="radio"  onclick="javascript:yesnoCheck2();" class="btn-check guestCheck" name="visitors" value="1" id="visitors_yes">
                            <label class="btn btn-outline-primary" for="visitors_yes">Yes</label>
                            
                            <input type="radio"  onclick="javascript:yesnoCheck2();" class="btn-check guestCheck" name="visitors" value="0" id="visitors_no" checked>
                            <label class="btn btn-outline-primary" for="visitors_no">No</label>
    
                          </div>
    
                        </div>
    
                        <div class="row g-2 mt-4"  id="ifYes2" style="display:none;" >                  
                            <div class="row">
                              <h5>Visitation Hours</h5>
                            </div>
                            <div class="col-8 col-md-6 ms-md-2 ms-sm-2 selectRoomType">
                                <select class="form-select" name="from_visit" id="from_visit">
                                    <option value="none" selected> - From - </option>
                                    <option value="3AM">3AM</option>
                                    <option value="4AM">4AM</option>
                                    <option value="5AM">5AM</option>
                                    <option value="6AM">6AM</option>
                                    <option value="7AM">7AM</option>
                                    <option value="8AM">8AM</option>
                                    <option value="9AM">9AM</option>
                                    <option value="10AM">10AM</option>
                                    <option value="10AM">11AM</option>
                                    <option value="10AM">12AM</option>
                                </select>
                              </div>
                              <div class="col-8 col-md-6 ms-md-2 ms-sm-2 selectRoomType">
                                <select class="form-select" name="to_visit" id="to_visit">
                                    <option value="none" selected> - To - </option>
                                    <option value="4PM">4PM</option>
                                    <option value="5PM">5PM</option>
                                    <option value="6PM">6PM</option>
                                    <option value="7PM">7PM</option>
                                    <option value="8PM">8PM</option>
                                    <option value="9PM">9PM</option>
                                    <option value="10PM">10PM</option>
                                    <option value="11PM">11PM</option>
                                    <option value="12MN">12MN</option>
                                    <option value="1AM">1AM</option>
                                    <option value="2AM">2AM</option>
                                </select>
                              </div>
                        </div>
    
    
                      </div>
    
    
                      <div class="row g-2 mt-4">                  
                        <div class="row">
                          <h5>Is cooking allowed?</h5>
                        </div>
                        <div class="col-6 col-md-5 ms-md-2 ms-sm-2 mt-2">
                          <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                            <input type="radio" class="btn-check" name="cooking" id="cookin_yes" value="1" >
                            <label class="btn btn-outline-primary" for="cookin_yes">Yes</label>
                            
                            <input type="radio" class="btn-check" name="cooking" id="cooking_no" value="0" checked>
                            <label class="btn btn-outline-primary" for="cooking_no">No</label>
    
                          </div>
                        </div>
                      </div>
    
                      <div class="row g-2 mt-4">                  
                        <div class="row">
                          <h5>Are alcoholic drinks allowed?</h5>
                        </div>
                        <div class="col-6 col-md-5 ms-md-2 ms-sm-2 mt-2">
                          <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                            <input type="radio" class="btn-check alcoholCheck" id="alcohol_yes" name="alcohol" value="1">
                            <label class="btn btn-outline-primary" for="alcohol_yes">Yes</label>
                            
                            <input type="radio" class="btn-check alcoholCheck" id="alcohol_no" name="alcohol" value="0" checked>
                            <label class="btn btn-outline-primary" for="alcohol_no">No</label>
    
                          </div>
                        </div>
                      </div>

                      <div class="row g-2 mt-4">                  
                        <div class="row">
                          <h5>Is vaping or smoking allowed?</h5>
                        </div>
                        <div class="col-6 col-md-5 ms-md-2 ms-sm-2 mt-2">
                          <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                            <input type="radio" class="btn-check smokingCheck" id="smoking_yes" name="smoking" value="1">
                            <label class="btn btn-outline-primary" for="smoking_yes">Yes</label>
                            
                            <input type="radio" class="btn-check smokingCheck" id="smoking_no" name="smoking" value="0" checked>
                            <label class="btn btn-outline-primary" for="smoking_no">No</label>
    
                          </div>
                        </div>
                      </div>
 
                      <div class="row g-2 mt-3">
                        <div class="button-row d-flex mt-4 col-12">
                          <button class="btn btn-primary js-btn-prev" type="button" title="Prev">Prev</button>
                        </div>

                        <div class="button-row d-flex mt-4 col-12">
                        <input class="btn btn-primary ml-auto"  type="submit" name="apply_property" >Submit</input>
                        </div>
                        
                      </div>
    
    
                  </div>
                
                  </div>
                </div>
                </div>
              </div>
              
            </div>
            
            <div class="form-group row">
                    <div class="col-md-4">
                            <!-- <label for="" class="control-label">Locate your property</label> -->
                            <!-- <div id='map' style='width: 400px; height: 300px;'></div> -->
                            <input type="hidden" name="latitude" value="15.145113074763598">
                            <input type="hidden" name="longitude" value="120.5950306751359">
                    </div>
            </div>
            <!-- <button class="btn btn-sm btn-outline-danger" id="submit-button" type="submit">Add</button> -->

              </form>
            </div>
          </div>
        
          <!-- <div class="w-100 mb-5"><div class="row m-2"></div></div> -->
    </section>
   
  </div>
    
    <!-- Enlist Form ends -->
  


    


    </body>

    <!-- javascript -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
      crossorigin="anonymous"
    ></script>

    <script src="js/property_enlist.js"></script>

    <!-- Radio Button -->
    <script>
      function yesnoCheck() {
          if (document.getElementById('wifiCheck1').checked) {
              document.getElementById('ifYes').style.visibility = 'visible';
          }
          else document.getElementById('ifYes').style.visibility = 'hidden';

      }
    </script>
  
  <script>
    function yesnoCheck1() {
        if (document.getElementById('curfew_yes').checked) {
            document.getElementById('ifYes1').style.display = 'block';
        }
        else document.getElementById('ifYes1').style.display = 'none';

    }
  </script>

<script>
  function yesnoCheck2() {
      if (document.getElementById('visitors_yes').checked) {
          document.getElementById('ifYes2').style.display = 'block';
      }
      else document.getElementById('ifYes2').style.display = 'none';

  }
</script>  
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const addTitlesButton = document.getElementById("add_titles");
        const imageTitlesContainer = document.getElementById("image_titles_container");
        const imagePreviewsContainer = document.getElementById("image_previews_container");

        addTitlesButton.addEventListener("click", function() {
            const selectedImages = document.getElementById("image").files;
            imageTitlesContainer.innerHTML = ""; // Clear previous titles
            imagePreviewsContainer.innerHTML = ""; // Clear previous image previews

            for (let i = 0; i < selectedImages.length; i++) {
                const input = document.createElement("input");
                input.type = "text";
                input.name = "image_title[]";
                input.placeholder = "Insert caption for image " + (i + 1);
                input.className = "form-control mb-2"; // Add some margin between inputs
                imageTitlesContainer.appendChild(input);

                // Create an image preview
                const imagePreview = document.createElement("img");
                imagePreview.src = URL.createObjectURL(selectedImages[i]);
                imagePreview.className = "img-thumbnail";
                imagePreview.height = "50";
                imagePreview.width = "50";
                imagePreviewsContainer.appendChild(imagePreview);
            }
        });
    });
</script>
<!-- <script src="form-validate.js"></script> -->

<script src="ph-address-selector.js"></script>
    <script src="geo.js"></script>
    <script src="room.js"></script>
    <script src="map.js"></script>
    <script src="rules.js"></script>
</html>
