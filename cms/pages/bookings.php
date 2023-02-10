<?php
session_start();
// Db Connect
require_once '../../data/DatabaseConnector.php';
$conn = new DatabaseConnector();
$conn = $conn->getConnection();

// Include search function
include '../components/search.php';

// Select all booking data query
$sql = "SELECT * FROM booking";
$result = mysqli_query($conn, $sql);
$booking = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!-- Include side navbar -->
<?php include '../includes/sidebar.php'; ?>

<!-- Page container -->
<div style="margin-left: 280px;">
    <!-- Page top navbar -->
    <nav class="navbar bg-light sticky-top shadow-sm">
        <div class="container-fluid">

            <!-- Page heading -->
            <h1 class="p-4">MANAGE BOOKINGS</h1>
            <div class="d-flex">

                <!-- Check if clear button or search button in the search form is set -->
                <?php
                if (isset($_GET['clear'])) {
                    // Redirect user back to the same page (refreshes current page)
                    echo "<meta http-equiv='refresh' content='0;url=../pages/bookings.php'>";
                    exit;
                }
                $search = "";
                // Calling the search_bookings function
                if (isset($_GET['search'])) {
                    $booking = search_bookings();
                }
                ?>
                <!-- Search form -->
                <form action="" class="d-flex gap-2">
                    <input type="text" name="search" class="form-control" placeholder="Search Bookings" value="<?php echo $search; ?>">
                    <button type="submit" class="btn btn-primary">Search</button>
                    <button type="submit" class="btn btn-outline-primary" name="clear" value="clear">Clear</button>
                </form>
            </div>
    </nav>

    <!-- Bookings table -->
    <div class="container-fluid p-3">

        <!-- Include sort component -->
        <?php include '../components/sort.php'; ?>

        <!-- Sort Form: 1) The form action adds the variable name plus =desc or =asc in the page URL. 2) Using a turnery statement change the caret icon depending on if $sort_variable is asc or desc. -->
        <form action="?booking_sort=<?php echo $sort_booking; ?>" method="post">
            <input name="booking_sort" id="sort_button" class="btn btn-link text-decoration-none" type="submit" value="Sort By ID">
            <?php echo $sort_booking == 'asc' ? '<i class="bi-caret-down-fill"></i>' : '<i class="bi-caret-up-fill"></i>'; ?>
        </form>

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