<?php
// User session storage
$logged_in = $_SESSION['logged_in'];
$admin = $_SESSION["user"];

// User class where logout function is stored
include '../../classes/User.php';

if (
    isset($_GET['logout']) && $_GET['logout'] == true
) {
    User::logout();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS CDN link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
    <!-- Bootstrap icons CDN link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/sidebar.css">
</head>

<body>

    <div class="d-flex flex-column flex-shrink-0 p-3 text-bg-dark bg-opacity-75 bg-gradient" style="width: 280px; height: 100vh; position: fixed;">
        <div class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <div class="fs-2 gradient-text">StayInn.com</div>
        </div>
        <div>Admin Center</div>

        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item">
                <a href="../pages/users.php" class="nav-link text-white">
                    Users
                </a>
            </li>
            <li>
                <a href="../pages/bookings.php" class="nav-link text-white">
                    Bookings
                </a>
            </li>
            <li>
                <a href="../pages/hotels.php" class="nav-link text-white">
                    Hotels
                </a>
            </li>
            <hr>
            <li class="fs-5">
                <a href="../../index.php" class="nav-link text-white mb-2 border-bottom rounded-0">
                    StayInn.com<span><i class="ms-1 gradient-text bi-rocket-takeoff-fill" style="font-size: 1.2rem;"></i></span>
                </a>
            </li>
        </ul>

        <!-- <form action="" method="post"> -->
            <button name="logout" type="submit" class="btn btn-outline-secondary">
                <a class="text-white text-decoration-none" href="../pages/users.php?logout=true">Logout</a>
            </button>
        <!-- </form> -->
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    <!-- Modal Script -->
    <script>
        const myModal = document.getElementById('myModal')
        const myInput = document.getElementById('myInput')

        myModal.addEventListener('shown.bs.modal', () => {
            myInput.focus()
        })
    </script>

</body>

</html>