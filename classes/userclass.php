<?php
// User class
class User
{
    protected $id;
    protected $username;
    protected $full_name;
    protected $password;
    protected $email;
    protected $address;

    public function __construct($id, $username, $full_name, $password, $email, $address)
    {
        $this->id = $id;
        $this->username = $username;
        $this->full_name = $full_name;
        $this->password = $password;
        $this->email = $email;
        $this->address = $address;
    }

    // User / customer login function
    public static function login($username, $password)
    {
        require_once "../data/DatabaseConnector.php";
        $conn = new DatabaseConnector();
        $conn = $conn->getConnection();

        // Using a prepared statement with a (?) value placeholder 
        $stmt = $conn->prepare("SELECT password FROM user WHERE username = ?");
        // Binding my username variable as a string(s) to the prepared statement
        $stmt->bind_param("s", $username);
        // Executing the prepared statement
        $stmt->execute();
        $result = $stmt->get_result();

        // Retrieving hashed password, as password was hashed in the user sing-up
        $hashed_password = $result->fetch_assoc()['password'];

        // Check inputted username and password with the database
        // password_verify checks that the verifies the password encryption on the database with the password that the user has entered
        if (password_verify($password, $hashed_password)) {
            $stmt = $conn->prepare("SELECT * FROM user WHERE username = ? AND password = ?");

            // Binding the parameter variables to the correct data type
            $stmt->bind_param("ss", $username, $hashed_password);
            // Executes the prepare statement

            $stmt->execute();
            // Retrieves the results set from a prepared statement and assigns it to the $result variable

            $result = $stmt->get_result();
            //  Retrieves the rows of the result and Iterates over the rows returned by the query
            $user = $result->fetch_assoc();

            // Creating user session storage
            if (!empty($user)) {
                $_SESSION["user"] = $user;
                $_SESSION['logged_in'] = true;
                // Redirects user to hotel.php page
                echo "<meta http-equiv='refresh' content='0;url=../pages/hotel.php'>";
                exit;

                return true;
            }
        }
        return false;
    }

    // Logout function destroys all session data and returns the user back to the login page
    public static function logout()
    {
        // Ends the user session, logging the customer out
        unset($_SESSION['logged_in']);
        // Destroy all session data
        session_destroy();
        // Redirects user to login.php page
        echo "<meta http-equiv='refresh' content='0;url=../pages/login.php'>";
        exit;
    }

    // Customer Sign up function
    public static function signup($username, $full_name, $password, $email, $address, $phone_number)
    {
        require_once "../data/DatabaseConnector.php";
        $conn = new DatabaseConnector();
        $conn = $conn->getConnection();

        // Hashing password using Bcrypt. An interesting read on user credential storage and why I chose not to use MD5: (https://infosecscout.com/best-algorithm-password-storage/)
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Insert new customer details into the database
        $query = "INSERT INTO user (username, fullname, password, email, address) 
              VALUES ('$username', '$full_name', '$hashed_password', '$email', '$address')";

        $result = mysqli_query($conn, $query);

        // If the user table insert is successful, then insert the customerid and phonenumber into the customer table
        if ($result) {
            // Above if statement checks if result of the user INSERT query
            $user_id = mysqli_insert_id($conn);

            // Insert query into customer table
            $query = "INSERT INTO customer (customerid, phonenumber) 
                  VALUES ('$user_id', '$phone_number')";

            $result = mysqli_query($conn, $query);

            if ($result) {
                // Above if statement checks the result of the customer INSERT query
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}

// Customer class extending from User class
class Customer extends User
{
    protected $customer_id;
    protected $phone_number;

    public function __construct($id, $username, $full_name, $password, $email, $address, $customer_id, $phone_number)
    {
        parent::__construct($id, $username, $full_name, $password, $email, $address);
        $this->customer_id = $customer_id;
        $this->phone_number = $phone_number;
    }
}
// Staff class extending from User class
class Staff extends User
{
    protected $staff_id;
    protected $role;

    public function __construct($id, $username, $full_name, $password, $email, $address, $staff_id, $role)
    {
        parent::__construct($id, $username, $full_name, $password, $email, $address);
        $this->staff_id = $staff_id;
        $this->role = $role;
    }
}
