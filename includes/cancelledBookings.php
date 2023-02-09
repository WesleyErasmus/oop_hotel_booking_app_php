<?php

// Fetch all the cancelled bookings from the database
$sql = "SELECT * FROM booking WHERE cancelled = 1 AND customerid = $user_id";
$result = $conn->query($sql);

?>
<table class='table table-bordered bg-light table-striped table-hover'>
    <thead>
        <tr>
            <th>Booking No.</th>
            <th>Hotel Name</th>
            <th>Check-in Date</th>
            <th>Check-out Date</th>
            <th>Total Cost</th>
            <th>Booking Status</th>
        </tr>
    </thead>
    <tbody>
        <?php

        // Fetch all the cancelled bookings from the database
        $sql = "SELECT * FROM booking WHERE cancelled = 1 AND customerid = $user_id";
        $result = $conn->query($sql);

        while ($row = $result->fetch_assoc()) {

            $booking_no = $row['bookingno'];
            $hotel_id = $row['hotelid'];
            $check_in_date = $row['checkindate'];
            $check_out_date = $row['checkoutdate'];
            $total_cost = $row['totalcost'];
        ?>

            </td>
            <td><?php echo $booking_no; ?></td>
            <td><?php
                $user_id = $_SESSION['user']['id'];
                $sql_hotel = "SELECT name FROM hotel WHERE id = $hotel_id";
                $result_hotel = $conn->query($sql_hotel);
                $row_hotel = $result_hotel->fetch_assoc();
                echo $row_hotel['name'];
                ?></td>
            <td><?php echo $check_in_date; ?></td>
            <td><?php echo $check_out_date; ?></td>
            <td>R<?php echo $total_cost; ?></td>
            <td>Booking Cancelled</td>
    </tbody>
<?php
            // Closing while loop
        }
?>
</table>