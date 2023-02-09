<?php
session_start();
$user = $_SESSION['user'];
$nights = $_SESSION['nights'];
// DatabaseConnector
require_once "../data/DatabaseConnector.php";
$conn = new DatabaseConnector();
$conn = $conn->getConnection();

// include bookingconfirmation php functions
include '../includes/bookingconfirmation.php';
// Include header
include '../includes/header.php';
?>

<!-- Displays selected hotel info in the DOM -->
<div class="container">
    <h3 class="pb-4 mt-4 mb-4 fst-italic border-bottom">Please confirm your booking details at <?php echo $hotel['name']; ?></h3>
    <div class="card mb-3 p-2 bg-light border-0">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="<?php echo $hotel['thumbnail']; ?>" class="p-1 img-fluid" alt="Hotel Thumbnail">
            </div>
            <div class="col-md-8">
                <div class="card-body m-2 pb-0">
                    <h3 class="card-title mb-2"><b><?php echo $hotel['name']; ?></b></h3>
                    <div class="card-text mb-2">
                        <div class="mb-2">
                            <b>Type:</b>
                            <b><span class="badge text-bg-primary"><?php echo $hotel['type']; ?></span></b>
                        </div>
                    </div>

                    <!-- bookmark-check -->
                    <div>
                        <span class="card-text"><i class="bi-calendar-check-fill fs-4 me-2" style="color: green;"></i><b>Checkin on </b><?php echo $checkindate->format('Y-m-d'); ?></span>
                        <span class="card-text"><i class="bi-calendar-minus-fill fs-4 me-2" style="color: grey;"></i><b>Checkout on </b><?php echo $checkoutdate->format('Y-m-d'); ?></span>
                    </div>
                    <div class="card-text"><b>Price per night:</b> R<?php echo $hotel['pricepernight']; ?></div>
                    <div class="card-text"><i class="bi-building-fill-check fs-4 me-2" style="color: gray;"></i><b>Number of nights booked: </b><?php echo $nights; ?></div>
                    <div class="card-text"><i class="bi-credit-card fs-4 me-2" style="color: blue;"></i><b>Total cost of stay:</b> R<?php echo $totalCost; ?></div>

                    <form class="mt-3" action="" method="post">
                        <input type="hidden" name="hotelid" value="<?php echo $hotelid; ?>">
                        <input type="hidden" name="checkindate" value="<?php echo $checkindate->format('Y-m-d') ?>">
                        <input type="hidden" name="checkoutdate" value="<?php echo $checkoutdate->format('Y-m-d'); ?>">
                        <input type="hidden" name="totalcost" value="<?php echo $totalcost; ?>">
                        <input type="hidden" name="cancelled" value="<?php echo $cancelled; ?>">


                        <!-- Complete booking and cancel button -->
                        <input class="btn btn-primary" type="submit" name="complete_booking" value="Complete Booking">
                        <input type="submit" name="cancel_booking" class="btn btn-secondary" value="Cancel Booking">
                    </form>
                </div>
                <!-- Hotel features sub-card -->
            </div>
        </div>
    </div>
</div>