<?php
// Session data
$checkindate = $_SESSION['checkindate'];
$checkoutdate = $_SESSION['checkoutdate'];
$totalCost = $_SESSION['totalcost'];
$hotel = $_SESSION['hotel'];


function completeBooking()
{
    // Setting variables
    $user = $_SESSION['user'];
    $checkindate = $_SESSION['checkindate'];
    $checkoutdate = $_SESSION['checkoutdate'];
    $totalCost = $_SESSION['totalcost'];
    $hotel = $_SESSION['hotel'];
    $cancelled = 0;
    $completed = 1;

    // Db connect
    $conn = new DatabaseConnector();
    $conn = $conn->getConnection();
    $bookingno = uniqid();
    $hotelid = $hotel['id'];
    $customerid = $user['id'];
    $checkindate = $checkindate->format('Y-m-d');
    $checkoutdate = $checkoutdate->format('Y-m-d');

    // Insert into booking table query 
    $sql = "INSERT INTO booking (bookingno, customerid, hotelid, checkindate, checkoutdate, totalcost, cancelled, completed)
        VALUES ('$bookingno', '$customerid', '$hotelid', '$checkindate', 
        '$checkoutdate', '$totalCost', '$cancelled', '$completed')";
    $result = $conn->query($sql);

    // Storing the booking into session storage
    $_SESSION['booking']['bookingno'] = $bookingno;
    
    return $result;
}

// Invoking completeBooking() function
if (isset($_POST['complete_booking'])) {
    completeBooking();
    header("location: ../pages/bookingsuccessful.php");

    // ****** ADD BOOKING FAILED CONDITION THAT UNSETS SESSION ANT TAKES BACK TO HOTELS PAGE
}

// Invoking clearBookingSessionData() function
if (isset($_POST['cancel_booking'])) {
    require_once '../classes/bookingclass.php'; 
    $clearBookingSessionData = Booking::clearBookingSessionData();
    header("location: hotel.php");

};

function createDownloadableTextFile()
{
    // Defining variables
    $bookingno = $_SESSION['booking']['bookingno'];
    $user = $_SESSION['user'];
    $checkindate = $_SESSION['checkindate'];
    $checkoutdate = $_SESSION['checkoutdate'];
    $totalCost = $_SESSION['totalcost'];
    // Retrieve hotel data from session variable
    $hotel = $_SESSION['hotel'];

    $checkin = $checkindate;
    $checkout = $checkoutdate;
    $interval = $checkin->diff($checkout);
    $nights = $interval->format('%a');

    // Creating downloadable text file
    $fileName = "Invoice_" . $bookingno . ".txt";
    $fileContent = "Booking Information:" . "\n";
    $fileContent .= "Customer Name: " . $user['fullname'] . "\n";
    $fileContent .= "Invoice: " . $bookingno . "\n";
    $fileContent .= "Hotel Name: " . $hotel['name'] . "\n";
    $fileContent .= "Check-in Date: " . $checkindate->format('Y-m-d') . "\n";
    $fileContent .= "Check-out Date: " . $checkoutdate->format('Y-m-d') . "\n";
    $fileContent .= "Number of nights: " . $nights . "\n";
    $fileContent .= "Total Cost: " . $totalCost . "\n";

    header('Content-Type: text/plain');
    header('Content-Disposition: attachment; filename="' . $fileName . '"');
    echo $fileContent;
    exit;
}
if (isset($_GET['download'])) {
    createDownloadableTextFile();
    exit;
}
?>