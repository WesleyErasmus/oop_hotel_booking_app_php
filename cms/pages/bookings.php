<style>
    <?php include '../css/main.css'; ?>
</style>
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
<div class="ps-2" style="margin-left: 280px;">
    <!-- Page top navbar -->
    <nav class="navbar sticky-top">
        <div class="container-fluid">

            <!-- Page heading -->
            <h2 class="text-muted border-bottom pb-2">
                <i class="bi-calendar-plus" style="font-size: 2rem; color: darkslategrey;"></i>
                Manage Bookings
            </h2>
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

                    <!-- Search btn -->
                    <button type="submit" class="btn btn-secondary">Search</button>

                    <!-- Clear btn -->
                    <button type="submit" class="btn btn-outline-secondary" name="clear" value="clear">Clear</button>
                </form>
            </div>
    </nav>


    <!-- Include sort component -->
    <?php include '../components/sort.php'; ?>


    <!-- Sort Form: 1) The form action adds the variable name plus =desc or =asc in the page URL. 2) Using a turnery statement change the caret icon depending on if $sort_variable is asc or desc. -->
    <form class="ps-0 mt-5 pt-2" action="?booking_sort=<?php echo $sort_booking; ?>" method="post">

        <input name="booking_sort" id="sort_button" class="btn btn-link text-secondary text-decoration-none" type="submit" value="Sort By Hotel ID">

        <?php echo $sort_booking == 'asc' ? '<i class="bi-caret-down-fill"></i>' : '<i class="bi-caret-up-fill"></i>'; ?>

    </form>

    <!-- Bookings table -->
    <div class="table-container mt-2">
        <table class="table table-bordered table-hover">
            <thead class="gradient-bg sticky-top py-1">
                <tr>
                    <th>Booking No.</th>
                    <th>Customer Id</th>
                    <th>Hotel Id</th>
                    <th>Check-In Data</th>
                    <th>Check-Out Date</th>
                    <th>Total Cost</th>
                    <th>Status</th>
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