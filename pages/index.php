<?php
session_start();
require_once "../data/DatabaseConnector.php";

include '../includes/header.php';

// Fetch all data from users table
$sql = 'SELECT * FROM user';
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>

<div class="container">
    <h1>StayInn Users</h1>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>id</th>
                <th>username</th>
                <th>fullname</th>
                <th>address</th>
                <th>password</th>
                <th>email</th>
            </tr>
        </thead>
        <?php foreach ($user as $info) : ?>
            <tbody>
                <tr>
                    <th><?php echo $info['id']; ?></th>
                    <td><?php echo $info['username']; ?></td>
                    <td><?php echo $info['fullname']; ?></td>
                    <td><?php echo $info['address']; ?></td>
                    <td><?php echo $info['password']; ?></td>
                    <td><?php echo $info['email']; ?></td>
                </tr>
            </tbody>
        <?php endforeach; ?>
    </table>
</div>


<?php include '../includes/footer.php' ?>