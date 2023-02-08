<style>
    <?php include '../css/signup.css'; ?>
</style>
<?php
session_start();
// Include Header
include '../includes/header.php'; ?>

<!-- Login page container -->
<div class="container col-xl-10 col-xxl-8 px-4 py-5">
    <div class="row align-items-center g-lg-5 py-5">

        <!-- Login form -->
        <div class="col-md-10 mx-auto col-lg-10">
            <div class="text-center text-lg-center login-content">
                <!-- Login page heading -->
                <h1 class="display-4 fw-bold lh-1 mb-3 stayInn-title">Welcome to <span class="stayInn-title">StayInn.com</span></h1>
                <!-- Login / Sign-up nav -->
                <nav class="fw-semibold mb-4">
                    <a href="../pages/hotel.php">View Hotels</a>
                </nav>
            </div>

            <form action="" class="sign-up-form row p-4 p-md-5 rounded-3 bg-light needs-validation" method="post" novalidate>
                <div class="form-floating ps-1 mb-3 col-md-6">
                    <!-- Username input -->
                    <input type="text" name="username" class="form-control" id="validationCustom01" placeholder="Enter your username" required>
                    <label for="validationCustom01">Username</label>
                    <div class="invalid-feedback">
                        Please enter a valid username.
                    </div>
                </div>
                <div class="form-floating ps-1 mb-3 col-md-6">
                    <!-- Password input -->
                    <input type="password" name="password" class="form-control" id="validationCustom03" placeholder="Enter your password" required>
                    <label for="validationCustom03">Password</label>
                    <div class="invalid-feedback">
                        Please enter a valid password.
                    </div>
                </div>
                <div class="form-floating ps-1 mb-3 col-md-6">
                    <!-- Email input -->
                    <input type="email" name="email" class="form-control" id="validationCustom04" placeholder="Enter your email" required>
                    <label for="validationCustom04">Email</label>
                    <div class="invalid-feedback">
                        Please enter a valid email.
                    </div>
                </div>
                <div class="form-floating ps-1 mb-3 col-md-6">
                    <!-- Phone number input -->
                    <input type="number" name="phonenumber" class="form-control" id="validationCustom06" placeholder="Enter your phone number" required>
                    <label for="validationCustom06">Phone Number</label>
                    <div class="invalid-feedback">
                        Please enter a valid phone number.
                    </div>
                </div>
                <div class="form-floating ps-1 mb-3 col-12">
                    <!-- Fullname input -->
                    <input type="text" name="fullname" class="form-control" id="validationCustom02" placeholder="Enter your full name" required>
                    <label for="validationCustom02">Full Name</label>
                    <div class="invalid-feedback">
                        Please enter a valid full name.
                    </div>
                </div>
                <div class="form-floating ps-1 mb-3 col-md-12">
                    <!-- Address input -->
                    <input type="text" name="address" class="form-control" id="validationCustom05" placeholder="Enter your address" required>
                    <label for="validationCustom05">Address</label>
                    <div class="invalid-feedback">
                        Please enter a valid address.
                    </div>
                </div>

                <!-- Remember me checkbox -->
                <div class="checkbox mb-3">
                    <label>
                        <input type="checkbox" value="remember-me"> Remember me
                    </label>
                </div>

                <!-- Login form submit btn -->
                <button class="w-100 btn btn-lg login-btn" type="submit">Sign-up</button>
                <hr class="my-4">

                <!-- Create an account container -->
                <small class="text-muted create-account-container">
                    <div>Already a user: <a href="../pages/login.php">Login here</a></div>
                </small>
            </form>
        </div>
    </div>
</div>

<?php
// Include user class
require_once '../classes/userclass.php';

// Invokes signup function if the signup form is filled in and submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["username"]) && !empty($_POST["fullname"]) && !empty($_POST["password"]) && !empty($_POST["email"]) && !empty($_POST["address"]) && !empty($_POST["phonenumber"])) {

    // Capturing user data from sign-in form and assigning to variables
    // Also sanitizing data using htmlentities()
    $id = "";
    $username = $_POST["username"];
    $username = htmlentities($username);
    $fullname = $_POST["fullname"];
    $fullname = htmlentities($fullname);
    $password = $_POST['password'];
    $email = $_POST['email'];
    // 🚨🚨🚨 Validate email - fix 🚨🚨🚨
    $sanitized_email = filter_var($email, FILTER_VALIDATE_EMAIL);

    $address = $_POST["address"];
    $address = htmlentities($address);
    $customerid = "";
    $phonenumber = $_POST["phonenumber"];
    $phonenumber = htmlentities($phonenumber);

    // Creating a new Customer object then use the data as session data. Also using this object to insert user 'id' property into customer 'customerid' value. I'm using this to make sure that user and customer data match up in the database. 
    $customer = new Customer($id, $username, $fullname, $password, $sanitized_email, $address, $customerid, $phonenumber);
    $result = $customer->signup($username, $fullname, $password, $email, $address, $phonenumber);

    if ($result) {
        echo "<meta http-equiv='refresh' content='0;url=../pages/login.php'>";
        exit;
    }
}
?>

<?php include '../includes/footer.php'; ?>