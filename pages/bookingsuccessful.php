<?php
session_start();
// Get booking number
$bookingno = $_SESSION['booking']['bookingno'];

require_once "../data/DatabaseConnector.php";
$conn = new DatabaseConnector();
$conn = $conn->getConnection();

include '../includes/header.php';
?>

<div class="container">
    <h3 class="pb-4 my-4 fst-italic border-bottom">Your booking was successful.</h3>
    <div class="bg-light p-5 rounded-2 text-center">
        <h3 class="text-muted">Thank you for booking with StayInn.com</h3>
        <h5 class="lead mt-4">Your order number is: <b>"<?php echo $bookingno; ?>"</b></h5>
        <div class="d-flex justify-content-center mt-4">
            <div class="d-grid gap-2 col" style="max-width:475px">
                <!-- View Bookings button -->
                <button class="btn btn-primary"><a style="color: #fff; text-decoration: none;" href="../pages/managebooking.php">View booking</a></button>
                <!-- Download Invoice button -->
                <button class="btn btn-outline-primary" id="download-button">Download Invoice</button>
                <!-- Done button -->
                <button class="btn btn-success px-5"><a style="color: #fff; text-decoration: none;" href="../pages/hotel.php">Done</a></button>
            </div>
        </div>
    </div>
</div>

<!-- Script event listener to download invoice -->
<script>
    document.getElementById("download-button").addEventListener("click", function() {
        window.location.href = "../pages/confirmbookingpage.php?download=true";
    });
</script>
<?php
include '../includes/footer.php';
?>