<?php

use Models\Property;
use Models\Amenity;
use Models\Rule;
use Models\Room;
use Models\Request;
use Models\User;
include "init.php";
include ("session.php");

/*if(isset($_SESSION['user_id'])){
$user_id = $_SESSION['user_id'];

$user = new User();
$user->setConnection($connection);
$user = $user->getUser($user_id);

$first_name = $user['first_name'];
$last_name = $user['last_name'];
$email = $user['email'];
$contact_number = $user['contact_number'];
$first_name = $user['first_name'];
} */

$user_id = $_SESSION['user_id'] ?? NULL;
//var_dump($user_id);

$current_page = "| Apply Property";

$available_amenities = array("Aircon", "Cabinet", "CCTV", "Drinking Water", "Elevator", "Fire Exit", "Food Hall", "Laundry", "Lounge", "Microwave", "Parking", "Reception", "Refrigerator", "Roof Deck", "Security", "Sink", "Study Area", "TV", "Wifi");

// $amenities_icons = array("fa-fan, fa-grip, CCTV, DRINKING WATER, ELEVATOR, fa-person-running, foodhall, laundry, lounge, microwave, parking, reception, refrigerator, fa-arrows-left-right, security, sink, study area, tv, wifi");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
<?php include('head.php'); ?>
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
                        <form action="add.php" method="POST" id="property-form">

                        <input type="hidden" name="user_id" value="<?php echo $user_id?>">

                        <div class="row mt-3">
                          <h2>Property Details</h2>
                        </div>

                        <div class="row g-2">
                          <div class="col-12 col-sm-6">
                            <div class="form-floating">
                              <input type="text" class="form-control" id="property_name" name="property_name" placeholder="propertyname" required>
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
                              
                                
                              </form>
        
                          </div>
                          
                        </div>

                        <div class="row mt-4">
                          <h2>Property Location</h2>
                        </div>
                  
                        <div class="row g-2">
                          <div class="col-12 col-md-4">
                            <div class="form-floating">
                            <input type="text" class="form-control" id="property_number" name="property_number" placeholder="housenumber" required>
                            <label for="property_number" class="form-label">Bldg/House No.</label>
                            </div>
                          </div>
                  
                          <div class="col-12 col-md-4">
                            <div class="form-floating">
                              <input type="text" class="form-control" id="street" name="street" placeholder="housenumber" required>
                              <label for="street" class="form-label">Street</label>
                            </div>
                          </div>
                  
                          <div class="col-12 col-md-4">
                            <div class="form-floating">
                              <select class="form-select" name="region" id="region" required>
                              </select>
                              <input type="hidden" class="form-control form-control-md" name="region_text" id="region-text">
                              <label for="region">Region</label>
                            </div>
                          </div>
                        </div>

                        <div class="row g-2">
                          <div class="col-12 col-md-4">
                            <div class="form-floating">
                              <select class="form-select" name="province" id="province" required></select>
                              <input type="hidden" class="form-control form-control-md" name="province_text" id="province-text">
                              <label for="province">Province</label>
                            </div>
                          </div>

                          <div class="col-12 col-md-4">
                            <div class="form-floating">
                              <select class="form-select" name="city" id="city" required></select>
                              <input type="hidden" class="form-control form-control-md" name="city_text" id="city-text" required>
                              <label for="city">City / Municipality</label>
                            </div>
                          </div>

                          <div class="col-12 col-md-4">
                            <div class="form-floating">
                              <select class="form-select" name="barangay" id="barangay" required></select>
                              <input type="hidden" class="form-control form-control-md" name="barangay_text" id="barangay-text" required>
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
                              <input type="text" class="form-control" id="first_name" name="first_name" placeholder="fname" required>
                              <label for="first_name" class="form-label">First Name</label>
                            </div>
                          </div>
                  
                          <div class="col-12 col-md-4">
                            <div class="form-floating">
                              <input type="text" class="form-control" id="last_name" name="last_name"  placeholder="lname" required>
                              <label for="last_name" class="form-label">Last Name</label>
                            </div>
                          </div>
                  
                        </div>
                  
                        <div class="row g-2 mt-3">

                        <div class="col-12 col-md-3">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="contact_number" name="contact_number" placeholder="Contact Number" required>
                                <label for="contact_number" class="form-label">Phone Number</label>
                            </div>
                        </div>
                  
                          <div class="col-12 col-md-5">
                            <div class="form-floating">
                              <input type="email" class="form-control" id="email" name="email"  placeholder="email" required>
                              <label for="email" class="form-label">Email</label>
                            </div>
                            <span id="email-error" style="color: red;"></span><br>
                          </div>

                          <div class="col-12 col-md-5">
                            <div class="form-floating">
                              <input type="password" class="form-control" id="password" name="password"  placeholder="password" required>
                              <label for="password" class="form-label">Password</label>
                            </div>
                          </div>

                          <div class="col-12 col-md-5">
                            <div class="form-floating">
                              <input type="password" class="form-control" id="confpass" name="confpass"  placeholder="password" required>
                              <label for="password" class="form-label">Confirm Password</label>
                            </div>
                            <span id="confpass-error" style="color: red;"></span><br>
                          </div>
                  
                        </div>

                        <?php } ?>

                        <div class="row g-2 mt-4">                  
                          <div class="row">
                            <h5>*I guarantee that all details provided are accurate and true.</h5>
                          </div>
                          <div class="col-6 col-md-5 ms-md-2 ms-sm-2">
                            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                              <input type="radio" class="btn-check" name="btnradioAgreement" id="btnTrue" autocomplete="off" checked>
                              <label class="btn btn-outline-primary" for="btnTrue">Yes</label>
                              
                              <input type="radio" class="btn-check" name="btnradioAgreement" id="btnFalse" autocomplete="off">
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
                            <textarea class="form-control" id="description" name="description" required rows="3" placeholder="Prudencio is a cozy, semi-furnished dorm for rent near AUF, ideal for roomies who want to experience the freedom of their own unit while coliving. Located in Angeles City near schools."></textarea>
                          </div>
                        </div>
                      </div>
                
                      <div class="row g-2 mt-2">
                        <div class="col-12 col-md-4">
                          <div class="form2">
                            <label for="total_floors" class="form-label h5">How many floors?</label>
                            <input type="number" class="form-control" id="total_floors" name="total_floors" min="0" max="9" placeholder="No. of floors" required>
                          </div>
                        </div>
                
                      </div>


                      <div class="row g-2 mt-2">

                        <div class="col-12 col-md-4">
                          <div>
                            <label for="roomRate" class="form-label h5">Amenities <span class="h6"> *please click all that applies</span></label>
                          </div>
                        </div>
                        
                          <div class="row">

                            <div class="col col-md-4 d-flex justify-content-center mt-2">
                            <div class="check-amenities">
                                <input type="checkbox" class="btn-check" id="btn-check-1" name="aircon" value="1" autocomplete="off">
                                <label class="btnA" for="btn-check-1">Aircon</label>
                            </div>
                            </div>

                            <div class="col col-md-4 d-flex justify-content-center mt-2">
                            <div class="check-amenities">
                                <input type="checkbox" class="btn-check" id="btn-check-2" name="cabinet" value="1" autocomplete="off">
                                <label class="btnA" for="btn-check-2">Cabinet</label>
                            </div>
                            </div>

                            <div class="col col-md-4 d-flex justify-content-center mt-2">
                            <div class="check-amenities">
                                <input type="checkbox" class="btn-check" id="btn-check-3" name="cctv" value="1" autocomplete="off">
                                <label class="btnA" for="btn-check-3">CCTV</label>
                            </div>
                            </div>

                            <div class="col col-md-4 d-flex justify-content-center mt-2">
                            <div class="check-amenities">
                                <input type="checkbox" class="btn-check" id="btn-check-4" name="drinkingwater" value="1" autocomplete="off">
                                <label class="btnA" for="btn-check-4">Drinking Water</label>
                            </div>
                            </div>

                            <div class="col col-md-4 d-flex justify-content-center mt-2">
                            <div class="check-amenities">
                                <input type="checkbox" class="btn-check" id="btn-check-5" name="elevator" value="1" autocomplete="off">
                                <label class="btnA" for="btn-check-5">Elevator</label>
                            </div>
                            </div>

                            <div class="col col-md-4 d-flex justify-content-center mt-2">
                            <div class="check-amenities">
                                <input type="checkbox" class="btn-check" id="btn-check-6" name="fireexit" value="1" autocomplete="off">
                                <label class="btnA" for="btn-check-6">Fire Exit</label>
                            </div>
                            </div>

                            <div class="col col-md-4 d-flex justify-content-center mt-2">
                            <div class="check-amenities">
                                <input type="checkbox" class="btn-check" id="btn-check-7" name="foodhall" value="1" autocomplete="off">
                                <label class="btnA" for="btn-check-7">Food Hall</label>
                            </div>
                            </div>

                            <div class="col col-md-4 d-flex justify-content-center mt-2">
                            <div class="check-amenities">
                                <input type="checkbox" class="btn-check" id="btn-check-8" name="laundry" value="1" autocomplete="off">
                                <label class="btnA" for="btn-check-8">Laundry</label>
                            </div>
                            </div>

                            <div class="col col-md-4 d-flex justify-content-center mt-2">
                            <div class="check-amenities">
                                <input type="checkbox" class="btn-check" id="btn-check-9" name="lounge" value="1" autocomplete="off">
                                <label class="btnA" for="btn-check-9">Lounge</label>
                            </div>
                            </div>

                            <div class="col col-md-4 d-flex justify-content-center mt-2">
                            <div class="check-amenities">
                                <input type="checkbox" class="btn-check" id="btn-check-10" name="microwave" value="1" autocomplete="off">
                                <label class="btnA" for="btn-check-10">Microwave</label>
                            </div>
                            </div>

                            <div class="col col-md-4 d-flex justify-content-center mt-2">
                            <div class="check-amenities">
                                <input type="checkbox" class="btn-check" id="btn-check-11" name="parking" value="1" autocomplete="off">
                                <label class="btnA" for="btn-check-11">Parking</label>
                            </div>
                            </div>

                            <div class="col col-md-4 d-flex justify-content-center mt-2">
                            <div class="check-amenities">
                                <input type="checkbox" class="btn-check" id="btn-check-12" name="reception" value="1" autocomplete="off">
                                <label class="btnA" for="btn-check-12">Reception</label>
                            </div>
                            </div>

                            <div class="col col-md-4 d-flex justify-content-center mt-2">
                            <div class="check-amenities">
                                <input type="checkbox" class="btn-check" id="btn-check-13" name="refrigerator" value="1" autocomplete="off">
                                <label class="btnA" for="btn-check-13">Refrigerator</label>
                            </div>
                            </div>

                            <div class="col col-md-4 d-flex justify-content-center mt-2">
                            <div class="check-amenities">
                                <input type="checkbox" class="btn-check" id="btn-check-14" name="roofdeck" value="1" autocomplete="off">
                                <label class="btnA" for="btn-check-14">Roof Deck</label>
                            </div>
                            </div>

                            <div class="col col-md-4 d-flex justify-content-center mt-2">
                            <div class="check-amenities">
                                <input type="checkbox" class="btn-check" id="btn-check-15" name="security" value="1" autocomplete="off">
                                <label class="btnA" for="btn-check-15">Security</label>
                            </div>
                            </div>

                            <div class="col col-md-4 d-flex justify-content-center mt-2">
                            <div class="check-amenities">
                                <input type="checkbox" class="btn-check" id="btn-check-16" name="sink" value="1" autocomplete="off">
                                <label class="btnA" for="btn-check-16">Sink</label>
                            </div>
                            </div>

                            <div class="col col-md-4 d-flex justify-content-center mt-2">
                            <div class="check-amenities">
                                <input type="checkbox" class="btn-check" id="btn-check-17" name="studyarea" value="1" autocomplete="off">
                                <label class="btnA" for="btn-check-17">Study Area</label>
                            </div>
                            </div>

                            <div class="col col-md-4 d-flex justify-content-center mt-2">
                            <div class="check-amenities">
                                <input type="checkbox" class="btn-check" id="btn-check-18" name="tv" value="1" autocomplete="off">
                                <label class="btnA" for="btn-check-18">TV</label>
                            </div>
                            </div>

                            <div class="col col-md-4 d-flex justify-content-center mt-2">
                            <div class="check-amenities">
                                <input type="checkbox" class="btn-check" id="btn-check-19" name="wifi" value="1" autocomplete="off">
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
                                <select class="form-select" name="room_type[]" id="room_type" required>
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
                                <select class="form-select" name="furnished_type[]" id="furnished_type"  required>
                                    <option value="" selected disabled> - Select Type of Furnish - </option>
                                    <option value="Furnished">Furnished</option>
                                    <option value="Semi-furnished">Semi-furnished</option>
                                    <option value="Unfurnished">Unfurnished</option>
                                </select>
                            </div>
                            </div>
                    
                            <div class="col-12 col-md-4">
                                <div class="form2">
                                    <label for="monthly_rent" class="form-label h5">Rate per person</label>
                                    <input type="number" class="form-control" id="monthly_rent" name="monthly_rent[]" max="9" placeholder="₱ 0.00" required>
                                </div>
                            </div>

                            <div class="col-12 col-md-4">
                                <div class="form2">
                                    <label for="total_rooms" class="form-label h5">Number of room/s</label>
                                    <input type="number" class="form-control" id="total_rooms" name="total_rooms[]" max="9" placeholder="0" required>
                                </div>
                            </div>
                            <button type="button" id="add-room">Add Another Room</button>
                        </div>
                    </div>
                
                      <div class="row g-2 mt-2">
                        <div class="row">
                            <h5>Is the electric bill excluded?</h5>
                        </div>

                        <div class="col-4 col-md-2 ms-md-2 ms-sm-2">
                            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                              <input type="radio"  onclick="javascript:yesnoCheck();" class="btn-check wifiCheck" name="btnWifiradio" id="wifiCheck1" autocomplete="off">
                              <label class="btn btn-outline-primary" for="wifiCheck1">Yes</label>
                              
                              <input type="radio"  onclick="javascript:yesnoCheck();" class="btn-check wifiCheck" name="btnWifiradio" id="wifiCheck2" autocomplete="off" checked>
                              <label class="btn btn-outline-primary" for="wifiCheck2">No</label>
  
                            </div>
  
                        </div>

                        <div class="col-12 col-md-4">
                          <div class="form2">
                            <label for="electric_bill" class="form-label h5">Average water bill?</label>
                            <input type="number" class="form-control" id="electric_bill" name="electric_bill" max="9" placeholder="₱ 0.00" required>
                          </div>
                        </div>
                
                      </div>

                      <div class="row g-2 mt-2">
                        <div class="row">
                            <h5>Is the water bill excluded?</h5>
                        </div>

                        <div class="col-4 col-md-2 ms-md-2 ms-sm-2">
                            <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                              <input type="radio"  onclick="javascript:yesnoCheck();" class="btn-check wifiCheck" name="btnWifiradio" id="wifiCheck1" autocomplete="off">
                              <label class="btn btn-outline-primary" for="wifiCheck1">Yes</label>
                              
                              <input type="radio"  onclick="javascript:yesnoCheck();" class="btn-check wifiCheck" name="btnWifiradio" id="wifiCheck2" autocomplete="off" checked>
                              <label class="btn btn-outline-primary" for="wifiCheck2">No</label>
  
                            </div>
                        
                        </div>

                        <div class="col-12 col-md-4">
                            <div class="form2">
                            <label for="water_bill" class="form-label h5">Average water bill?</label>
                            <input type="number" class="form-control" id="water_bill" name="water_bill" max="9" placeholder="₱ 0.00" required>
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
                            <input type="radio" class="btn-check" name="btnradioParking" id="short_term" name="short_term" value="1" autocomplete="off">
                            <label class="btn btn-outline-primary" for="short_term">Yes</label>
                            
                            <input type="radio" class="btn-check" name="btnradioParking" id="short_term" name="short_term" value="0" autocomplete="off" checked>
                            <label class="btn btn-outline-primary" for="short_term">No</label>
    
                          </div>
                        </div>
                      </div>

                      <div class="row g-2 mt-4">                  
                        <div class="row">
                          <h5>Is short-term stay allowed?</h5>
                        </div>
                        <div class="col-6 col-md-5 ms-md-2 ms-sm-2 mt-2">
                          <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                            <input type="radio" class="btn-check" name="btnradioParking" id="short_term" name="short_term" value="1" autocomplete="off">
                            <label class="btn btn-outline-primary" for="short_term">Yes</label>
                            
                            <input type="radio" class="btn-check" name="btnradioParking" id="short_term" name="short_term" value="0" autocomplete="off" checked>
                            <label class="btn btn-outline-primary" for="short_term">No</label>
    
                          </div>
                        </div>
                      </div>

                      <div class="row g-2 mt-4">                  
                        <div class="row">
                          <h5>Minimum stay allowed</h5>
                        </div>
                        <div class="col-8 col-md-6 ms-md-2 ms-sm-2 selectRoomType">
                            <select class="form-select" name="min_weeks" id="min_weeks" required>
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
                            <input type="radio" class="btn-check" name="btnradioParking" id="mix_gender" name="mix_gender" value="1" autocomplete="off">
                            <label class="btn btn-outline-primary" for="mix_gender">Yes</label>
                            
                            <input type="radio" class="btn-check" name="btnradioParking" id="mix_gender" name="mix_gender" value="0" autocomplete="off" checked>
                            <label class="btn btn-outline-primary" for="mix_gender">No</label>
    
                          </div>
                        </div>
                      </div>

                      <div class="row g-2 mt-4">                  
                        <div class="row">
                          <h5>Do you have a curfew?</h5>
                        </div>
                        <div class="col-4 col-md-2 ms-md-2 ms-sm-2">
                          <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                            <input type="radio"  onclick="javascript:yesnoCheck1();" class="btn-check curfewCheck" name="btnCurfewradio" id="curfewCheck1" autocomplete="off" value="1">
                            <label class="btn btn-outline-primary" for="curfewCheck1">Yes</label>
                            
                            <input type="radio"  onclick="javascript:yesnoCheck1();" class="btn-check curfewCheck" name="btnCurfewradio" id="curfewCheck2" autocomplete="off" value="2" checked>
                            <label class="btn btn-outline-primary" for="curfewCheck2">No</label>
    
                          </div>
    
                        </div>
                        
                        <div class="row g-2 mt-2" id="ifYes1" style="display:none;" >
                          <div class="col-8 col-md-6 ms-md-2 ms-sm-2 selectRoomType">
                            <select class="form-select" name="from_curfew" id="from_curfew" required>
                                <option selected> - From - </option>
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
                            <select class="form-select" name="to_curfew" id="to_curfew" required>
                              <option selected> - To - </option>
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
                            <input type="radio" class="btn-check" name="pets" value="1" id="pets" autocomplete="off">
                            <label class="btn btn-outline-primary" for="pets">Yes</label>
                            
                            <input type="radio" class="btn-check" name="pets" value="0" id="pets" autocomplete="off" checked>
                            <label class="btn btn-outline-primary" for="btnPetsN">No</label>
    
                          </div>
                        </div>
                      </div>
    
                      <div class="row g-2 mt-4">                  
                        <div class="row">
                          <h5>Are guests allowed?</h5>
                        </div>
                        <div class="col-4 col-md-4 ms-md-2 ms-sm-2">
                          <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                            <input type="radio"  onclick="javascript:yesnoCheck2();" class="btn-check guestCheck" name="btnGuestradio" id="guestCheck1" autocomplete="off">
                            <label class="btn btn-outline-primary" for="guestCheck1">Yes</label>
                            
                            <input type="radio"  onclick="javascript:yesnoCheck2();" class="btn-check guestCheck" name="btnGuestradio" id="guestCheck2" autocomplete="off" checked>
                            <label class="btn btn-outline-primary" for="guestCheck2">No</label>
    
                          </div>
    
                        </div>
    
                        <div class="row g-2 mt-4"  id="ifYes2" style="display:none;" >                  
                            <div class="row">
                              <h5>Visitation Hours</h5>
                            </div>
                            <div class="col-8 col-md-6 ms-md-2 ms-sm-2 selectRoomType">
                                <select class="form-select" name="from_visit" id="from_visit" required>
                                    <option selected> - From - </option>
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
                                <select class="form-select" name="to_visit" id="to_visit" required>
                                    <option selected> - To - </option>
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
                            <input type="radio" class="btn-check" name="btnradioCooking" name="cooking" id="cooking" autocomplete="off" value="1" >
                            <label class="btn btn-outline-primary" for="cooking">Yes</label>
                            
                            <input type="radio" class="btn-check" name="btnradioCooking" name="cooking" id="cooking" autocomplete="off" value="0" checked>
                            <label class="btn btn-outline-primary" for="cooking">No</label>
    
                          </div>
                        </div>
                      </div>
    
                      <div class="row g-2 mt-4">                  
                        <div class="row">
                          <h5>Are alcoholic drinks allowed?</h5>
                        </div>
                        <div class="col-6 col-md-5 ms-md-2 ms-sm-2 mt-2">
                          <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                            <input type="radio" class="btn-check" name="btnradioParking" id="alcohol" name="alcohol" value="1" autocomplete="off">
                            <label class="btn btn-outline-primary" for="alcohol">Yes</label>
                            
                            <input type="radio" class="btn-check" name="btnradioParking" id="alcohol" name="alcohol" value="0"autocomplete="off" checked>
                            <label class="btn btn-outline-primary" for="alcohol">No</label>
    
                          </div>
                        </div>
                      </div>

                      <div class="row g-2 mt-4">                  
                        <div class="row">
                          <h5>Is vaping or smoking allowed?</h5>
                        </div>
                        <div class="col-6 col-md-5 ms-md-2 ms-sm-2 mt-2">
                          <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                            <input type="radio" class="btn-check" name="btnradioParking" id="smoking" name="smoking" value="1" autocomplete="off">
                            <label class="btn btn-outline-primary" for="smoking">Yes</label>
                            
                            <input type="radio" class="btn-check" name="btnradioParking" id="smoking" name="smoking" value="0" autocomplete="off" checked>
                            <label class="btn btn-outline-primary" for="smoking">No</label>
    
                          </div>
                        </div>
                      </div>
 
                      <div class="row g-2 mt-3">
                        <div class="button-row d-flex mt-4 col-12">
                          <button class="btn btn-primary js-btn-prev" type="button" title="Prev">Prev</button>
                          <button class="btn btn-primary ml-auto" type="button" title="Next">Submit</button>
                        </div>
                      </div>
    
    
                  </div>
                
                  </div>
                </div>
                </div>
              </div>
              
              <div class="form-group row">
                <div class="col-md-4">
                    <label for="reservation_fee" class="control-label">Reservation fee</label>
                    <input type="text" class="form-control" name="reservation_fee" id="reservation_fee" required>
                </div>
                <div class="col-md-4">
                    <label for="advance_deposit" class="control-label">Advance deposit</label>
                    <input type="text" class="form-control" name="advance_deposit" id="advance_deposit" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="images" class="control-label">Upload at least 5 images</label>
                <input type="file" class="form-control" name="images[]" id="image" multiple><br>
                <button class="btn btn-sm btn-outline-primary" id="add_titles" type="button">Add Image Titles</button>
                <div id="image_titles_container"></div>
                <div id="image_previews_container"></div>
            </div>
            <div class="form-group row">
                    <div class="col-md-4">
                            <label for="" class="control-label">Locate your property</label>
                            <!-- <div id='map' style='width: 400px; height: 300px;'></div> -->
                            <input type="hidden" name="latitude" value="15.145113074763598">
                            <input type="hidden" name="longitude" value="120.5950306751359">
                    </div>
            </div>
            <button class="btn btn-sm btn-outline-danger" id="submit-button" type="submit">Add</button>

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
        if (document.getElementById('curfewCheck1').checked) {
            document.getElementById('ifYes1').style.display = 'block';
        }
        else document.getElementById('ifYes1').style.display = 'none';

    }
  </script>

<script>
  function yesnoCheck2() {
      if (document.getElementById('guestCheck1').checked) {
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


<?php 
try {
    if(isset($_POST['property_type'], $_POST['property_name'], $_POST['landlord_id'],$_POST['total_floors'],$_POST['description'],$_POST['property_number'],$_POST['street'],$_POST['region_text'],$_POST['province_text'],$_POST['city_text'],$_POST['barangay_text'],$_POST['postal_code'],$_POST['latitude'],$_POST['longitude'],$_POST['reservation_fee'],$_POST['advance_deposit'])){
        $property_type = $_POST['property_type']; 
        $property_name = ucfirst($_POST['property_name']); 
        $landlord_id = $_POST['landlord_id']; 
        $total_floors = $_POST['total_floors'];
        $description = $_POST['description'];
        $property_number = $_POST['property_number'];
        $street = ucfirst($_POST['street']);
        $region_text = $_POST['region_text'];
        $province_text = $_POST['province_text'];
        $city_text = $_POST['city_text'];
        $barangay_text = $_POST['barangay_text'];
        $postal_code = $_POST['postal_code'];
        $latitude = $_POST['latitude'];
        $longitude = $_POST['longitude'];
        $reservation_fee = $_POST['reservation_fee'];
        $advance_deposit = $_POST['advance_deposit'];
        $status = 1;
        $lowest_rate = 0;
        $rent = $_POST['monthly_rent'];
        foreach($rent as $rate){
            if((intval($rate))>=(intval($lowest_rate))){
                $lowest_rate = $rate;
            }
        }
        $room_count = $_POST['total_rooms'];
        $total_rooms = array_sum($room_count);
        //add to properties table but status=2=pending
        
        $property = new Property();
        $property->setConnection($connection);
        $property_id = $property->addProperty($property_type, $property_name, $landlord_id, $total_rooms,$total_floors,$description,$property_number,$street,$region_text,$province_text,$city_text,$barangay_text,$postal_code,$latitude,$longitude,$lowest_rate,$reservation_fee,$advance_deposit,$status);

        //add to property amenities table but status=2=pending
        $amenities = $_POST['amenities'];
        $amenities_csv = implode(",", $amenities);

        $property_amenities = new Amenity($property_id, $amenities_csv, $status);
        $property_amenities->setConnection($connection);
        $property_amenities->addAmenities();

        //add to property rules table but status=2=pending
        $rules = new Rule();
        $rules->setConnection($connection);
        $rules->addRules($property_id, $_POST['short_term'], $_POST['min_weeks'], $_POST['mix_gender'], $_POST['curfew'], $_POST['from_curfew'], $_POST['to_curfew'], $_POST['cooking'], $_POST['pets'], $_POST['visitors'], $_POST['from_visit'], $_POST['to_visit'], $_POST['alcohol'], $_POST['smoking'],$status);

        //add to rooms table but status=2=pending
        $room_type = $_POST['room_type']; 
        $total_rooms = $_POST['total_rooms']; 
        //$beds = $_POST['total_beds']; 
        $rent = $_POST['monthly_rent']; 
        $type = $_POST['furnished_type']; 
        $occupied_beds = 0;

        $selected_amenities = $_POST['selected_amenities'];
        $amenities = json_decode($selected_amenities, true); 

            for ($x = 0; $x < (count($room_type)); $x++) {
                $bed_count = $room_type[$x];
                $room_total = $total_rooms[$x];
                $total_beds = intval($bed_count) * intval($room_total);
                $furnished_type = $type[$x];
                $monthly_rent = $rent[$x];
    
                
                $room = new Room();
                $room->setConnection($connection);
                $room_id = $room->addRoom($property_id, $bed_count, $room_total, $total_beds, $occupied_beds, $furnished_type, $monthly_rent, $status);
            }

            $imageData = $_FILES["images"] ?? NULL;

            // Loop through the uploaded images
            if(isset($imageData)){
                for ($i = 0; $i < count($imageData['name']); $i++) {
                    // Get the image properties
                    $imageName = $imageData['name'][$i];
                    $imageTmpName = $imageData['tmp_name'][$i];
                    $title = $_POST['image_title'][$i];
                
                    // Move the uploaded image to a directory on the server
                    $uploadDirectory = "../../resources/images/properties/";
                    $targetFilePath = $uploadDirectory . basename($imageName);
                    move_uploaded_file($imageTmpName, $targetFilePath);
                
                    $images = new Image();
                    $images->setConnection($connection);
                    $insert = $images->addImage($property_id, $imageName, $title, $status);
                    //var_dump($insert);
                    if($insert){ 
                        $statusMsg = "Images are uploaded successfully."; 
                    }else{ 
                        $statusMsg = "Sorry, there was an error uploading your file."; 
                    } 
                }
            }

        echo "<script>window.location.href='index.php?success=1';</script>";
        exit();
    } else {
        echo "<script>alert('Failed to add property. Please check your inputs.</script>";
    }
} catch (Exception $e) {
    echo "<script>window.location.href='index.php?error='" . $e->getMessage() . ";</script>";
    exit();
}