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
// Function to update Profile
function updateProfile($user_id, $fullname, $email, $address, $conn)
{
    $updateProfileSQL = "UPDATE user SET fullname = '$fullname', email = '$email', address = '$address' WHERE id = '$user_id'";
    if ($conn->query($updateProfileSQL) === TRUE) {
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
        </div>
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $email; ?>" readonly>
        </div>
        <div>
            <label for="address">Address:</label>
            <input type="text" id="address" name="address" value="<?php echo $address; ?>" readonly>
        </div>
    </form>

    <!-- Edit and save btn -->
    <button id="editButton" onclick="toggleEdit(this)">Edit</button>
    <button id="saveButton" onclick="submitForm(this)" disabled>Save</button>
    
    <?php
    if (isset($_POST['fullname']) && isset($_POST['email']) && isset($_POST['address'])) {
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        if (updateProfile($user_id, $fullname, $email, $address, $conn)) {
            echo "Update successful";
        } else {
            echo "Update failed. Please try again";
        }
    }
    ?>
</div>
<!-- JS toggle between save and edit disable buttons -->
<script>
    function toggleEdit(element) {
        const inputFields = document.querySelectorAll('input[type="text"], input[type="email"]');
        inputFields.forEach(inputField => {
            inputField.readOnly = !inputField.readOnly;
        });
        document.querySelector('#editButton').disabled = true;
        document.querySelector('#saveButton').disabled = false;
    }

    function submitForm(element) {
        document.querySelector('form').submit();
    }
</script>