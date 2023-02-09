<?php
// Session data
$check_in_date = $_SESSION['checkindate'];
$check_out_date = $_SESSION['checkoutdate'];
$total_cost = $_SESSION['totalcost'];
$hotel = $_SESSION['hotel'];


// Complete booking function - stores booking to the 'booking' database table
function completeBooking()
{
    // Setting variables
    $user = $_SESSION['user'];
    $check_in_date = $_SESSION['checkindate'];
    $check_out_date = $_SESSION['checkoutdate'];
    $total_cost = $_SESSION['totalcost'];
    $hotel = $_SESSION['hotel'];
    $cancelled = 0;
    $completed = 1;

    // Db connect
    $conn = new DatabaseConnector();
    $conn = $conn->getConnection();
    $booking_no = uniqid();
    $hotel_id = $hotel['id'];
    $customer_id = $user['id'];
    $check_in_date = $check_in_date->format('Y-m-d');
    $check_out_date = $check_out_date->format('Y-m-d');

    // Insert into booking table query 
    $sql = "INSERT INTO booking (bookingno, customerid, hotelid, checkindate, checkoutdate, totalcost, cancelled, completed)
        VALUES ('$booking_no', '$customer_id', '$hotel_id', '$check_in_date', 
        '$check_out_date', '$total_cost', '$cancelled', '$completed')";
    $result = $conn->query($sql);

    // Storing the booking into session storage
    $_SESSION['booking']['bookingno'] = $booking_no;
    
    return $result;
}

// ************************************************************
// BELOW FUNCTIONS ARE LINKED TO BUTTONS NEXT TO EACH OTHER ON confirmBookingPage.php

// Invoking completeBooking() function
if (isset($_POST['complete_booking'])) {
    completeBooking();
    header("location: ../pages/bookingsuccessful.php");
}

// Invoking clearBookingSessionData() function
if (isset($_POST['cancel_booking'])) {
    require_once '../classes/bookingclass.php'; 
    $clear_booking_session_data = Booking::clearBookingSessionData();
    header("location: hotel.php");

};

// ************************************************************

// Function that creates a customer invoice
function createDownloadableTextFile()
{
    // Defining variables
    $booking_no = $_SESSION['booking']['bookingno'];
    $user = $_SESSION['user'];
    $check_in_date = $_SESSION['checkindate'];
    $check_out_date = $_SESSION['checkoutdate'];
    $total_cost = $_SESSION['totalcost'];
    // Retrieve hotel data from session variable
    $hotel = $_SESSION['hotel'];

    $check_in = $check_in_date;
    $check_out = $check_out_date;
    $interval = $check_in->diff($check_out);
    $nights = $interval->format('%a');

    // Creating downloadable text file
    $fileName = "Invoice_" . $booking_no . ".txt";
    $fileContent = "Booking Information:" . "\n";
    $fileContent .= "Customer Name: " . $user['fullname'] . "\n";
    $fileContent .= "Invoice: " . $booking_no . "\n";
    $fileContent .= "Hotel Name: " . $hotel['name'] . "\n";
    $fileContent .= "Check-in Date: " . $check_in_date->format('Y-m-d') . "\n";
    $fileContent .= "Check-out Date: " . $check_out_date->format('Y-m-d') . "\n";
    $fileContent .= "Number of nights: " . $nights . "\n";
    $fileContent .= "Total Cost: " . $total_cost . "\n";

    header('Content-Type: text/plain');
    header('Content-Disposition: attachment; filename="' . $fileName . '"');
    echo $fileContent;
    exit;
}

// Isset returns true once the download invoice button is clicked and the 'download' parameter is present
if (isset($_GET['download'])) {
    createDownloadableTextFile();
    exit;
}
?>