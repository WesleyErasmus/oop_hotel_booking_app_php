<?php
// Check if the user is signed in
if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true) {

    // Redirect the user to the login page if they are not signed in
    header("Location: login.php");
    exit;
}
?>