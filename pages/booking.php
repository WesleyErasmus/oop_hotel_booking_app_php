<style>
    <?php include '../css/viewBooking.css'; ?>
</style>
<?php
session_start();
// Include app header
include '../includes/header.php';
// Include booking class
include '../classes/bookingclass.php';
// DatabaseConnector
require_once "../data/DatabaseConnector.php";
$conn = new DatabaseConnector();
$conn = $conn->getConnection();
?>

<div class="container">

    <h3 class="pb-4 my-4 fst-italic border-bottom">View Hotel</h3>

    <!-- Displays selected hotel info in the DOM -->
    <div class="card mb-3 rounded-0 hotel-view-card">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="<?php echo $hotel['thumbnail']; ?>" class="img-fluid start" alt="Hotel Thumbnail" />
            </div>
            <div class="col-md-8">
                <div class="card-body mb-0 pb-0">
                    <h3 class="card-title mb-2"><b><?php echo $hotel['name']; ?></b></h3>

                    <div>
                        <div class="card-text mb-2">
                            <div class="mb-2">Type:
                                <b><?php echo $hotel['type']; ?></b>
                            </div>

                            <!-- Hotel star for loop iterating iterating as many times as the hotel rating value -->
                            <?php
                            for ($i = 0; $i < $hotel['rating']; $i++) {
                                echo '<i class="bi bi-star-fill" style="color: gold;"></i>';
                            }; ?>

                        </div>
                    </div>
                    <div class="card-text">
                        <div class="mb-2">
                            <span><i class="bi bi-shop"></i> Beds:
                                <b><?php echo $hotel['beds']; ?>
                                </b></span>
                            <span><i class="bi-suit-heart"></i> <span class="badge text-bg-primary">Features:</span>
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
                </div>
            </div>
        </div> <!-- End of hotel display by id function -->
    </div>

    <!-- Total cost form -->
    <form class="calc-cost-form rounded-5 pt-0" method="post" action="" style="padding: 2rem;">
        <div>
            <span class="h4 gradient-text">Calculate the price of your trip</span>
        </div>

        <!-- Auto display total cost -->
        <div class="lead cost-auto-display text-muted mb-4 pt-2 float-start gradient-text">
            The price will display here:
            <h5 class="mt-2">
                <span id="totalCost"></span>
            </h5>
        </div>

        <div class="input-group">
            <!-- Check-in -->
            <label class="form-control rounded-start-pill text-muted" for="checkindate"><b><span class="">Select a Check-In Date: </span></b>
                <input type="date" id="checkindate" name="checkindate" class="lead text-muted" required>
            </label>

            <!-- Check-out -->
            <label class="form-control text-muted" for="checkoutdate"><b><span class="">Select a Check-Out Date: </span></b>
                <input type="date" id="checkoutdate" name="checkoutdate" class="lead text-muted" required></label>

            <!-- Submit button -->
            <input type="submit" value="Make Booking" class="btn btn-primary rounded-end-pill">
        </div>
    </form>

    <!-- JS date validation to prevent booking a date in the past -->
    <script>
        var today = new Date();
        document.querySelector("#checkindate").min = today.toISOString().split("T")[0];
    </script>
    <script>
        var today = new Date();
        document.querySelector("#checkoutdate").min = today.toISOString().split("T")[0];
    </script>
    <!-- End of date check validation -->

    <hr>
    <!-- Back btn to Hotels page -->
    <button class="btn btn-secondary"><a href="../pages/hotel.php" style="color: #fff; text-decoration: none;">Back to Hotels</a></button>

    <?php include '../components/compareHotelModal.php'; ?>


    <?php
    // check if checkindate and checkoutdate are set
    if (isset($_POST['checkindate']) && isset($_POST['checkoutdate'])) {
        $pricepernight = $hotel['pricepernight'];

        // calculate the number of nights
        $checkindate = new DateTime($_POST['checkindate']);
        $checkoutdate = new DateTime($_POST['checkoutdate']);
        $nights = $checkoutdate->diff($checkindate)->format("%a");

        // calculate the total cost
        $totalCost = $nights * $pricepernight;

        // Capturing booking info into session storage
        $_SESSION['checkindate'] = $checkindate;
        $_SESSION['checkoutdate'] = $checkoutdate;
        $_SESSION['nights'] = $nights;
        $_SESSION['totalcost'] = $totalCost;
        $_SESSION['booking'] = $booking;

        // Couldn't get header location to work, using a html meta url
        echo "<meta http-equiv='refresh' content='0;url=../pages/confirmBookingPage.php'>";
    }
    ?>

    <script>
        // Calculates total cost of stay based on check-in date and checkout date, then displays in the the webpage once the checkout date field is filled in
        document.getElementById("checkoutdate").addEventListener("change", calculateTotalCost);

        function calculateTotalCost() {
            let checkin = new Date(document.getElementById("checkindate").value);
            let checkout = new Date(document.getElementById("checkoutdate").value);
            let nights = (checkout - checkin) / (1000 * 60 * 60 * 24);
            let pricepernight = "<?php echo $hotel['pricepernight']; ?>";
            let totalCost = nights * pricepernight;
            document.getElementById("totalCost").innerHTML = "Total: R" + totalCost + " for " + nights + " nights";
        }
    </script>

    <?php include '../includes/footer.php' ?>