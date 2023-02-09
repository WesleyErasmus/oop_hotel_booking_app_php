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

<?php 
// Hotel hero carousel
include "../components/hero.html"; ?>

<div class="album py-5 bg-light">
    <div class="container">

    <!-- Hotel Page Components -->
        
        <?php include '../components/hotelLayout.php'; ?>
    <!--  -->

<!-- Bootstrap Popover script -->
<script>
    const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
    const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))
</script>
<?php include '../includes/footer.php' ?>