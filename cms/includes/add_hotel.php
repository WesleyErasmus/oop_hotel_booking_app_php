<!-- Button trigger modal -->
<button type="button" class="btn btn-lg shadow-lg btn-success btn mt-3 ms-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Add New Hotel
</button>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content bg-light">

            <!-- Modal header -->
            <div class="modal-header">
                <h1 class="modal-title fs-5 text-primary" id="exampleModalLabel">Add Hotel</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">

                <!-- Add hotel form -->
                <form action="" class="sign-up-form row p-4 p-md-5 needs-validation" method="post" novalidate>
                    <div class="form-floating ps-1 mb-3 col-md-6">
                        <!-- Hotel name input -->
                        <input type="text" name="name" class="form-control" id="validationCustom01" required>
                        <label for="validationCustom01">Hotel Name</label>
                        <div class="invalid-feedback">
                            Please enter a valid hotel name.
                        </div>
                    </div>

                    <div class="form-floating ps-1 mb-3 col-md-6">
                        <!-- Hotel type input -->
                        <input type="text" name="type" class="form-control" id="validationCustom01" required>
                        <label for="validationCustom01">Hotel Type</label>
                        <div class="invalid-feedback">
                            Please enter a valid hotel type.
                        </div>
                    </div>

                    <div class="form-floating ps-1 mb-3 col-md-6">
                        <!-- Hotel rating input -->
                        <input type="number" name="rating" class="form-control" id="validationCustom01" max="5" required>
                        <label for="validationCustom01">Hotel Rating</label>
                        <div class="invalid-feedback">
                            Please enter a valid hotel rating that is less then 5.
                        </div>
                    </div>

                    <div class="form-floating ps-1 mb-3 col-md-6">
                        <!-- Hotel beds input -->
                        <input type="number" name="beds" class="form-control" id="validationCustom01" required>
                        <label for="validationCustom01">Hotel Beds</label>
                        <div class="invalid-feedback">
                            Please enter a valid hotel beds.
                        </div>
                    </div>

                    <div class="form-floating ps-1 mb-3 col-md-6">
                        <!-- Hotel location input -->
                        <input type="text" name="location" class="form-control" id="validationCustom01" required>
                        <label for="validationCustom01">Hotel Location</label>
                        <div class="invalid-feedback">
                            Please enter a valid hotel location.
                        </div>
                    </div>

                    <div class="form-floating ps-1 mb-3 col-md-6">
                        <!-- Hotel price per night input -->
                        <input type="number" name="pricepernight" class="form-control" id="validationCustom01" required>
                        <label for="validationCustom01">Hotel Price Per Night</label>
                        <div class="invalid-feedback">
                            Please enter a valid hotel price per night.
                        </div>
                    </div>

                    <div class="form-floating ps-1 mb-3 col-md-12">
                        <!-- Hotel features input -->
                        <input type="text" name="features" class="form-control" id="validationCustom01" required>
                        <label for="validationCustom01">Hotel Features</label>
                        <div class="invalid-feedback">
                            Please enter a valid hotel features.
                        </div>
                    </div>

                    <div class="form-floating ps-1 mb-3 col-md-12">
                        <!-- Hotel thumbnail input -->
                        <input type="text" name="thumbnail" class="form-control" id="validationCustom01" required>
                        <label for="validationCustom01">Hotel Thumbnail</label>
                        <div class="invalid-feedback">
                            Please enter a valid hotel thumbnail.
                        </div>
                    </div>


                    <!-- Add new user form submit btn -->
                    <button class="w-100 btn btn-outline-primary btn-lg" type="submit">Add New Hotel</button>
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

// Stores user input data from when the form is filled in and submitted
if (isset($_POST['name']) && isset($_POST['type']) && isset($_POST['rating']) && isset($_POST['beds']) && isset($_POST['features']) && isset($_POST['location']) && isset($_POST['pricepernight']) && isset($_POST['thumbnail'])) {
    $conn = new DatabaseConnector();
    $conn = $conn->getConnection();

    // Capturing user data from add hotel form and assigning to variables
    // Also sanitizing data using htmlentities() & email filter
    $name = $_POST['name'];
    $name = htmlentities($name);
    $type = $_POST['type'];
    $type = htmlentities($type);
    $rating = $_POST['rating'];
    $rating = htmlentities($rating);
    $beds = $_POST['beds'];
    $beds = htmlentities($beds);
    $features = $_POST['features'];
    $features = htmlentities($features);
    $location = $_POST['location'];
    $location = htmlentities($location);
    $price_per_night = $_POST['pricepernight'];
    $price_per_night = htmlentities($price_per_night);
    $thumbnail = $_POST['thumbnail'];
    // URL sanitizing
    $thumbnail = filter_var($thumbnail, FILTER_VALIDATE_URL);


    // Insert sql query into the hotel table
    $query = "INSERT INTO Hotel (name, type, rating, beds, features, location, pricepernight, thumbnail)
              VALUES ('$name', '$type', '$rating', '$beds', '$features', '$location', '$price_per_night', '$thumbnail')";

    if (mysqli_query(
        $conn,
        $query
    )) {
        // Redirect user back to the same page (refreshes current page)
        echo "<meta http-equiv='refresh' content='0;url=../pages/hotels.php'>";
        exit;
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
    mysqli_close($conn);
}
?>