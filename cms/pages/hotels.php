<style>
    <?php include '../css/main.css'; ?>
</style>
<?php
session_start();
// Restrict assess to users not signed in by redirecting them to login page
include '../../includes/restrict_access.php';

// Logs user out after 1hr of inactivity
include '../../includes/session_tracking.php';

// Db Connect
require_once '../../data/DatabaseConnector.php';
$conn = new DatabaseConnector();
$conn = $conn->getConnection();

// Include search function
include '../components/search.php';

// Select all hotel data query
$sql = "SELECT * FROM hotel";
$result = mysqli_query($conn, $sql);
$hotel = mysqli_fetch_all($result, MYSQLI_ASSOC);
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
                <i class="bi-gear" style="font-size: 2rem; color: darkslategrey;"></i>
                Manage Hotels
            </h2>
            <div class="d-flex">

                <!-- Check if clear button or search button in the search form is set -->
                <?php
                if (isset($_GET['clear'])) {
                    // Redirect user back to the same page (refreshes current page)
                    echo "<meta http-equiv='refresh' content='0;url=../pages/hotels.php'>";
                    exit;
                }
                $search = "";
                // Calling the search_hotels function
                if (isset($_GET['search'])) {
                    $hotel = search_hotels();
                }
                ?>
                <!-- Search form -->
                <form action="" class="d-flex gap-2">
                    <input type="text" name="search" class="form-control" placeholder="Search Hotels" value="<?php echo $search; ?>">

                    <!-- Search btn -->
                    <button type="submit" class="btn btn-secondary">Search</button>

                    <!-- Clear btn -->
                    <button type="submit" class="btn btn-outline-secondary" name="clear" value="clear">Clear</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="position-relative">
        <!-- Add hotel modal -->
        <?php include '../includes/add_hotel.php' ?>

    </div>

    <!-- Include sort component -->
    <?php include '../components/sort.php'; ?>

    <!-- Sort Form: 1) The form action adds the variable name plus =desc or =asc in the page URL. 2) Using a turnery statement change the caret icon depending on if $sort_variable is asc or desc. -->
    <form class="ps-0 pt-2" action="?hotel_sort=<?php echo $sort_hotel; ?>" method="post">

        <input name="hotel_sort" id="sort_button" class="btn btn-link text-secondary text-decoration-none" type="submit" value="Sort By Hotel">

        <?php echo $sort_hotel == 'asc' ? '<i class="bi-caret-down-fill"></i>' : '<i class="bi-caret-up-fill"></i>'; ?>
    </form>

    <!-- Hotels table -->
    <div class="table-container mt-2">
        <table class="table table-bordered table-hover">
            <thead class="gradient-bg sticky-top py-1">
                <tr>
                    <th>Hotel Id</th>
                    <th>Name</th>
                    <th>Price Per Night</th>
                    <th>features</th>
                    <th>Type</th>
                    <th>Beds</th>
                    <th>Rating</th>
                    <th>Location</th>
                    <th>Thumbnail</th>
                </tr>
            </thead>
            <?php
            foreach ($hotel as $data) : ?>
                <tbody>
                    <tr>
                        <th><?php echo $data['id']; ?></th>
                        <td><?php echo $data['name']; ?></td>
                        <td><?php echo $data['pricepernight']; ?></td>
                        <td><?php echo $data['features']; ?></td>
                        <td><?php echo $data['type']; ?></td>
                        <td><?php echo $data['beds']; ?></td>
                        <td><?php echo $data['rating']; ?></td>
                        <td><?php echo $data['location']; ?></td>
                        <td><a href="<?php echo $data['thumbnail']; ?>" target="_blank">View Thumbnail</a></td>
                    </tr>
                </tbody>
            <?php endforeach; ?>
        </table>
    </div>
</div>