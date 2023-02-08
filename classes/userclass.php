<?php
require_once "../data/DatabaseConnector.php";

$conn = new DatabaseConnector();
$conn = $conn->getConnection();

class User
{
    protected $id;
    protected $username;
    protected $fullname;
    protected $password;
    protected $email;
    protected $address;

    public function __construct($id, $username, $fullname, $password, $email, $address)
    {
        $this->id = $id;
        $this->username = $username;
        $this->fullname = $fullname;
        $this->password = $password;
        $this->email = $email;
        $this->address = $address;
    }

    public static function login()
    {
        if (!empty($_POST["username"]) && !empty($_POST["password"])) {
            $username = $_POST["username"];
            $password = $_POST["password"];

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

            if (password_verify($password, $hashed_password)) {
                $stmt = $conn->prepare("SELECT * FROM user WHERE username = ? AND password = ?");
                $stmt->bind_param("ss", $username, $hashed_password);
                $stmt->execute();
                $result = $stmt->get_result();
                $user = $result->fetch_assoc();

                if (!empty($user)) {
                    $_SESSION["user"] = $user;
                    $_SESSION['logged_in'] = true;

                    echo "<meta http-equiv='refresh' content='0;url=../pages/hotel.php'>";
                    exit;

                    echo "Login successful";
                    // Better to use return over echo
                }
            }
        }
        return false;
        echo "login failed";
    }

    public static function logout()
    {
        unset($_SESSION['logged_in']);
        echo "<meta http-equiv='refresh' content='0;url=../pages/login.php'>";

        exit;
    }

    public static function signup($username, $fullname, $password, $email, $address, $phonenumber)
    {
        require_once "../data/DatabaseConnector.php";
        $conn = new DatabaseConnector();
        $conn = $conn->getConnection();

        // Hashing password using Bcrypt. An interesting read on user credential storage and why I chose not to use MD5: (https://infosecscout.com/best-algorithm-password-storage/)
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        $query = "INSERT INTO user (username, fullname, password, email, address) 
              VALUES ('$username', '$fullname', '$hashed_password', '$email', '$address')";
        $result = mysqli_query($conn, $query);

        // If the user table insert is successful, then insert the customerid and phonenumber into the customer table
        if ($result) {
            $userid = mysqli_insert_id($conn);
            $query = "INSERT INTO customer (customerid, phonenumber) 
                  VALUES ('$userid', '$phonenumber')";
            $result = mysqli_query($conn, $query);

            if ($result) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}

class Customer extends User
{
    protected $customerid;
    protected $phonenumber;

    public function __construct($id, $username, $fullname, $password, $email, $address, $customerid, $phonenumber)
    {
        parent::__construct($id, $username, $fullname, $password, $email, $address);
        $this->customerid = $customerid;
        $this->phonenumber = $phonenumber;
    }
}

class Staff extends User
{
    protected $staffid;
    protected $role;

    public function __construct($id, $username, $fullname, $password, $email, $address, $staffid, $role)
    {
        parent::__construct($id, $username, $fullname, $password, $email, $address);
        $this->staffid = $staffid;
        $this->role = $role;
    }
}
