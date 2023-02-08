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
    <input type="email" id="email" name="email" ><br><br>

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
    // Username Validation
    $username = htmlentities($username);
    $fullname = $_POST["fullname"];
    // Fullname validation
    $fullname = htmlentities($fullname);
    $password = $_POST['password'];

    $email = $_POST['email'];

    // Validate email
    $sanitized_email = filter_var($email, FILTER_VALIDATE_EMAIL);
    

    $address = $_POST["address"];
    $address = htmlentities($address);
    $customerid = "";
    $phonenumber = $_POST["phonenumber"];
    $phonenumber = htmlentities($phonenumber);

    $customer = new Customer($id, $username, $fullname, $password, $sanitized_email, $address, $customerid, $phonenumber);
    $result = $customer->signup($username, $fullname, $password, $email, $address, $phonenumber);

    if ($result) {

        echo "<meta http-equiv='refresh' content='0;url=../pages/login.php'>";
        exit;
    }
}
?>

<?php include '../includes/footer.php';

// if (
//     !empty($_POST["username"]) && !empty($_POST["fullname"]) && !empty($_POST["password"])
//     && !empty($_POST["email"]) && !empty($_POST["address"])
// ) {
//     $username = $_POST["username"];
//     $fullname = $_POST["fullname"];
//     $password = $_POST["password"];
//     // Hashing password using Bcrypt. An interesting read on user credential storage and why I chose not to use MD5: (https://infosecscout.com/best-algorithm-password-storage/)
//     $password = password_hash($password, PASSWORD_BCRYPT);
//     $email = $_POST["email"];
//     $address = $_POST["address"];
//     $phonenumber = $_POST["phonenumber"];

//     require_once "../data/DatabaseConnector.php";
//     $conn = new DatabaseConnector();
//     $conn = $conn->getConnection();

//     $query = "INSERT INTO user (username, fullname, password, email, address) 
//                   VALUES ('$username', '$fullname', '$hashed_password', '$email', '$address')";
//     $result = mysqli_query($conn, $query);

//     // If the user table insert is successful, then insert the customerid and phonenumber into the customer table
//     if ($result) {
//         $userid = mysqli_insert_id($conn);
//         $query = "INSERT INTO customer (customerid, phonenumber) 
//                   VALUES ('$userid', '$phonenumber')";
//         $result = mysqli_query($conn, $query);

//         if (filter_var($email, FILTER_SANITIZE_EMAIL)) {
//             return true;
//         } else {
//             // return false;

//             $err = "Please enter a valid email address.\n";
//             return $err;
//         }

//         // echo "Signup successful";
//         return true;

//         echo "<meta http-equiv='refresh' content='0;url=../pages/login.php'>";
//         exit;
//     } else {
//         echo "Signup failed";
//         return false;
//     }
// }

?>