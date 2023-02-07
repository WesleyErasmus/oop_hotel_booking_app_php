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

            $query = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
            $result = mysqli_query($conn, $query);
            $user = mysqli_fetch_assoc($result);
            if (!empty($user)) {
                $_SESSION["user"] = $user;
                $_SESSION['logged_in'] = true;

                echo "<meta http-equiv='refresh' content='0;url=../pages/hotel.php'>";
                exit;

                echo "Login successful";
                // Better to use return over echo
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

    public static function signup()
    {
        if (
            !empty($_POST["username"]) && !empty($_POST["fullname"]) && !empty($_POST["password"])
            && !empty($_POST["email"]) && !empty($_POST["address"])
        ) {
            $username = $_POST["username"];
            $fullname = $_POST["fullname"];
            $password = $_POST["password"];
            $email = $_POST["email"];
            $address = $_POST["address"];
            $phonenumber = $_POST["phonenumber"];

            require_once "../data/DatabaseConnector.php";
            $conn = new DatabaseConnector();
            $conn = $conn->getConnection();

            $query = "INSERT INTO user (username, fullname, password, email, address) 
                  VALUES ('$username', '$fullname', '$password', '$email', '$address')";
            $result = mysqli_query($conn, $query);

            // If the user table insert is successful, then insert the customerid and phonenumber into the customer table
            if ($result) {
                $userid = mysqli_insert_id($conn);
                $query = "INSERT INTO customer (customerid, phonenumber) 
                  VALUES ('$userid', '$phonenumber')";
                $result = mysqli_query($conn, $query);

                // echo "Signup successful";
                return true;
            } else {
                echo "Signup failed";
                return false;
            }
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
