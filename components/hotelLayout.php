<div class="row g-5" style="flex-direction: row-reverse;">
  <div class="col-md-8">
    <h3 class="pb-4 mb-4 fst-italic border-bottom">Hotels</h3>

    <article class="blog-post">

      <div class="card mb-3 rounded-0">
        <?php foreach ($hotel as $data) : ?>
          <div class="row g-0">
            <div class="col-md-4">
              <img src="<?php echo $data['thumbnail']; ?>" class="img-fluid start" alt="Hotel Thumbnail" />
            </div>
            <div class="col-md-8">
              <div class="card-body">
                <h5 class="card-title"><b><?php echo $data['name']; ?></b></h5>

                <small>
                  <div class="card-text">
                    <span>Type:
                      <b><?php echo $data['type']; ?></b></span>
                    <span>Rating:
                      <b><?php echo $data['rating']; ?>
                      </b></span>
                    <i class="bi bi-star-fill" style="color: gold;"></i>
                    <i class="bi bi-star-fill" style="color: gold;"></i>
                    <i class="bi bi-star-fill" style="color: gold;"></i>
                    <i class="bi bi-star-fill" style="color: gold;"></i>
                    <i class="bi bi-star-fill" style="color: gold;"></i>
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

                    </div>
                    <div class="btn-group float-end">
                      <!-- Must be logged in popover conditional. Popover is triggered if user is not logged in -->
                      <span class="d-inline-block" tabindex="0" <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
                                                                  echo '';
                                                                } else {
                                                                  echo 'data-bs-toggle="popover"';
                                                                } ?> data-bs-trigger="focus" data-bs-html="true" data-bs-title="You must be logged in to use this feature" data-bs-content="<a class='btn btn-sm btn-success' href='../pages/login.php'>Login Here</a> <a class='btn btn-sm btn-primary' href='../pages/signup.php'>Sign-up Here</a>">
                        <!-- Button disabled conditional. Button is disabled if user is not logged in -->
                        <a href="../pages/booking.php?id=<?php echo $data['id']; ?>" class="btn btn-outline-secondary <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
                                                                                                                        echo '';
                                                                                                                      } else {
                                                                                                                        echo 'disabled';
                                                                                                                      } ?>">Explore More</a></span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <hr />
        <?php endforeach; ?>
    </article>
  </div>

  <div class="col-md-4">
    <div class="position-sticky" style="top: 2rem">
      <div class="p-4 mb-3 bg-light rounded">
        <h4 class="fst-italic">About</h4>
        <p class="mb-0">
          Customize this section to tell your visitors a little bit about your
          publication, writers, content, or something else entirely. Totally up
          to you.
        </p>
      </div>

      <div class="p-4">
        <h4 class="fst-italic">Archives</h4>
        <ol class="list-unstyled mb-0">
          <li><a href="#">March 2021</a></li>
          <li><a href="#">February 2021</a></li>
          <li><a href="#">January 2021</a></li>
          <li><a href="#">December 2020</a></li>
          <li><a href="#">November 2020</a></li>
          <li><a href="#">October 2020</a></li>
          <li><a href="#">September 2020</a></li>
          <li><a href="#">August 2020</a></li>
          <li><a href="#">July 2020</a></li>
          <li><a href="#">June 2020</a></li>
          <li><a href="#">May 2020</a></li>
          <li><a href="#">April 2020</a></li>
        </ol>
      </div>

      <div class="p-4">
        <h4 class="fst-italic">Elsewhere</h4>
        <ol class="list-unstyled">
          <li><a href="#">GitHub</a></li>
          <li><a href="#">Twitter</a></li>
          <li><a href="#">Facebook</a></li>
        </ol>
      </div>
    </div>
  </div>
</div>