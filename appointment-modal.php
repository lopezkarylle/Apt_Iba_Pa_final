<?php 
use Models\Schedule; //remove when included in php page
use Models\Appointment; //remove when included in php page

$property_id = $_SESSION['property_view_id'];
$disabled_dates = [];
$date_time = new Schedule('','','');
$date_time->setConnection($connection);
$date_time = $date_time->getDateTime($property_id);

foreach($date_time as $date_item){
  $unavailable_date = $date_item['date'];
  $time_list = $date_item['time'];
  $time_list = explode(",", $time_list);
  if ((count($time_list))===21){
    $disabled_dates[]=$unavailable_date;
  }
}

//var_dump($disabled_dates);

?>

<!DOCTYPE html>
<html>
<head>
    <!-- Include jQuery library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head>
<body>
<!-- Modal -->
<div class="modal fade" id="requestVisit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="requestVisitLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg overflow-x-hidden ">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-3" id="requestVisitLabel">Schedule a Visit </h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body overflow-x-hidden  modalTimeslots">

          <div class="container">

            <form>
              <!-- Form start -->
              <div class="container pt-5 pb-5 bgTimeSlots timeSlots">

                <div class="row">
                  <h3 class="text-center">View the property on</h3>
                  <div class="col-md">
                    <h2 class="ms-3 apptDate" id="selected_date">  </h2>
                  </div>
                </div>

                <div class="row justify-content-center">

                  
                  <div class="col-md-4">

                    <form action="#">
                      <div class="form-group p-3 datePicker">
                        <input type="date" class="form-control" id="pick-date" placeholder="Pick A Date">
                        <input type="hidden" name="property_id" value="<?= $property_id ?>" id="property_id">
                      </div>
                      
                      <h5 class="text-center">*Click to change date</h5>
                    </form>

                  </div>
                </div>


                <div id="time_slots">
                <div class="row ps-4 h3 mt-2">
                  <h2 class="dayzone">
                    <img src="images/dayzone1.png" alt=""/>
                    Morning
                  </h2>
                  <h2 class="timezone">8:00 AM to 11:30 AM</h2>
                </div>
                
                <?php
                $morning_slots = array("08:00 AM","08:30 AM","09:00 AM","09:30 AM","10:00 AM","10:30 AM","11:00 AM","11:30 AM");

                $row_count = 0;
                $col_count = 0;

                echo '<div class="row pt-5 justify-content-center">';
                foreach ($morning_slots as $time_slot) {
                if ($col_count == 4) {
                    echo '</div><div class="row pt-5 justify-content-center">';
                    $col_count = 0;
                }

                echo '<div class="col-5 col-sm-3 col-lg-2 d-flex justify-content-center"><a class="btn btn-outline-secondary disabled" data-bs-toggle="modal" data-bs-target="#modal" role="button"><i class="fa-regular fa-clock"></i> ' . $time_slot . '</a></div>';
                $col_count++;
                }
                echo '</div>';

                ?>
                
                <div class="row ps-4 h3 mt-5">
                  <hr>
                  <h2 class="dayzone pt-4">
                    <img src="images/dayzone2.png" alt=""/>
                    Afternoon
                  </h2>
                  <h2 class="timezone">1:00 PM to 5:30 PM</h2>
                </div>
                  
                <?php
                $afternoon_slots = array("01:00 PM","01:30 PM","02:00 PM","02:30 PM","03:00 PM", "03:30 PM","04:00 PM","04:30 PM","05:00 PM","05:30 PM","06:00 PM");

                $row_count = 0;
                $col_count = 0;

                echo '<div class="row pt-5 justify-content-center">';
                foreach ($afternoon_slots as $time_slot) {
                if ($col_count == 4) {
                    echo '</div><div class="row pt-5 justify-content-center">';
                    $col_count = 0;
                }

                echo '<div class="col-5 col-sm-3 col-lg-2 d-flex justify-content-center"><a class="btn btn-outline-secondary disabled" data-bs-toggle="modal" data-bs-target="#modal" role="button"><i class="fa-regular fa-clock"></i> ' . $time_slot . '</a></div>';
                $col_count++;
                }
                echo '</div>';

                ?>
                </div>
          </form>
          <!-- form end -->

          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    $(document).ready(function() {
    var pickDateInput = $("#pick-date");
    var selectedDateH2 = $("#selected_date");
    var property_id = $("#property_id");

    // Set the min attribute to today's date
    var currentDate = new Date();
    currentDate.setUTCHours(currentDate.getUTCHours() + 8); // Convert UTC to Philippine time
    pickDateInput.attr("min", formatDate(currentDate));

    // Format a date as yyyy-mm-dd for setting min attribute
    function formatDate(date) {
        var yyyy = date.getFullYear();
        var mm = String(date.getMonth() + 1).padStart(2, '0');
        var dd = String(date.getDate()).padStart(2, '0');
        return yyyy + "-" + mm + "-" + dd;
    }

    // When the date input changes, update the text on the h2 element
    pickDateInput.on('change', function() {
        var inputDate = pickDateInput.val();
        var propertyId = property_id.val();

        var date = new Date(inputDate);

        // Continue with the rest of your code
        var monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        var year = date.getFullYear();
        var month = date.getMonth();
        var day = date.getDate();
        var formattedDate = monthNames[month] + " " + (day < 10 ? '0' : '') + day + ", " + year;
        selectedDateH2.text(formattedDate);

        performAjax({ 
            set_date: inputDate, 
            property_id: propertyId 
        });
    });

    function performAjax(data) {
        $.ajax({
            url: 'check-date.php',
            type: 'POST',
            data: data,
            success: function(response) {
                $('#time_slots').html(response);
            }
        });
    }
});

    </script>
    </body>
  </html>