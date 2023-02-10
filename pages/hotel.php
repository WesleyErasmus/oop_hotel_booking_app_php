<style>
    <?php include '../css/hotel.css'; ?>
</style>
<?php
session_start();

// Logs user out after 1hr of inactivity
include '../includes/session_tracking.php';

// Db connector
require_once "../data/DatabaseConnector.php";
$conn = new DatabaseConnector();
$conn = $conn->getConnection();

// Hotel table qsl query
$sql = 'SELECT * FROM hotel';
$result = mysqli_query($conn, $sql);
$hotel = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Include app header
include '../includes/header.php';
?>

<!-- Page jumbotron -->
<div class="display-2 pt-4 pb-0 text-end bg-light">
    <div class="container">
        <span class="display-6 text-muted border-top">Welcome to,</span>
        <span class="gradient-text">StayInn.com.</span>
    </div>
</div>

<!-- Hotel page containers -->
<div class="album py-5 bg-light">
    <div class="container">
        <div class="row g-5" style="flex-direction: row-reverse;">
            <div class="col-md-8">
                <h3 class="pb-4 mb-4 fst-italic border-bottom">Hotels</h3>

                <!-- Hotel Page Component to display hotel cards -->
                <?php include '../components/hotel_card.php'; ?>

            </div>

            <!-- Placeholder content -->
            <div class="col-md-4">
                <div class="position-sticky" style="top: 2rem">
                    <div class="p-4 mb-3 bg-light rounded">
                        <h4 class="fst-italic">About <span class="gradient-text">StayInn.com.</span></h4>
                        <p class="mb-0">
                            StayInn.com is an hotel online booking platform. We aim to help you find the right hotel fo the right price, at your easiest convenience.
                        </p>
                    </div>

                    <div class="p-4">
                        <h4 class="fst-italic">Booking Tips</h4>
                        <ol class="list-unstyled mb-0">
                            <li><a href="#">Booking Smart</a></li>
                            <li><a href="#">Choosing the right hotel</a></li>
                            <li><a href="#">Avoid bad bookings</a></li>
                            <li><a href="#">What to lookout for</a></li>
                            <li><a href="#">Trending hotels in 2023</a></li>
                            <li><a href="#">Iconic hotels</a></li>
                            <li><a href="#">Celeb favorites</a></li>
                            <li><a href="#">How to save when you book</a></li>
                            <li><a href="#">Best hotel features</a></li>
                            <li><a href="#">How to review a hotel</a></li>
                            <li><a href="#">Hotel packages</a></li>
                        </ol>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- Footer include -->
<?php include '../includes/footer.php' ?>