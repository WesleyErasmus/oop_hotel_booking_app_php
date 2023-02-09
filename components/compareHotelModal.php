   <?php include '../classes/hotelclass.php';
    // Used to display the hotel selected in booking.php page
    $hotel = $_SESSION['hotel'];
    ?>
   <!-- Button trigger modal -->
   <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
       Compare with other similar hotels
   </button>

   <!-- Modal -->
   <div class="modal modal-dialog-scrollable fade modal-lg" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
       <div class="modal-dialog">
           <div class="modal-content">
               <div class="modal-header">
                   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                   <h5 class="modal-title fst-italic" id="exampleModalLabel">View similar hotels
                   </h5>

                   <!-- <hr> -->

                   <!-- Displays selected hotel info in the DOM -->
                   <div class="card mb-3 rounded-0 top-selected-hotel p-2">
                       <div class="row g-0">
                           <div class="col-md-4">
                               <img src="<?php echo $hotel['thumbnail']; ?>" class="img-fluid start" alt="Hotel Thumbnail" />
                           </div>
                           <div class="col-md-8">
                               <div class="card-body mb-0 pb-0">
                                   <h5 class="card-title mb-2"><b><?php echo $hotel['name']; ?></b></h5>
                                   <!-- Hotel star for loop iterating iterating as many times as the hotel rating value -->
                                   <?php
                                    for ($i = 0; $i < $hotel['rating']; $i++) {
                                        echo '<i class="bi bi-star-fill" style="color: gold;"></i>';
                                    }; ?>
                                   <div>
                                       <div class="card-text mb-2">
                                           <small>
                                               <span class="mb-2">Type:
                                                   <b><?php echo $hotel['type']; ?></b>
                                               </span>
                                       </div>
                                   </div>
                                   <div class="card-text">
                                       <div class="mb-2">
                                           <span><i class="bi bi-shop"></i> Beds:
                                               <b><?php echo $hotel['beds']; ?>
                                               </b></span>
                                           <span><i class="bi bi-suit-heart"></i> Features:
                                               <b><?php echo $hotel['features']; ?>
                                               </b></span>
                                       </div>
                                       <div>
                                           <div class="mb-2"><i class="bi bi-pin-map"></i>
                                               <b><?php echo $hotel['location']; ?>
                                               </b>
                                           </div>
                                           <div>
                                               <span><i class="bi bi-credit-card"></i>
                                                   <b>R<?php echo $hotel['pricepernight']; ?>
                                                   </b> /per night</d>
                                           </div>
                                       </div>
                                   </div>
                                   </small>
                               </div>
                           </div>
                       </div> <!-- End of hotel display by id function -->
                   </div>

               </div>
               <div class="modal-body">
                   <div class="card mb-3 rounded-0">
                       <?php foreach ($related_hotels as $data) : ?>
                           <div class="row g-0">
                               <div class="col-md-4">
                                   <img src="<?php echo $data['thumbnail']; ?>" class="img-fluid start" alt="Hotel Thumbnail" />
                               </div>
                               <div class="col-md-8">
                                   <div class="card-body">
                                       <h5 class="card-title"><b><?php echo $data['name']; ?></b></h5><?php

                                    // Comparing hotel price per night check
                                       if($data['pricepernight'] < $hotel['pricepernight']) {
                                        echo $compare_hotel_pricing = Hotel::compareHotelPricing();
                                       }   
                                        ?>
                                       <span>
                                           <!-- Hotel star for loop iterating iterating as many times as the hotel rating value -->
                                           <b><?php
                                                for ($i = 0; $i < $data['rating']; $i++) {
                                                    echo '<i class="bi bi-star-fill" style="color: gold;"></i>';
                                                }; ?>
                                           </b></span>
                                       <small>
                                           <div class="card-text">
                                               <span>Type:
                                                   <b><?php echo $data['type']; ?></b></span>
                                           </div>
                                       </small>
                                       <div class="card-text">
                                           <small class="">
                                               <span><i class="bi bi-shop"></i> Beds:
                                                   <b><?php echo $data['beds']; ?>
                                                   </b></span>
                                               <span><i class="bi bi-suit-heart"></i> <span class="badge text-bg-primary">Features:</span>
                                                   <b><?php echo $data['features']; ?>
                                                   </b></span>
                                           </small>
                                           <div>
                                               <span><i class="bi bi-pin-map"></i>
                                                   <b><?php echo $data['location']; ?>
                                                   </b></span>
                                               <div>
                                                   <span><i class="bi bi-credit-card"></i>
                                                       <b>R<?php echo $data['pricepernight']; ?>
                                                       </b> /per night</d>
                                                       <div class="btn-group float-end">
                                                           <!-- Must be logged in popover conditional. Popover is triggered if user is not logged in -->
                                                           <span class="d-inline-block" tabindex="0" <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
                                                                                                            echo '';
                                                                                                        } else {
                                                                                                            echo 'data-bs-toggle="popover"';
                                                                                                        } ?> data-bs-trigger="focus" data-bs-html="true" data-bs-title="You must be logged in to use this feature" data-bs-content="<a class='btn btn-sm btn-success' href='../pages/login.php'>Login Here</a> <a class='btn btn-sm btn-primary' href='../pages/signup.php'>Sign-up Here</a>">
                                                               <!-- Button disabled conditional. Button is disabled if user is not logged in -->
                                                               <a href="../pages/booking.php?id=<?php echo $data['id']; ?>" class="btn btn-outline-secondary <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
                                                                                                                                                                    echo '';
                                                                                                                                                                } else {
                                                                                                                                                                    echo 'disabled';
                                                                                                                                                                } ?>">View this hotel</a></span>
                                                       </div>
                                               </div>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                           </div>
                           <hr />
                       <?php endforeach; ?>
                   </div>
                   <div class="modal-footer">
                       <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                   </div>
               </div>
           </div>
       </div>