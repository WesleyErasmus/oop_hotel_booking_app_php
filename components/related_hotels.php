<!-- Displays the list of related hotels that are similar based on hotel type -->
<div class="card mb-3 rounded-0">
    <?php foreach ($related_hotels as $data) : ?>
        <div class="row g-0">

            <!-- Hotel thumbnail -->
            <div class="col-md-4">
                <img src="<?php echo $data['thumbnail']; ?>" class="img-fluid start" alt="Hotel Thumbnail" />
            </div>
            <div class="col-md-8">

                <!-- Hotel name -->
                <div class="card-body">
                    <h5 class="card-title"><b><?php echo $data['name']; ?></b></h5><?php

                    // Comparing hotel price per night check - if cheaper then the hotel view hotel, it will display a green "cheaper" badge
                    if ($data['pricepernight'] < $hotel['pricepernight']) {
                        echo $compare_hotel_pricing = Hotel::compareHotelPricing();
                    }
                    ?>
                    <span>

                        <!-- Hotel star for loop iterating iterating as many times as the hotel rating value -->
                        <b><?php
                            for ($i = 0; $i < $data['rating']; $i++) {
                                echo '<i class="bi bi-star-fill" style="color: gold;"></i>';
                            }; ?>
                        </b></span>

                    <!-- Hotel type -->
                    <small>
                        <div class="card-text">
                            <span>Type:
                                <b><?php echo $data['type']; ?></b></span>
                        </div>
                    </small>
                    <div class="card-text">

                        <!-- Hotel Beds -->
                        <small class="">
                            <span><i class="bi bi-shop"></i> Beds:
                                <b><?php echo $data['beds']; ?>
                                </b></span>

                            <!-- Hotel Features -->
                            <span><i class="bi bi-suit-heart"></i> <span class="badge text-bg-primary">Features:</span>
                                <b><?php echo $data['features']; ?>
                                </b></span>
                        </small>
                        <div>

                            <!-- Hotel Location -->
                            <span><i class="bi bi-pin-map"></i>
                                <b><?php echo $data['location']; ?>
                                </b></span>
                            <div>

                                <!-- Hotel price per night -->
                                <span><i class="bi bi-credit-card"></i>
                                    <b>R<?php echo $data['pricepernight']; ?>
                                    </b> /per night</d>
                                    <div class="btn-group float-end">
                                        <!-- Must be logged in popover conditional. Popover is triggered if user is not logged in -->
                                <span class="d-inline-block" tabindex="0" 
                                <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
                                    echo '';
                                    } else {
                                    echo 'data-bs-toggle="popover"';
                                    } ?> data-bs-trigger="focus" data-bs-html="true" data-bs-title="You must be logged in to use this feature" data-bs-content="<a class='btn btn-sm btn-success' href='../pages/login.php'>Login Here</a> <a class='btn btn-sm btn-primary' href='../pages/sign_up.php'>Sign-up Here</a>">
                                    <!-- Button disabled conditional. Button is disabled if user is not logged in -->
                                <a href="../pages/hotel_view.php?id=<?php echo $data['id']; ?>" class="btn btn-outline-secondary 
                                <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
                                        echo '';
                                    } else {
                                        echo 'disabled';
                                    } ?>">View this hotel</a></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <hr />
    <?php endforeach; ?>
    <!-- End of foreach loop -->
</div>