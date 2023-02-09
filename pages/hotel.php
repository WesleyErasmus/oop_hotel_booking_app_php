<style>
    <?php include '../css/hotel.css'; ?>
</style>
<?php
session_start();

require_once "../data/DatabaseConnector.php";
$conn = new DatabaseConnector();
$conn = $conn->getConnection();

$sql = 'SELECT * FROM hotel';
$result = mysqli_query($conn, $sql);
$hotel = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Include app header
include '../includes/header.php';
?>


<div class="display-2 pt-4 pb-0 text-end bg-light">
    <div class="container">
        <span class="display-6 text-muted border-top">Welcome to,</span>
        <span class="gradient-text">StayInn.com.</span>
    </div>
</div>

<div class="album py-5 bg-light">
    <div class="container">

        <!-- Hotel Page Components -->
        <?php include '../components/hotelLayout.php'; ?>
        <!--  -->

        <?php include '../includes/footer.php' ?>