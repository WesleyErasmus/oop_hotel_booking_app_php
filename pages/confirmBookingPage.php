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
    <div class="card mb-3">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="<?php echo $hotel['thumbnail']; ?>" class="img-fluid rounded-start" alt="Hotel Thumbnail">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h4 class="card-title"><?php echo $hotel['name']; ?></h4>
                    <div class="card-text">Type: <?php echo $hotel['type']; ?></div>
                    <div class="card-text">Checkin date: <?php echo $checkindate->format('Y-m-d'); ?></div>
                    <div class="card-text">Checkout date: <?php echo $checkoutdate->format('Y-m-d'); ?></div>
                    <div class="card-text">Price per night: R<?php echo $hotel['pricepernight']; ?></div>
                    <div class="card-text">Number of nights booked: <?php echo $nights; ?></div>
                    <div class="card-text">Total cost of stay: R<?php echo $totalCost; ?></div>

                    <form action="" method="post">
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