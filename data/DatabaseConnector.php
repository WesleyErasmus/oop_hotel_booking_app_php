<?php
// DatabaseConnector class
class DatabaseConnector
{
    // Servername of the database
    private $servername = 'localhost';

    // Username used to connect to the database
    private $username = 'root';

    // Password used to connect to the database
    private $password = '';

    // Name of the database
    private $dbname = 'stayinn';

    // Connection object
    private $conn;

    // Constructor
    public function __construct()
    {
        // Connects to the database using the MySQLi
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        // Checks if the connection was successful, else it displays an error message
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    // Returns the connection object
    public function getConnection()
    {
        return $this->conn;
    }
}

// Include on pages
// require_once "../data/DatabaseConnector.php";
// $conn = new DatabaseConnector();
// $conn = $conn->getConnection();