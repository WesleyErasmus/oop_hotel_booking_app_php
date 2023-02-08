<style>
    /* Login page CSS */
    <?php include '../css/login.css'; ?>
</style>
<?php
session_start();
// Include Header
include '../includes/header.php'; ?>


<!-- Login page container -->
<div class="container col-xl-10 col-xxl-8 px-4 py-5">
    <div class="row align-items-center g-lg-5 py-5">
        <div class="col-lg-7 text-center text-lg-start login-content">
            <!-- Login page heading -->
            <h1 class="display-4 fw-bold lh-1 mb-3">Welcome to <span class="stayInn-title">StayInn.com</span></h1>
            <p class="col-lg-10 fs-4">Book the best hotels with StayInn.com.</p>
            <!-- Login / Sign-up nav -->
            <nav class="fw-semibold">
                <a href=" ../pages/signup.php">Sign-up</a>
                <span class="nav-divider"> | </span>
                <a href="../pages/hotel.php">View Hotels</a>
            </nav>
        </div>

        <!-- Login form -->
        <div class="col-md-10 mx-auto col-lg-5">
            <form action="" class="p-4 p-md-5 rounded-3 bg-light needs-validation" method="post" novalidate>

                <div class="form-floating mb-3">
                    <!-- Username input -->
                    <input type="text" name="username" class="form-control" id="validationCustom01" placeholder="Enter your username" required>
                    <label for="validationCustom01">Username</label>
                    <div class="invalid-feedback">
                        Please enter a valid username.
                    </div>
                </div>

                <div class="form-floating mb-3">
                    <!-- Password input -->
                    <input type="password" name="password" class="form-control" id="validationCustom02" placeholder="Enter your password" required>
                    <label for="validationCustom02">Password</label>
                    <div class="invalid-feedback">
                        Please enter a valid password.
                    </div>
                </div>

                <!-- Remember me checkbox -->
                <div class="checkbox mb-3">
                    <label>
                        <input type="checkbox" value="remember-me"> Remember me
                    </label>
                </div>

                <!-- Login form submit btn -->
                <button class="w-100 btn btn-lg login-btn" type="submit">Login</button>
                <hr class="my-4">

                <!-- Create an account container -->
                <small class="text-muted create-account-container">
                    <div>Create an account: <a href="../pages/signup.php">Sign-up here</a></div>
                </small>
            </form>
        </div>
    </div>
</div>

<?php
// Include user class
require_once '../classes/userclass.php';

// Invokes login function if the login form is filled in and submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["username"]) && !empty($_POST["password"])) {

    // Capturing user data from sign-in form and assigning to variables
    // Also sanitizing data using htmlentities()
    $username = $_POST["username"];
    $username = htmlentities($username);
    $password = $_POST["password"];

    $result = User::login($username, $password);
    // If login function runs successfully then redirects user to the hotels page
    if ($result) {
        header("Location: ../pages/hotel.php");
        exit;
    }
}
?>
<!-- Bootstrap js CDN link -->
<?php include '../includes/footer.php'; ?>