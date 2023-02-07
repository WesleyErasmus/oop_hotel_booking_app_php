<?php
session_start();
// Get booking number
$bookingno = $_SESSION['booking']['bookingno'];

require_once "../data/DatabaseConnector.php";
$conn = new DatabaseConnector();
$conn = $conn->getConnection();

include '../includes/header.php';
?>

<center>
    <h1>Your booking was successful.</h1>
    <br>
    <h3>Thank you for booking with StayInn.com</h3>

    <h5>Your order number is: <b>"<?php echo $bookingno; ?>"</b></h5>

    <br>

    <div>
        <!-- Done button -->
        <button class="btn btn-success"><a style="color: #fff; text-decoration: none;" href="../pages/hotel.php">Done</a></button>
        <!-- View Bookings button -->
        <button class="btn btn-primary"><a style="color: #fff; text-decoration: none;" href="../pages/managebooking.php">View booking</a></button>
    </div>

    <button class="btn btn-info" id="download-button">Download Invoice</button>

    <!-- Script event listener to download invoice -->
    <script>
        document.getElementById("download-button").addEventListener("click", function() {
            window.location.href = "../pages/confirmbookingpage.php?download=true";
        });
    </script>
</center>


<?php
include '../includes/footer.php';
?>