<!-- Displays all hotels -->
<article class="blog-post">
  <div class="card mb-3 rounded-0">
    <?php foreach ($hotel as $data) : ?>
      <div class="row g-0">
        <div class="col-md-4">
          <img src="<?php echo $data['thumbnail']; ?>" class="img-fluid start" alt="Hotel Thumbnail" style="width: 275px; height: 175px;" />
        </div>
        <div class="col-md-8">
          <div class="card-body">
            <h5 class="card-title"><b><?php echo $data['name']; ?></b></h5>
            <!-- Hotel star for loop iterating iterating as many times as the hotel rating value -->
            <?php
            for ($i = 0; $i < $data['rating']; $i++) {
              echo '<i class="bi bi-star-fill" style="color: gold;"></i>';
            }; ?>
            <small>
              <div class="card-text">
                <span>Type:
                  <b><?php echo $data['type']; ?></b></span>
              </div>
            </small>
            <div class="card-text">
              <small class="">
                <span><i class="bi bi-shop"></i> Beds:
                  <b><?php echo $data['beds']; ?>
                  </b></span>
                <span><i class="bi bi-suit-heart"></i> <span class="badge text-bg-primary">Features:</span>
                  <b><?php echo $data['features']; ?>
                  </b></span>
              </small>
              <div>
                <span><i class="bi bi-pin-map"></i>
                  <b><?php echo $data['location']; ?>
                  </b></span>
                <div>
                  <span><i class="bi bi-credit-card"></i>
                    <b>R<?php echo $data['pricepernight']; ?>
                    </b> /per night</d>

                    <div class="d-flex flex-column float-end">
                      <!-- NOT WORKING -- NEED TO FIX -->
                      <!-- Must be logged in popover conditional. Popover is triggered if user is not logged in -->
                      <span class="col d-flex ">
                        <!-- Button disabled conditional. Button is disabled if user is not logged in -->
                        <a href="../pages/hotel_view.php?id=<?php echo $data['id']; ?>" class="btn btn-outline-secondary 
                        
                        <?php
                        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
                          echo '';
                        } else {
                          echo 'disabled';
                        } ?>">View Hotel</a></span>
                      <?php
                      if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
                        echo '';
                      } else {
                        echo '<small><span class="text-muted"><a href="../pages/login.php">Login to View Hotel</a></span></small>';
                      }
                      ?>

                    </div>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
      <hr />
    <?php endforeach; ?>
  </div>
</article>