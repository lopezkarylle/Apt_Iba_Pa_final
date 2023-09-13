<?php
use Models\Appointment;
use Models\Reservation;
include "init.php";
include "session.php";

if(isset($_SESSION['user_id'])){
    $user_id = $_SESSION['user_id'] ?? NULL;
} else{
    header('location: index.php');
    exit();
}


$appointments = new Appointment('','','','','');
$appointments->setConnection($connection);
$appointments = $appointments->getUserAppointments($user_id);

$reservations = new Reservation('','','','','');
$reservations->setConnection($connection);
$reservations = $reservations->getUserReservations($user_id);

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Manage Reservations</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM"
      crossorigin="anonymous"
    />

    <link
      href="https://getbootstrap.com/docs/5.3/assets/css/docs.css"
      rel="stylesheet"
    />
    <script
      src="https://kit.fontawesome.com/868f1fea46.js"
      crossorigin="anonymous"
    ></script>

    <!-- Script of Reservations confirm/decline -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  

    <!-- Bootstrap Carousel CSS -->

    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
      integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g=="
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"
      integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw=="
      crossorigin="anonymous"
    />

    <link href="css/appointments.css" rel="stylesheet" />
    <link href="css/all.css" rel="stylesheet" />
  </head>
  <body>
    <!-- Navbar -->

<?php include('navbar.php'); ?>
  
      <!-- Navbar ends -->

    <!-- Featured section starts -->

    <div class="container-fluid reservationBg">
        <section class="reservations">
  
          <div class="container-md">
            <div class="row">
                <div class="col-md-2"></div>
              <div class="col-md-4">
                <h1 class="text-center text-sm-start myApt"><strong>Appointments</strong></h1>
              </div>
            </div>

            <div class="box-container">
              <div class="row gx-5 mb-3 d-flex justify-content-center">

              <?php foreach($appointments as $appointment){ 
                $property_id = $appointment['property_id'];
                $property_type = $appointment['property_type'];
                $property_name = $appointment['property_name'];
                $full_address = $appointment['property_number'] . ', ' . $appointment['street'] . ', ' . $appointment['barangay'] . ', ' . $appointment['city'];
                $date = date("F j, Y", strtotime($appointment['date']));
                $time = $appointment['time'];

                $datetime_str = $appointment['date'] . " " . $time;
                $timestamp = strtotime($datetime_str);
                $current_timestamp = time();
                
                ?>
                <div class="col-12 col-sm-6 col-xl-8">
                  <div class="box">
                    <div class="row">
                        <div class="col pt-3 ms-md-4 ps-md-3">
                            <p class="type"><span><?= $property_type ?></span></p>
                            <h3 class="name"><i class="fa-solid fa-location-dot"></i> <a href="view.php?<?= $property_id ?>" style="text-decoration: none; color: inherit;"><?= $property_name ?></a> </h3>
                            <h3 class="address"><?= $full_address ?></h3>
                        </div>
                    

                        <div class="col-6 col-md-4">
                        <div class="col mt-4 mt-md-3 pt-3 pt-md-4">
                            <?php if ($timestamp > $current_timestamp) {
                                    echo '<p class="statusU text-center"><span>Upcoming</span></p>';
                                } else {
                                    echo '<p class="statusF text-center"><span>Passed</span></p>';
                                } ?>
                            <h3 class="date text-center"><?= $date ?></h3>
                            <h3 class="time text-center"><?= $time ?></h3>
                        </div>
                      </div>

                    </div>

                  </div>
                </div>

                <?php } ?>
                  

              </div>
            </div>
            
            <hr style="border: 1px solid black; border-radius: 50px;">

            <div class="row">
            <div class="col-md-2"></div>
                <div class="col-md-4 mt-3">
                    <h1 class="text-center text-sm-start myApt"><strong>Reservations</strong></h1>
                </div>
            </div>
    
            <div class="box-container">
                <div class="row gx-5 mb-3 d-flex justify-content-center">
                <?php foreach($reservations as $reservation){ 
                    $property_id = $reservation['property_id'];
                    $property_type = $reservation['property_type'];
                    $property_name = $reservation['property_name'];
                    $full_address = $reservation['property_number'] . ', ' . $reservation['street'] . ', ' . $reservation['barangay'] . ', ' . $reservation['city'];
                    $payment = $reservation['payment_status'];
                    if($payment===1){
                        $payment_status = "Paid";
                    }else{
                        $payment_status = "Unpaid";
                    }
                    $room = $reservation['room_type'];
                    if($room===1){
                        $room_type = "Single Room";
                    } elseif($room===2) {
                        $room_type = "Double Room";
                    } elseif($room===3) {
                        $room_type = "Triple Room";
                    } elseif($room===4) {
                        $room_type = "Quad Room";
                    } elseif($room===5) {
                        $room_type = "5-Bed Room";
                    } elseif($room===6) {
                        $room_type = "6-Bed Room";
                    } elseif($room===7) {
                        $room_type = "7-Bed Room";
                    } elseif($room===8) {
                        $room_type = "8-Bed Room";
                    }

                    $status = $reservation['status'];
                    if($status===1){
                        $reservation_status = "Accepted";
                    } elseif($status===2) {
                        $reservation_status = "Pending";
                    } elseif($status===3) {
                        $reservation_status = "Declined";
                    } 

                ?>
                <div class="col-12 col-sm-6 col-xl-8">
                    <div class="box">
                    <div class="row">
                        <div class="col pt-3 ms-md-4 ps-md-3">
                            <p class="type"><span><?= $property_type ?></span></p>
                            <h3 class="name"><i class="fa-solid fa-location-dot"></i> <a href="view.php?<?= $property_id ?>" style="text-decoration: none; color: inherit;"><?= $property_name ?></a> </h3>
                            <h3 class="address"><?= $full_address ?></h3>
                            <h6 class="roomStatus"><?= $room_type ?></h6>
                        </div>
                    
    
                        <div class="col-6 col-md-4">
                        <div class="col mt-4 mt-md-3 pt-3 pt-md-4">
                            <p class="statusR text-center"><span><?= $reservation_status ?></span></p>
                            <h3 class="date text-center"><?= $payment_status ?></h3>
                        </div>
                        </div>
    
                    </div>
    
                    </div>
                </div>
                <?php } ?>
    
                </div>
            </div>
          </div>
        </section>



    </div>
  
      <!-- Featured ends -->

      <!-- Modals -->
      <div class="modal fade modalSection" id="modalConfirm" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Confirm the reservation</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="h6">Confirm room reservation and send an email?</div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button id="yesButton" type="button" class="btn btn-success" data-bs-dismiss="modal">Yes</button>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
            </div>
          </div>
        </div>
      </div>

            <!-- Modals -->
            <div class="modal fade modalSection" id="modalDecline" tabindex="-1">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Decline the reservation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                      <div class="container-fluid">
                          <div class="row">
                              <div class="h6">Decline room reservation and send an email?</div>
                          </div>
                      </div>
                  </div>
                  <div class="modal-footer">
                    <button id="declineButton" type="button" class="btn btn-success" data-bs-dismiss="modal">Yes</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                  </div>
                </div>
              </div>
            </div>
 

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




<!-- ... Rest of the HTML code ... -->

<script>
  $(document).ready(function () {
      // Define variables to store the clicked buttons
      let clickedConfirmButton = null;
      let clickedDeclineButton = null;
  
      // Listen for click events on the "Confirm for Payment" button
      $('.btnStatusC').on('click', function () {
          // Store the clicked "Confirm for Payment" button
          clickedConfirmButton = $(this);
      });
  
      // Listen for click events on the "Decline" button
      $('.btnStatusD').on('click', function () {
          // Store the clicked "Decline" button
          clickedDeclineButton = $(this);
      });
  
      // Listen for click events on the "Yes" button in the modal
      $('#yesButton').on('click', function () {
          // Check if the "Confirm for Payment" button was clicked before
          if (clickedConfirmButton !== null) {
              // Get the parent box container element and remove it from the DOM
              clickedConfirmButton.closest('.col-12').remove();
              // Reset the clickedConfirmButton variable
              clickedConfirmButton = null;
            }
      });
  
      $('#declineButton').on('click', function () {
          // Check if the "Decline" button was clicked before
          if (clickedDeclineButton !== null) {
              // Get the parent box container element and remove it from the DOM
              clickedDeclineButton.closest('.col-12').remove();
              // Reset the clickedDeclineButton variable
              clickedDeclineButton = null;
          }
      });
  });
      </script>
      
  <!-- javascript -->
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
    crossorigin="anonymous"
  ></script>

  <script src="js/accommodations.js"></script>



  <!-- JS of Carousel -->

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  <!-- Option 1: Bootstrap Bundle with Popper -->

  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
      integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw=="
      crossorigin="anonymous"></script>
  <script>
      $('.carousel-container').owlCarousel({
          loop: false,
          margin: 15,
          nav: true,
          navText:["<i class='fa-solid fa-arrow-left leftArrow'></i>",
                   "<i class='fa-solid fa-arrow-right rightArrow'></i>"],
          responsive: {
              0: {
                  items: 1
              },
              600: {
                  items: 2
              },
              1000: {
                  items: 3
              }
          }
      })

      $('.testimonials-container').owlCarousel({
        loop:true,
        autoplay:false,
        autoplayTimeout:6000,
        margin:10,
        nav:true,
        navText:["<i class='fa-solid fa-arrow-left leftArrow'></i>",
                "<i class='fa-solid fa-arrow-right rightArrow'></i>"],
        responsive:{
            0:{
                items:1,
                nav:false
            },
            600:{
                items:1,
                nav:true
            },
            768:{
                items:2
            },
        }
        })
  </script>

              
            <!--   *****   JQuery Link   *****   -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
            
            <!--   *****   Owl Carousel js Link  *****  -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>

</html>

