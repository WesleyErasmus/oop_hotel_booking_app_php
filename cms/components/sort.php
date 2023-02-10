<?php
// Sort users function by full name
// ----------------------------------
function sort_users($sort_user)
{
    // Db connect
    $conn = new DatabaseConnector();
    $conn = $conn->getConnection();

    // Select query users in order of fullname ( the value of the $sort variable changes from asc to desc every time the sort button is clicked)
    $sql = "SELECT * FROM user ORDER BY fullname $sort_user";

    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_all($result, MYSQLI_ASSOC);
    // Returns either asc or desc list of users based on fullname
    return $user;
}

// Toggle between sorting in ascending and descending order
if (isset($_GET['user_sort'])) {
    if ($_GET['user_sort'] == 'asc') {
        $sort_user = 'desc';
    } else {
        $sort_user = 'asc';
    }
} else {
    $sort_user = 'asc';
}
// Checks for sort button submit and actions sort_users function whenever sort is clicked
if (isset($_GET['user_sort'])) {
    $user = sort_users($_GET['user_sort']);
}


// Sort bookings function by hotelid
// ----------------------------------
function sort_bookings($sort_booking)
{
    // Db connect
    $conn = new DatabaseConnector();
    $conn = $conn->getConnection();

    // Select query bookings in order of hotelid ( the value of the $sort variable changes from asc to desc every time the sort button is clicked)
    $sql = "SELECT * FROM booking ORDER BY hotelid $sort_booking";

    $result = mysqli_query($conn, $sql);
    $booking = mysqli_fetch_all($result, MYSQLI_ASSOC);
    // Returns either asc or desc list of users based on hotelid
    return $booking;
}

// Toggle between sorting in ascending and descending order
if (isset($_GET['booking_sort'])) {
    if ($_GET['booking_sort'] == 'asc') {
        $sort_booking = 'desc';
    } else {
        $sort_booking = 'asc';
    }
} else {
    $sort_booking = 'asc';
}
// Checks for sort button submit and actions sort_bookings function whenever sort is clicked
if (isset($_GET['booking_sort'])) {
    $booking = sort_bookings($_GET['booking_sort']);
}


// Sort hotels function by name
// ----------------------------------
function sort_hotels($sort_hotel)
{
    // Db connect
    $conn = new DatabaseConnector();
    $conn = $conn->getConnection();

    // Select query hotels in order of hotel name ( the value of the $sort variable changes from asc to desc every time the sort button is clicked)
    $sql = "SELECT * FROM hotel ORDER BY name $sort_hotel";

    $result = mysqli_query($conn, $sql);
    $hotel = mysqli_fetch_all($result, MYSQLI_ASSOC);
    // Returns either asc or desc list of users based on hotel name
    return $hotel;
}

// Toggle between sorting in ascending and descending order
if (isset($_GET['hotel_sort'])) {
    if ($_GET['hotel_sort'] == 'asc') {
        $sort_hotel = 'desc';
    } else {
        $sort_hotel = 'asc';
    }
} else {
    $sort_hotel = 'asc';
}
// Checks for sort button submit and actions sort_hotels function whenever sort is clicked
if (isset($_GET['hotel_sort'])) {
    $hotel = sort_hotels($_GET['hotel_sort']);
}
