<?php
session_start();
// Include Header
include '../includes/header.php'; ?>

<header>
    <title>Sign Up</title><span>Already a user <a href="../pages/login.php">Login</a></span>
</header>

<!-- Sign-up form -->
<h2>Sign Up</h2>
<form action="" method="post">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required><br><br>

    <label for="fullname">Full Name:</label>
    <input type="text" id="fullname" name="fullname" required><br><br>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br><br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><br><br>

    <label for="address">Address:</label>
    <input type="text" id="address" name="address" required><br><br>

    <label for="phonenumber">Phone Number:</label>
    <input type="text" id="phonenumber" name="phonenumber" required><br><br>

    <input type="submit" name="submit" value="Sign Up">
</form>

<?php
// Include user class
require_once '../classes/userclass.php';

// Invokes signup function if the signup form is filled in and submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["username"]) && !empty($_POST["fullname"]) && !empty($_POST["password"]) && !empty($_POST["email"]) && !empty($_POST["address"]) && !empty($_POST["phonenumber"])) {

    // Capturing user data from sign-in form
    $id = "";
    $username = $_POST["username"];
    $fullname = $_POST["fullname"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $customerid = "";
    $phonenumber = $_POST["phonenumber"];

    $customer = new Customer($id, $username, $fullname, $password, $email, $address, $customerid, $phonenumber);
    $result = $customer->signup();
    if ($result) {

        echo "<meta http-equiv='refresh' content='0;url=../pages/login.php'>";
        exit;
    }
}
?>

<?php include '../includes/footer.php'; ?>