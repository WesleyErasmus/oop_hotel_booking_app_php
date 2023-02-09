<style>
    <?php include '../css/profile.css'; ?>
</style>
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

<div class="container">
    <h3 class="pb-4 mb-4 mt-4 fst-italic border-bottom">Manage Your Profile</h3>
    <div class="col-xl-10 col-xxl-8 px-4 py-5 profile-details-container">
        <div class="row g-lg-6">
            <div class="col-lg-5 ms-3 mb-3 p-0 user-details-display">
                <div>
                    <i class="bi-person-circle" style="font-size: 125px; color: cornflowerblue;"></i>
                </div>
                <div class="username-container">
                    <h3 class="lh-1 mb-3">Welcome, <?php echo $fullname ?></h3>
                    <h5 class="col-lg-10 text-muted">Username: <?php echo $username ?></h5>
                </div>
            </div>

            <div class="col-md-10 col-lg-7 p-0 form-container">
                <!-- Account details edit form -->
                <form action="" class="p-4 p-md-5 rounded-3 bg-light" method="post">
                    <h5 class="text-muted">Update Your Account Information:</h5>

                    <div class="form-label mb-3">
                        <label for="fullname" class="form-label">Fullname</label>
                        <input class="form-control" type="text" id="fullname" name="fullname" value="<?php echo $fullname; ?>" readonly>
                    </div>

                    <div class="form-label mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input class="form-control" type="email" id="email" name="email" value="<?php echo $email; ?>" readonly>
                    </div>

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
if (isset($_POST['fullname']) && isset($_POST['email']) && isset($_POST['address'])) {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    if (updateProfile($user_id, $fullname, $email, $address, $conn)) {
        echo "<meta http-equiv='refresh' content='0;url=../pages/profile.php'>";
        exit;
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