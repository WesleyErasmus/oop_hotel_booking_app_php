<style>
    /* Profile page stylesheet */
    <?php include '../css/profile.css'; ?>
</style>
<?php
session_start();
// Restrict assess to users not signed in by redirecting them to login page
include '../includes/restrict_access.php';

// Logs user out after 1hr of inactivity
include '../includes/session_tracking.php';

// Page includes
include '../includes/header.php';

// Logged in user session storage
$user_id = $_SESSION['user']['id'];

// Database connector
require_once "../data/DatabaseConnector.php";
$conn = new DatabaseConnector();
$conn = $conn->getConnection();


// Select the user's profile information from the database from their user 'id'
$select_user = "SELECT fullname, username, email, address FROM user WHERE id = '$user_id'";
$result = $conn->query($select_user);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {

        // Set variables
        $full_name = $row['fullname'];
        $username = $row['username'];
        $email = $row['email'];
        $address = $row['address'];
    }
}
// Function to update user profile (full name, email, address)
function updateProfile($user_id, $full_name, $email, $address, $conn)
{
    // Update user query - updates table property based on assigned variable
    $update_profile = "UPDATE user SET fullname = '$full_name', email = '$email', address = '$address' WHERE id = '$user_id'";
    if ($conn->query($update_profile) === TRUE) {
        return true;
    } else {
        return false;
    }
}
?>
<!-- Profile page container -->
<div class="container">
    <!-- Page heading -->
    <h3 class="pb-4 mb-4 mt-4 fst-italic border-bottom">Manage Your Profile</h3>
    <div class="col-xl-10 col-xxl-8 px-4 py-5 profile-details-container">
        <div class="row g-lg-6">
            <div class="col-lg-5 ms-3 mb-3 p-0 user-details-display">

                <!-- User account icon -->
                <div>
                    <i class="bi-person-circle" style="font-size: 125px; color: cornflowerblue;"></i>
                </div>
                <div class="username-container">

                    <!-- Display full name -->
                    <h3 class="lh-1 mb-3"><?php echo $full_name ?></h3>

                    <!-- Display username -->
                    <h5 class="col-lg-10 text-muted">Username: <?php echo $username ?></h5>
                </div>
            </div>

            <div class="col-md-10 col-lg-7 p-0 form-container">
                <!-- Account update form -->
                <form action="" class="p-4 p-md-5 rounded-3 bg-light" method="post">
                    <h5 class="text-muted">Update Your Account Information:</h5>

                    <!-- Full name input -->
                    <div class="form-label mb-3">
                        <label for="fullname" class="form-label">Full Name</label>
                        <input class="form-control" type="text" id="fullname" name="fullname" value="<?php echo $full_name; ?>" readonly>
                    </div>

                    <!-- Email input -->
                    <div class="form-label mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input class="form-control" type="email" id="email" name="email" value="<?php echo $email; ?>" readonly>
                    </div>

                    <!-- Address input -->
                    <div class="form-label mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input class="form-control" type="text" id="address" name="address" value="<?php echo $address; ?>" readonly>
                    </div>

                    <!-- Edit and save btn -->
                    <div class="d-grid gap-2 mt-4 me-1 d-md-flex justify-content-md-end">
                        <button class="btn btn-primary px-5" id="editButton" onclick="toggleEdit(this)">Edit</button>
                        <button class="btn btn-success px-5" id="saveButton" onclick="submitForm(this)" disabled>Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
// Checks if the values of the 'fullname', 'email', and 'address' keys are in the $_POST array
if (isset($_POST['fullname']) && isset($_POST['email']) && isset($_POST['address'])) {
    // $full_name = $_POST['fullname'];
    // $email = $_POST['email'];
    // $address = $_POST['address'];
    // Sanitizing inputs with mysqli_real_escape_string() to avoid SQL injections
    $full_name = mysqli_real_escape_string($conn, $_POST['fullname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);

    // Invoke updateProfile function and pass required parameters
    if (updateProfile($user_id, $full_name, $email, $address, $conn)) {
        echo "<meta http-equiv='refresh' content='0;url=../pages/profile.php'>";
        exit;
    }
}
?>
</div>

<script>
    // Toggles the read-only state of input fields with type "text" or "email"
    function toggleEdit(element) {
        // Selects all input fields with type "text" or "email"
        const inputFields = document.querySelectorAll('input[type="text"], input[type="email"]');
        // Loops through each input field and set its readOnly property to the opposite of its current value
        inputFields.forEach(inputField => {
            inputField.readOnly = !inputField.readOnly;
        });
        // Disable the "edit" button and enable the "save" button
        document.querySelector('#editButton').disabled = true;
        document.querySelector('#saveButton').disabled = false;
    }

    // Submits the form on the page
    function submitForm(element) {
        document.querySelector('form').submit();
    }
</script>