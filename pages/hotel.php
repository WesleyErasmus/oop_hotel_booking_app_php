<style>
    <?php include '../css/hotel.css'; ?>
</style>
<?php
session_start();

require_once "../data/DatabaseConnector.php";
$conn = new DatabaseConnector();
$conn = $conn->getConnection();

// Include app header
include '../includes/header.php';

// Include hotel class
include '../classes/hotelclass.php';
?>
<?php include "../components/hero.html"; ?>

<div class="album py-5 bg-light">
    <div class="container">

    <!-- Hotel Page Components -->
        <?php 
        // include '../components/featuredHotels.html'; 
        // session_destroy();
        print_r($_SESSION);
        ?>

        <?php include '../components/hotelLayout.php'; ?>
    <!--  -->

<!-- Bootstrap Popover script -->
<script>
    const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
    const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))
</script>
<?php include '../includes/footer.php' ?>