<!-- About Apt Iba Pa -->
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
  <?php include('footer.php'); ?>
    <!-- Footer ends -->
  



    


  </body>

  <!-- javascript -->
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
    crossorigin="anonymous"
  ></script>

</html>
