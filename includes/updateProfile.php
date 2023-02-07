<?php
session_start();
// Page includes
include '../includes/header.php';
// Session storage
$user_id = $_SESSION['user']['id'];
// Database connector
require_once "../data/DatabaseConnector.php";
$conn = new DatabaseConnector();
$conn = $conn->getConnection();
// Update the user's profile information in the database
$selectUserSQL = "SELECT fullname, username, email, address FROM user WHERE id = '$user_id'";
$result = $conn->query($selectUserSQL);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $fullname = $row['fullname'];
        $username = $row['username'];
        $email = $row['email'];
        $address = $row['address'];
    }
}
// Function to update fullname
function updateFullname($user_id, $fullname, $conn)
{
    $updateFullnameSQL = "UPDATE user SET fullname = '$fullname' WHERE id = '$user_id'";
    if ($conn->query($updateFullnameSQL) === TRUE) {
        return true;
    } else {
        return false;
    }
}
// Function to update email
function updateEmail($user_id, $email, $conn)
{
    $updateEmailSQL = "UPDATE user SET email = '$email' WHERE id = '$user_id'";
    if ($conn->query($updateEmailSQL) === TRUE) {
        return true;
    } else {
        return false;
    }
}
// Function to update address
function updateAddress($user_id, $address, $conn)
{
    $updateAddressSQL = "UPDATE user SET address = '$address' WHERE id = '$user_id'";
    if ($conn->query($updateAddressSQL) === TRUE) {
        return true;
    } else {
        return false;
    }
}
?>
<h1>Manage Profile</h1>
<div>
    <img width="100" src="../assets/001-hotel.png" alt="Profile image">
    <div>
        <h3><?php echo $fullname ?></h3>
        <h4>Your username: <?php echo $username ?></h4>
    </div>
</div>
<div class="container">
    <h5>Your Account Information</h5>
    <!-- Display the edit form -->
    <form action="" method="post">
        <div>
            <label for="fullname">Fullname:</label>
            <input type="text" id="fullname" name="fullname" value="<?php echo $fullname; ?>" readonly>
            <input type="submit" name="updateFullname" value="Edit">
        </div>
    </form>
    <?php
    if (isset($_POST['updateFullname'])) {
        $fullname = $_POST['fullname'];
        if (updateFullname($user_id, $fullname, $conn)) {
            echo "Update successful";
        } else {
            echo "Update failed. Please try again";
        }
    }
    ?>
    <form action="" method="post">
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $email; ?>" readonly>
            <input type="submit" name="updateEmail" value="Edit">
        </div>
    </form>
    <?php
    if (isset($_POST['updateEmail'])) {
        $email = $_POST['email'];
        if (updateEmail($user_id, $email, $conn)) {
            echo "Update successful";
        } else {
            echo "Update failed. Please try again";
        }
    }
    ?>
    <form action="" method="post">
        <div>
            <label for="address">Address:</label>
            <input type="text" id="address" name="address" value="<?php echo $address; ?>" readonly>
            <input type="button" name="updateAddress" value="Edit" onclick="toggleEdit(this)">
        </div>
    </form>
    <?php
    if (isset($_POST['updateAddress'])) {
        $address = $_POST['address'];
        if (updateAddress($user_id, $address, $conn)) {
            echo "Update successful";
        } else {
            echo "Update failed. Please try again";
        }
    }
    ?>