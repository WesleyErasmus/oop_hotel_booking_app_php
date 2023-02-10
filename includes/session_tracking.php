<?php
// Sign user out if there is no activity on the website in an hour
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 3600)) {

    session_unset();
    session_destroy();
}
$_SESSION['LAST_ACTIVITY'] = time(); // updates last activity time stamp

?>