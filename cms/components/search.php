<?php
// Search users function by full name
// ----------------------------------
function search_users()
{
    // Db connect
    $conn = new DatabaseConnector();
    $conn = $conn->getConnection();

    // Retrieving searchbar input and setting it to the $search variable
    if (isset($_GET['search'])) {
        $search = mysqli_real_escape_string($conn, $_GET['search']);
    }
    // Select query from user table for user full name
    $sql = "SELECT * FROM user WHERE fullname LIKE '%$search%'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // Returning search results
    return $user;
}


// Search bookings by customer id
// -------------------------------
function search_bookings()
{
    // Db connect
    $conn = new DatabaseConnector();
    $conn = $conn->getConnection();

    // Retrieving searchbar input and setting it to the $search variable
    if (isset($_GET['search'])) {
        $search = mysqli_real_escape_string($conn, $_GET['search']);
    }
    // Select query from booking table for customer id and booking number
    $sql = "SELECT * FROM booking WHERE customerid LIKE '%$search%' OR bookingno LIKE '%$search%'";

    $result = mysqli_query($conn, $sql);
    $booking = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // Returning search results
    return $booking;
}


// Search hotels by hotel name or hotel id
// ---------------------------------------
function search_hotels()
{
    // Db connect
    $conn = new DatabaseConnector();
    $conn = $conn->getConnection();

    // Retrieving searchbar input and setting it to the $search variable
    if (isset($_GET['search'])) {
        $search = mysqli_real_escape_string($conn, $_GET['search']);
    }
    // Select query from hotel table for hotel name or hotel id
    $sql = "SELECT * FROM hotel WHERE name LIKE '%$search%' OR id LIKE '%$search%'";

    $result = mysqli_query($conn, $sql);
    $hotel = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // Returning search results
    return $hotel;
}
?>