<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS CDN link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
    <!-- Bootstrap icons CDN link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

    <!-- Local CSS links -->
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/header.css">
</head>

<body>
    <nav class="navbar sticky-top navbar-expand-lg bg-white shadow-sm" data-bs-theme="light">

        <!-- Navbar content -->
        <div class="container">

            <!-- Logo home button -->
            <a class="navbar-brand" href="../pages/hotel.php">StayInn.com.</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">

                        <!-- Hotel page link -->
                        <a class="nav-link text-center active" aria-current="page" href="../pages/hotel.php">
                            Hotels
                        </a>
                    </li>

                    <!-- Booking page link -->
                    <li class="nav-item">
                        <a class="nav-link text-center" href="../pages/bookings.php">
                            Bookings
                        </a>
                    </li>

                    <!-- Profile page link -->
                    <li class="nav-item">
                        <a class="nav-link text-center" href="../pages/profile.php">
                            Profile
                        </a>
                    </li>
                </ul>
                <!-- End of nav links -->


                <button class="btn btn-outline-warning me-2">
                    <a class="nav-link text-center" href="../cms/pages/login.php">
                        <i class="bi-gear"></i>
                        Admin CMS
                    </a>
                </button>
                <?php
                // User class include
                require_once '../classes/User.php';

                // Login / Logout button conditional
                if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {

                    // If user clicks logout then this will trigger the logout function in the below if statement
                    $user = $_SESSION['user'];
                    if (
                        isset($_GET['logout']) && $_GET['logout'] == true
                    ) {
                        User::logout();
                    }
                    // Logout button
                    echo '<button class="btn btn-secondary"><a href="../pages/login.php?logout=true" style="color: #fff; text-decoration: none;">Logout</a></button>';

                    // Signup button - display:none;
                    echo '<button class="btn btn-primary" style="display: none;" type="submit"><a href="../pages/sign_up.php" style="color: #fff; text-decoration: none;">Sign-up</a></button>';
                } else {
                    // Login button
                    echo '<button class="btn btn-success me-3"><a href="login.php" style="color: #fff; text-decoration: none;">Login</a></button>';

                    // Signup button - display:block;
                    echo '<button class="btn btn-primary" style="display: block;" type="submit"><a href="../pages/sign_up.php" style="color: #fff; text-decoration: none;">Sign-up</a></button>';
                }
                ?>
            </div>
        </div>
    </nav>

    <!-- App pages container -->
    <div class="container-fluid">

        <!-- Includes Bootstrap JS scr scripts -->
        <?php include '../includes/footer.php'; ?>