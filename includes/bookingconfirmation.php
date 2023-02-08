<?php
$checkindate = $_SESSION['checkindate'];
$checkoutdate = $_SESSION['checkoutdate'];
$totalCost = $_SESSION['totalcost'];
// Retrieve hotel data from session variable
$hotel = $_SESSION['hotel'];

function completeBooking()
{
    $user = $_SESSION['user'];
    $checkindate = $_SESSION['checkindate'];
    $checkoutdate = $_SESSION['checkoutdate'];
    $totalCost = $_SESSION['totalcost'];
    // Retrieve hotel data from session variable
    $hotel = $_SESSION['hotel'];
    $cancelled = 0;
    $completed = 1;

    $conn = new DatabaseConnector();
    $conn = $conn->getConnection();
    $bookingno = uniqid();
    $hotelid = $hotel['id'];
    $customerid = $user['id'];
    $checkindate = $checkindate->format('Y-m-d');
    $checkoutdate = $checkoutdate->format('Y-m-d');

    $sql = "INSERT INTO booking (bookingno, customerid, hotelid, checkindate, checkoutdate, totalcost, cancelled, completed)
        VALUES ('$bookingno', '$customerid', '$hotelid', '$checkindate', 
        '$checkoutdate', '$totalCost', '$cancelled', '$completed')";
    $result = $conn->query($sql);

    $_SESSION['booking']['bookingno'] = $bookingno;
    
    return $result;
}

if (isset($_POST['complete_booking'])) {
    completeBooking();

    // Takes you to successful booking page 
    header("location: ../pages/bookingsuccessful.php");

    // ****** ADD BOOKING FAILED CONDITION THAT UNSETS SESSION ANT TAKES BACK TO HOTELS PAGE
}

if (isset($_POST['cancel_booking'])) {
    require_once "../data/DatabaseConnector.php";
    $conn = new DatabaseConnector();
    $conn = $conn->getConnection();

    require_once '../classes/bookingclass.php';
    // Calling clearbookingsessiondata method
    $booking = new Booking($bookingno, $customerid, $hotelid, $checkindate, $checkoutdate, $totalcost, $cancelled, $completed);
    $booking->clearBookingSessionData();

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