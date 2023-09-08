<?php
use Models\Property;
include ("init.php");
include ("session.php");

$user_id = $_SESSION['user_id'] ?? NULL;

$current_page = "| About";
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Apt Iba Pa | About Us</title>
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
        <link href="css/aboutUs.css" rel="stylesheet" />
        <link href="css/all.css" rel="stylesheet" />
    </head>

  <body>
    <!-- Navbar -->
    
        <?php include('navbar.php'); ?>

    <!-- Navbar ends -->

    <!-- Services -->
    <div class="container-fluid pt-5 pb-5">
      
        <div class="row aboutUsTitle">
          <div class="col">
          <h2 class="section-heading">About Us</h2>
          </div>
        </div>
        <div class="row aboutUsText">
          <p class="about-info"></p>
        </div>
      

      <div class="container-fluid pt-3">
        <section class="aboutUs">

          <div class="row justify-content-center">
            <div class="column">
              <div class="card">
                <div class="icon-wrapper">
                  <i class="fa-solid fa-map-location-dot"></i>
                </div>
                <h3>Map-based Directory</h3>
                <p>
                  Our map interface allows users to visualize the exact locations of dormitories and apartments near to AUF. 
                </p>
              </div>
            </div>
            <div class="column">
              <div class="card">
                <div class="icon-wrapper">
                  <i class="fa-solid fa-list"></i>
                </div>
                <h3>Extensive Listings</h3>
                <p>
                  Our listings include detailed information such as rental rates, facilities, nearby amenities, and contact details.
              </div>
            </div>
            <div class="column">
              <div class="card">
                <div class="icon-wrapper">
                  <i class="fa-solid fa-comments"></i>
                </div>
                <h3>Community Reviews</h3>
                <p>
                  This helps create an active community where individuals can exchange valuable insights, fostering a reliable platform.
                </p>
              </div>
            </div>
          
            
          <!-- <div class="row justify-content-center"> -->
            <div class="column">
              <div class="card">
                <div class="icon-wrapper">
                  <i class="fa-solid fa-sliders"></i>
                </div>
                <h3>Customized Living</h3>
                <p>
                  Users can narrow down their options based on preferences such as rental budget, room types, amenities, and more.
                </p>
              </div>
            </div>
            <div class="column">
              <div class="card">
                <div class="icon-wrapper">
                  <i class="fa-solid fa-phone-volume"></i>
                </div>
                <h3>Easy Communication</h3>
                <p>
                  Users can easily connect with the relevant contacts for inquiries, booking appointments, and securing their desired accommodations.
                </p>
              </div>
            </div>
          <!-- </div> -->

            <!-- <div class="column">
              <div class="card">
                <div class="icon-wrapper">
                  <i class="fa-solid fa-plug"></i>
                </div>
                <h3>Service Heading</h3>
                <p>
                  Users can easily connect with the relevant contacts for inquiries, booking appointments, and securing their desired accommodations.
                </p>
              </div>
            </div> -->

          </div>
        </section>
      </div>
  </div>

    <!-- Services ends -->

<hr>
    
    <!-- FAQs -->
  <div class="container-fluid pt-5 pb-5">
      
    <div class="row faqSectionTitle">
      <div class="col">
        <h2 class="section-heading">Frequently Asked Questions</h2>
      </div>
    </div>
    
    <div class="row faqSectionText">
      <p class="about-info"></p>
    </div>
        
    <div class="container-md pt-3">
      <section class="faqSection">

        <div class="accordion p-3 m-0 border-0 m-0 border-0" id="accordionExample">
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                What is the deposit amount?
              </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                A <strong>&#8369;3,000</strong> deposit is required at the time of application.
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                Are pets allowed?
              </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                <strong>No.</strong> Pets are not allowed in the apartments. The only pets allowed are aquarium-bound fish in a tank no larger than 10 gallons. Residents must maintain responsibility for the aquariums at all times.
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                What is the lease/contract term?
              </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                The term of the contract is <strong>month-to-month.</strong> The student may remain as long as he/she is eligible to occupy a University on-campus apartment. 
              </div>
            </div>
          </div>
        </div>

      </section>
    </div>

        
  </div>
  <!-- FAQs ends -->

<hr>

    <!-- offers starts  -->
        <div class="container-fluid jumbuildings">
          <section class="offers">
            <h1 class="offersTitle">Latest Offers</h1>
            <p class="offersInfo">
              Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quisquam
              consequatur necessitatibus eaque. Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quisquam
              consequatur necessitatibus eaque. Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quisquam
              consequatur necessitatibus eaque. Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quisquam
              consequatur necessitatibus eaque.</p>

            <div class="container-md mb-5">
              <div class="box-container">
                <div class="row mt-5">

                  <div class="col-md-4 p-3">
                    <div class="box">
                      <img src="images/icon-6.png" alt="">
                      <h3>Online Catalogue</h3>
                      <p>Choose from different spaces, reserve, and schedule
                      your second home with one click</p>
                  </div>
                  </div>

                  <div class="col-md-4 p-3">
                    <div class="box">
                      <img src="images/icon-7.png" alt="">
                      <h3>Customer Support</h3>
                      <p>Ask for help from the team, anytime. 
                      Just send us a message and get back to you 
                      immediately.</p>
                    </div>
                  </div>

                  <div class="col-md-4 p-3">
                    <div class="box">
                      <img src="images/icon-8.png" alt="">
                      <h3>A space to call Home</h3>
                      <p>A place you can call home, somewhere you can
                      work and relax at the same time.</p>
                    </div>
                  </div>

                </div>

                <div class="row">

                  <div class="col-md-4 p-3">
                    <div class="box">
                      <img src="images/icon-9.png" alt="">
                      <h3>Built-In Comfort</h3>
                      <p>Functional spaces with amenities that cater to 
                      your basic needs and comfortability.</p>
                    </div>
                  </div>

                  <div class="col-md-4 p-3">
                    <div class="box">
                      <img src="images/icon-10.png" alt="">
                      <h3>Well-secured Spaces</h3>
                      <p>Our homes come with CCTV, caretakers, and security
                      personnel you can rely on for your safety.</p>
                    </div>
                  </div>

                  <div class="col-md-4 p-3">
                    <div class="box">
                      <img src="images/icon-11.png" alt="">
                      <h3>Regular Maintenance</h3>
                      <p>Regular maintenance to your spaces that cater to 
                      your basic needs and comfortability.</p>
                    </div>
                  </div>

                </div>

              </div>
            </div>
            
          </section>
        </div>

    <!-- offers section ends -->

    <hr>


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

</html>
