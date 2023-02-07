<?php
session_start();
require_once "../data/DatabaseConnector.php";
$conn = new DatabaseConnector();
$conn = $conn->getConnection();

// Include header
include '../includes/header.php';

// Conditional to run cancelBooking()
if (isset($_POST['cancel_booking'])) {
    cancelBooking($_POST['booking_no']);
    header("Location: managebooking.php");
    exit;
}

// Updates cancelled boolean to true if user cancels booking
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
    <!-- Bookings table -->
    <table class='table table-bordered'>
        <tr>
            <th>Booking No.</th>
            <th>Hotel Name</th>
            <th>Check-in Date</th>
            <th>Check-out Date</th>
            <th>Total Cost</th>
            <th>Action</th>
        </tr>

        <?php
        $user_id = $_SESSION['user']['id'];
        // $conn = new DatabaseConnector();
        // $conn = $conn->getConnection();

        $sql = "SELECT * FROM booking WHERE customerid = $user_id AND cancelled = 0 AND completed = 1";
        $result = $conn->query($sql);

        while ($row = $result->fetch_assoc()) {
            $booking_no = $row['bookingno'];
            $hotel_id = $row['hotelid'];
            $check_in_date = $row['checkindate'];
            $check_out_date = $row['checkoutdate'];
            $total_cost = $row['totalcost'];
        ?>
            <tr>
                <td><?php echo $booking_no; ?></td>
                <td>

                    <?php
                    $sql_hotel = "SELECT name FROM hotel WHERE id = $hotel_id";
                    $result_hotel = $conn->query($sql_hotel);
                    $row_hotel = $result_hotel->fetch_assoc();
                    echo $row_hotel['name'];
                    ?>

                </td>
                <td><?php echo $check_in_date; ?></td>
                <td><?php echo $check_out_date; ?></td>
                <td>R<?php echo $total_cost; ?></td>
                <td>

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
    </table>

    <?php include '../includes/cancelledBookings.php'; ?>
</div>