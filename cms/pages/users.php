<?php
session_start();
// Db Connect
require_once '../../data/DatabaseConnector.php';
$conn = new DatabaseConnector();
$conn = $conn->getConnection();

$sql = "SELECT * FROM user";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>
<?php include '../includes/sidebar.php'; ?>

<div class="container">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>id</th>
                <th>Full name</th>
                <th>username</th>
                <th>address</th>
                <th>password</th>
                <th>email</th>
            </tr>
        </thead>
        <?php
        foreach ($user as $data) : ?>
            <tbody>
                <tr>
                    <th><?php echo $data['id']; ?></th>
                    <td><?php echo $data['fullname']; ?></td>
                    <td><?php echo $data['username']; ?></td>
                    <td><?php echo $data['address']; ?></td>
                    <td><?php echo $data['password']; ?></td>
                    <td><?php echo $data['email']; ?></td>
                </tr>
            </tbody>
        <?php endforeach; ?>
    </table>
</div>