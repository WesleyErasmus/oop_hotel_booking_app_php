<?php
class DatabaseConnector
{
    private $servername = 'localhost';
    private $username = 'root';
    private $password = '';
    private $dbname = 'stayinn';
    private $conn;

    public function __construct()
    {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function getConnection()
    {
        return $this->conn;
    }
}

// Include on pages
// require_once "../data/DatabaseConnector.php";
// $conn = new DatabaseConnector();
// $conn = $conn->getConnection();