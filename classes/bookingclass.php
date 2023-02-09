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
    public $booking_no;
    public $customer_id;
    public $hotel_id;
    public $check_in_date;
    public $check_out_date;
    public $total_cost;
    public $cancelled;
    public $completed;

    // Constructor function
    public function __construct($booking_no, $customer_id, $hotel_id, $check_in_date, $check_out_date, $total_cost, $cancelled, $completed)
    {
        $this->booking_no = $booking_no;
        $this->customer_id = $customer_id;
        $this->hotel_id = $hotel_id;
        $this->check_in_date = $check_in_date;
        $this->check_out_date = $check_out_date;
        $this->total_cost = $total_cost;
        $this->cancelled = $cancelled;
        $this->completed = $completed;
    }
    
    public static function clearBookingSessionData()
    {
        $hotel = $_SESSION['hotel'];
        $booking_no = $_SESSION['booking']['bookingno'];
        unset($booking_no);
        unset($hotel);
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
