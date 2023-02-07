<?php
// Sql select add data from booking database table
require_once "../data/DatabaseConnector.php";
$conn = new DatabaseConnector();
$conn = $conn->getConnection();

$sql = 'SELECT * FROM booking';
$result = mysqli_query($conn, $sql);
$booking = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Booking class
class Booking
{
    public $bookingno;
    public $customerid;
    public $hotelid;
    public $checkindate;
    public $checkoutdate;
    public $totalcost;
    public $cancelled;
    public $completed;

    // Constructor function
    public function __construct($bookingno, $customerid, $hotelid, $checkindate, $checkoutdate, $totalcost, $cancelled, $completed)
    {
        $this->bookingno = $bookingno;
        $this->customerid = $customerid;
        $this->hotelid = $hotelid;
        $this->checkindate = $checkindate;
        $this->checkoutdate = $checkoutdate;
        $this->totalcost = $totalcost;
        $this->cancelled = $cancelled;
        $this->completed = $completed;
    }
    
    public function clearBookingSessionData()
    {
        unset($_SESSION['checkindate']);
        unset($_SESSION['checkoutdate']);
        unset($_SESSION['totalcost']);
        unset($_SESSION['hotel']);
    }

    // Retrieve selected hotel by id
    public static function retrieveByHotelId($id)
    {
        // Connect to the database
        $conn = new mysqli('localhost', 'root', '', 'stayinn');
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        // Retrieve the hotel data from the database
        $sql = "SELECT * FROM hotel WHERE id = $id";
        $result = $conn->query($sql);
        // Check if a hotel was found
        if ($result->num_rows > 0) {
            $hotel = $result->fetch_assoc();
        } else {
            $hotel = null;
        }
        // Close the database connection
        $conn->close();
        // Return the hotel data
        return $hotel;
    }
}

// Retrieve hotel id
$hotel = Booking::retrieveByHotelId($_GET['id']);
// Store hotel data in session variable
$_SESSION['hotel'] = $hotel;
