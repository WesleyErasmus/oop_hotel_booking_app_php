<?php
session_start();
require_once "../data/DatabaseConnector.php";
$conn = new DatabaseConnector();
$conn = $conn->getConnection();

// Include header
include '../includes/header.php';

// Conditional to invoke cancelBooking()
if (isset($_POST['cancel_booking'])) {
    cancelBooking($_POST['booking_no']);
    echo "<meta http-equiv='refresh' content='0;url=../pages/managebooking.php'>";
    exit;
}

// Updates cancelled boolean set to true if user cancels booking
function cancelBooking($booking_no)
{
    $conn = new DatabaseConnector();
    $conn = $conn->getConnection();

    $cancelled = 1;
    $sql = "UPDATE booking SET cancelled = $cancelled WHERE bookingno = '$booking_no'";
    $conn->query($sql);
}
?>

<div class="container">
    <h3 class="pb-4 mb-4 mt-4 fst-italic border-bottom">Your Bookings</h3>
    <!-- Bookings table -->
    <table class='table table-bordered bg-light table-striped table-hover'>

        <!-- Table headings -->
        <thead>
            <tr>
                <th>Booking No.</th>
                <th>Hotel Name</th>
                <th>Check-in Date</th>
                <th>Check-out Date</th>
                <th>Total Cost</th>
                <th>Cancel</th>
            </tr>
        </thead>

        <?php
        // User session storage
        $user_id = $_SESSION['user']['id'];

        // Fetch all the completed bookings from the database
        $sql = "SELECT * FROM booking WHERE customerid = $user_id AND cancelled = 0 AND completed = 1";
        $result = $conn->query($sql);

        // Getting all completed bookings associated with the customerid
        while ($row = $result->fetch_assoc()) {
            $booking_no = $row['bookingno'];
            $hotel_id = $row['hotelid'];
            $check_in_date = $row['checkindate'];
            $check_out_date = $row['checkoutdate'];
            $total_cost = $row['totalcost'];
        ?>
            <!-- Table body -->
            <tbody>
                <tr>

                    <!-- Booking number -->
                    <td><?php echo $booking_no; ?></td>
                    <td>
                        <!-- Retrieving hotel names -->
                        <?php
                        $sql_hotel = "SELECT name FROM hotel WHERE id = $hotel_id";
                        $result_hotel = $conn->query($sql_hotel);
                        $row_hotel = $result_hotel->fetch_assoc();
                        echo $row_hotel['name'];
                        ?>

                    </td>
                    <!-- Check-in date -->
                    <td><?php echo $check_in_date; ?></td>

                    <!-- Check-out date -->
                    <td><?php echo $check_out_date; ?></td>

                    <!-- Total cost -->
                    <td>R<?php echo $total_cost; ?></td>
                    <td>

                    <!-- Form with hidden input with the value of the booking no used to delete a booking based on it's id -->
                        <form action="" method="post">
                            <input type="hidden" name="booking_no" value="<?php echo $booking_no; ?>">
                            <input class="btn btn-danger" type="submit" name="cancel_booking" value="Cancel Booking">
                        </form>

                    </td>
                </tr>
            <?php
            // Closing while loop
        }
            ?>
            </tbody>
    </table>

    <!-- Cancelled bookings container -->
    <div>
        <h3 class="pb-4 mb-4 mt-4 fst-italic border-bottom">Cancelled Bookings</h3>
        
        <!-- Cancelled bookings include -->
        <?php include '../components/cancelledBookings.php'; ?>

    </div>

</div>