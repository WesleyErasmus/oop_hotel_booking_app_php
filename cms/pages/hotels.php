<?php
session_start();
// Db Connect
require_once '../../data/DatabaseConnector.php';
$conn = new DatabaseConnector();
$conn = $conn->getConnection();

$sql = "SELECT * FROM hotel";
$result = mysqli_query($conn, $sql);
$hotel = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<?php include '../includes/sidebar.php'; ?>
<div style="margin-left: 280px;">
    <h1 class="p-4 sticky-top bg-light shadow-sm">MANAGE HOTELS</h1>
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