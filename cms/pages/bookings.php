<?php
session_start();
// Db Connect
require_once '../../data/DatabaseConnector.php';
$conn = new DatabaseConnector();
$conn = $conn->getConnection();

$sql = "SELECT * FROM booking";
$result = mysqli_query($conn, $sql);
$booking = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<?php include '../includes/sidebar.php'; ?>
<div style="margin-left: 280px;">
    <h1 class="p-4 sticky-top bg-light shadow-sm">MANAGE BOOKINGS</h1>
    <div class="container-fluid p-3">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Booking No.</th>
                    <th>Customer Id</th>
                    <th>Hotel Id</th>
                    <th>Check-In Data</th>
                    <th>Check-Out Date</th>
                    <th>Total Cost</th>
                    <th>Cancelled</th>
                </tr>
            </thead>
            <?php
            foreach ($booking as $data) : ?>
                <tbody>
                    <tr>
                        <th><?php echo $data['bookingno']; ?></th>
                        <td><?php echo $data['customerid']; ?></td>
                        <td><?php echo $data['hotelid']; ?></td>
                        <td><?php echo $data['checkindate']; ?></td>
                        <td><?php echo $data['checkoutdate']; ?></td>
                        <td><?php echo $data['totalcost']; ?></td>
                        <td><?php
                            if ($data['cancelled'] == TRUE) {
                                echo '<span style="color: red;">Cancelled</span>';
                            } else {
                                echo '<span style="color: green;">Completed</span>';
                            }
                            ?></td>

                    </tr>
                </tbody>
            <?php endforeach; ?>
        </table>
    </div>
    </div>