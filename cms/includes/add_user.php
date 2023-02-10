<!-- Button trigger modal -->
<?php
// If an admin user is signed in the they can add a new user otherwise the button is disabled
if ($admin['username'] !== "admin") {
    // User session data is stored in ../includes/sidebar.php

    // Disabled button
    echo '<button type="button" class="btn btn-sm btn-primary btn my-2 ms-2"    data-bs-toggle="modal" data-bs-target="#exampleModal" disabled>
    Add New User
    </button>';
} else {

    // Not disabled button
    echo '<button type="button" class="btn btn-sm btn-primary btn my-2 ms-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Add New User
    </button>';
}

?>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-light">

            <!-- Modal header -->
            <div class="modal-header">
                <h1 class="modal-title fs-5 text-primary" id="exampleModalLabel">Add User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">

                <!-- Add user form -->
                <form action="" class="sign-up-form row p-4 p-md-5 needs-validation" method="post" novalidate>
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


                    <!-- Add new user form submit btn -->
                    <button class="w-100 btn btn-outline-primary btn-lg" type="submit">Add New User</button>
                    <hr class="my-4">

                </form>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap form validation script -->
<script>
    (() => {
        'use strict'
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        const forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
        })
    })()
</script>

<?php
// Include user class
require_once '../../data/DatabaseConnector.php';
require_once '../../classes/User.php';

// Invokes signup function if the signup form is filled in and submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["username"]) && !empty($_POST["fullname"]) && !empty($_POST["password"]) && !empty($_POST["email"]) && !empty($_POST["address"]) && !empty($_POST["phonenumber"])) {

    // Capturing user data from sign-in form and assigning to variables
    // Also sanitizing data using htmlentities() & email filter
    $id = "";
    $username = $_POST["username"];
    $username = htmlentities($username);
    $full_name = $_POST["fullname"];
    $full_name = htmlentities($full_name);
    $password = $_POST['password'];
    $email = $_POST['email'];
    $sanitized_email = filter_var($email, FILTER_VALIDATE_EMAIL);

    $address = $_POST["address"];
    $address = htmlentities($address);
    $customer_id = "";
    $phone_number = $_POST["phonenumber"];
    $phone_number = htmlentities($phone_number);

    // Creating a new Customer object then use the data as session data. Also using this object to insert user 'id' property into customer 'customerid' value. I'm using this to make sure that user and customer data match up in the database. 
    $customer = new Customer($id, $username, $full_name, $password, $sanitized_email, $address, $customer_id, $phone_number);
    $result = $customer->signup($username, $full_name, $password, $email, $address, $phone_number);

    if ($result) {
        // Redirect user back to the same page (refreshes current page)
        echo "<meta http-equiv='refresh' content='0;url=../pages/users.php'>";
        exit;
    }
}
?>