<style>
    /* Login page CSS */
    <?php include '../../css/login.css'; ?>
</style>
<?php
session_start();
print_r($_SESSION);
?>

<head>
    <!-- Bootstrap CSS CDN link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
    <!-- Bootstrap icons CDN link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
</head>

<!-- Login page container -->
<div class="container col-xl-10 col-xxl-8 px-4 py-5">
    <div class="row  g-lg-5 py-5">


        <!-- Login form -->
        <div class="col-md-10 mx-auto col-lg-5 text-center align-items-center bg-light p-4 rounded-5">
            <h1 class="display-4 fw-bold lh-1 mb-3 stayInn-title">StayInn.com</h1><span class="h5 text-muted">Admin CMS Login.</span>
            <form action="" class=" p-md-5 needs-validation" method="post" novalidate>

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
            </form>
        </div>

    </div>

    <?php
    // Require Db connector
    require_once "../../data/DatabaseConnector.php";
    // Include user class
    require_once '../../classes/User.php';

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
            header("Location: ../pages/users.php");
            exit;
        }
    }
    // Includes Bootstrap scripts
    include '../../includes/footer.php';
    ?>