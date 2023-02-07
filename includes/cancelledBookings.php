<?php
// require_once "../data/DatabaseConnector.php";

// $conn = new DatabaseConnector();
// $conn = $conn->getConnection();

// Fetch all the cancelled bookings from the database
$sql = "SELECT * FROM booking WHERE cancelled = 1 AND customerid = $user_id";
$result = $conn->query($sql);

?>
<table class='table table-bordered'>
    <thead>
        <tr>
            <th>Booking ID</th>
            <th>Hotel ID</th>
            <th>Check-in Date</th>
            <th>Check-out Date</th>
            <th>Total Cost</th>
            <th>Booking Status</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // $conn = new DatabaseConnector();
        // $conn = $conn->getConnection();

        // Fetch all the cancelled bookings from the database
        $sql = "SELECT * FROM booking WHERE cancelled = 1 AND customerid = $user_id";
        $result = $conn->query($sql);

        while ($row = $result->fetch_assoc()) {

            $bookingno = $row['bookingno'];
            $hotelid = $row['hotelid'];
            $checkindate = $row['checkindate'];
            $checkoutdate = $row['checkoutdate'];
            $totalcost = $row['totalcost'];
        ?>

            </td>
            <td><?php echo $bookingno; ?></td>
            <td><?php echo $hotelid; ?></td>
            <td><?php echo $checkindate; ?></td>
            <td><?php echo $checkoutdate; ?></td>
            <td>R<?php echo $totalcost; ?></td>
            <td>Booking Cancelled</td>
    </tbody>
<?php
            // Closing while loop
        }
?>
</table>