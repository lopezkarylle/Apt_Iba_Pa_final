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
  <div class="modal fade" id="reserveRoom" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="reserveRoomLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-3" id="reserveRoomLabel">Reservation</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body modalReserveroom">

          <div class="container">

            <form>
              <!-- Form start -->
              <div class="container pt-5 pb-5 bgReserveroom reserveRoomType">

                <div class="row">
                  <h3 class="text-center">Reserve a Room</h3>
                  <div class="col-md">
                    <h2 class="apptDate">August 04, 2023</h2>
                  </div>
                </div>

                <div class="row justify-content-center mt-2">
                  <div class="col-md-6">

                    <form action="#">
                      
                      <div class="row mt-2">
                        <div class="col-12">
                          <label class="radio w-100">
                            <input type="radio" name="add" value="1 bed | ₱5,000" checked />
                            <div
                              class="row justify-content-between p-3 radioRoomType" id="pickRoomType">
                              <div class="col-8">
                                  <span class="roomTypeName">Single Room</span>
                                <div class="row">
                                  <span class="roomTypeDetails">1 bed | ₱5,000</span>
                                </div>
                              </div>
                      
                              <div class="col-3">
                                <i class="fa-solid fa-bed fa-4x float-end"></i>
                              </div>
                            </div>
                          </label>
                        </div>
                      </div>
                      

                      <div class="row mt-2">
                        <div class="col-12">
                          <label class="radio w-100">
                            <input type="radio" name="add" value="1 bed | ₱5,000"/>
                            <div
                              class="row justify-content-between p-3 radioRoomType" id="pickRoomType">
                              <div class="col-8">
                                  <span class="roomTypeName">2-bed Room</span>
                                <div class="row">
                                  <span class="roomTypeDetails">2 bed | ₱5,800</span>
                                </div>
                              </div>
                      
                              <div class="col-3">
                                <i class="fa-solid fa-bed fa-4x float-end"></i>
                              </div>
                            </div>
                          </label>
                        </div>
                      </div>

                      <div class="row mt-2">
                        <div class="col-12">
                          <label class="radio w-100">
                            <input type="radio" name="add" value="1 bed | ₱5,000" />
                            <div
                              class="row justify-content-between p-3 radioRoomType" id="pickRoomType">
                              <div class="col-8">
                                  <span class="roomTypeName">3-bed Room</span>
                                <div class="row">
                                  <span class="roomTypeDetails">3 bed | ₱6,000</span>
                                </div>
                              </div>
                      
                              <div class="col-3">
                                <i class="fa-solid fa-bed fa-4x float-end"></i>
                              </div>
                            </div>
                          </label>
                        </div>
                      </div>

                      <div class="row mt-2">
                        <div class="col-12">
                          <label class="radio w-100">
                            <input type="radio" name="add" value="1 bed | ₱5,000" />
                            <div
                              class="row justify-content-between p-3 radioRoomType" id="pickRoomType">
                              <div class="col-8">
                                  <span class="roomTypeName">4-bed Room</span>
                                <div class="row">
                                  <span class="roomTypeDetails">4 bed | ₱7,000</span>
                                </div>
                              </div>
                      
                              <div class="col-3">
                                <i class="fa-solid fa-bed fa-4x float-end"></i>
                              </div>
                            </div>
                          </label>
                        </div>
                      </div>
                        
                      </form>

                  </div>
                  
                </div>





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

    

  </body>
  </html>