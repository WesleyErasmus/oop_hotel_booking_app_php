<?php
session_start();
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
<div style="margin-left: 280px;">
    <!-- Page top navbar -->
    <nav class="navbar bg-light sticky-top shadow-sm">
        <div class="container-fluid">

            <!-- Page heading -->
            <h1 class="p-4">MANAGE HOTELS</h1>
            <div class="d-flex">

                <!-- Check if clear button or search button in the search form is set -->
                <?php
                if (isset($_GET['clear'])) {
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
                <form action="">
                    <input type="text" name="search" placeholder="Search Hotels" value="<?php echo $search; ?>">
                    <button type="submit">Search</button>
                    <button type="submit" name="clear" value="clear">Clear</button>
                </form>
            </div>
        </div>
    </nav>

    <!-- Hotels table -->
    <div class="container-fluid p-3">
        <table class="table table-bordered table-hover">
            <thead>
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