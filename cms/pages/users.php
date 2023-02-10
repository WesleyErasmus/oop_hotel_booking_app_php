<style>
    <?php include '../css/main.css'; ?>
</style>
<?php
session_start();
// Db Connect
require_once '../../data/DatabaseConnector.php';
$conn = new DatabaseConnector();
$conn = $conn->getConnection();

// Include search function
include '../components/search.php';

// Select all user data query
$sql = "SELECT * FROM user";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!-- Include side navbar -->
<?php include '../includes/sidebar.php'; ?>

<!-- Page container -->
<div class="ps-3" style="margin-left: 280px;">
    <!-- Page top navbar -->
    <nav class="navbar sticky-top">
        <div class="container-fluid">

            <!-- Page heading -->
            <h1 class="text-muted">Manage Users</h1>
            <div class="d-flex">

                <!-- Check if clear button or search button in the search form is set -->
                <?php
                if (isset($_GET['clear'])) {
                    // Redirect user back to the same page (refreshes current page)
                    echo "<meta http-equiv='refresh' content='0;url=../pages/users.php'>";
                    exit;
                }
                $search = "";
                // Calling the search_users function
                if (isset($_GET['search'])) {
                    $user = search_users();
                }
                ?>
                <!-- Search form -->
                <form action="" class="d-flex gap-2">
                    <input type="text" name="search" class="form-control" placeholder="Search Users" value="<?php echo $search; ?>">
                    <button type="submit" class="btn btn-primary">Search</button>
                    <button type="submit" class="btn btn-outline-primary" name="clear" value="clear">Clear</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="position-relative">
        <!-- Add user modal -->
        <?php include '../includes/add_user.php' ?>

    </div>

    <!-- Users table -->
    <!-- Include sort component -->
    <?php include '../components/sort.php'; ?>

    <!-- Sort Form: 1) The form action adds the variable name plus =desc or =asc in the page URL. 2) Using a turnery statement change the caret icon depending on if $sort_variable is asc or desc. -->
    <form class="ps-2 pt-2" action="?user_sort=<?php echo $sort_user; ?>" method="post">

        <input name="user_sort" id="sort_button" class="btn btn-link text-decoration-none" type="submit" value="Sort By Name">

        <?php echo $sort_user == 'asc' ? '<i class="bi-caret-down-fill"></i>' : '<i class="bi-caret-up-fill"></i>'; ?>

    </form>

    <div class="table-container mt-2">
        <table class="table table-bordered table-hover">
            <thead class="gradient-bg sticky-top py-1">
                <tr>
                    <th>id</th>
                    <th>Full name</th>
                    <th>username</th>
                    <th>address</th>
                    <th>password</th>
                    <th>email</th>
                </tr>
            </thead>
            <?php
            foreach ($user as $data) : ?>
                <tbody>
                    <tr>
                        <th><?php echo $data['id']; ?></th>
                        <td><?php echo $data['fullname']; ?></td>
                        <td><?php echo $data['username']; ?></td>
                        <td><?php echo $data['address']; ?></td>
                        <td><?php echo $data['password']; ?></td>
                        <td><?php echo $data['email']; ?></td>
                    </tr>
                </tbody>
            <?php endforeach; ?>
        </table>
    </div>
</div>