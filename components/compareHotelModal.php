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

                   <!-- Displays selected hotel from the hotel view page -->
                   <div class="card mb-3 rounded-0 top-selected-hotel p-2">
                       <div class="row g-0">
                           <div class="col-md-4">

                            <!-- Hotel thumbnail -->
                               <img src="<?php echo $hotel['thumbnail']; ?>" class="img-fluid start" alt="Hotel Thumbnail" />
                           </div>
                           <div class="col-md-8">
                               <div class="card-body mb-0 pb-0">

                               <!-- Hotel name -->
                                   <h5 class="card-title mb-2"><b><?php echo $hotel['name']; ?></b></h5>

                                   <!-- Hotel star for loop iterating iterating as many times as the hotel rating value -->
                                   <?php
                                    for ($i = 0; $i < $hotel['rating']; $i++) {
                                        echo '<i class="bi bi-star-fill" style="color: gold;"></i>';
                                    }; ?>
                                   <div>

                                   <!-- Hotel type -->
                                       <div class="card-text mb-2">
                                           <small>
                                               <span class="mb-2">Type:
                                                   <b><?php echo $hotel['type']; ?></b>
                                               </span>
                                       </div>
                                   </div>
                                   <div class="card-text">

                                   <!-- Hotel beds -->
                                       <div class="mb-2">
                                           <span><i class="bi bi-shop"></i> Beds:
                                               <b><?php echo $hotel['beds']; ?>
                                               </b></span>

                                               <!-- Hotel features -->
                                           <span><i class="bi bi-suit-heart"></i> Features:
                                               <b><?php echo $hotel['features']; ?>
                                               </b></span>
                                       </div>
                                       <div>

                                       <!-- Hotel location -->
                                           <div class="mb-2"><i class="bi bi-pin-map"></i>
                                               <b><?php echo $hotel['location']; ?>
                                               </b>
                                           </div>

                                           <!-- Hotel price per night -->
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

               <!-- Modal body -->
               <div class="modal-body">

               <?php include '../components/relatedHotels.php'; ?>

                   <!-- Close modal button -->
                   <div class="modal-footer">
                       <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                   </div>
               </div>
           </div>
       </div>