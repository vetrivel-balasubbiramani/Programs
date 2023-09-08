<?php

class DatabaseConnection {
    private $servername;
    private $dbUsername;
    private $dbPassword;
    private $dbname;
    private $conn;

    public function __construct($servername, $dbUsername, $dbPassword, $dbname) {
        $this->servername = $servername;
        $this->dbUsername = $dbUsername;
        $this->dbPassword = $dbPassword;
        $this->dbname = $dbname;

        $this->connect();
    }

    private function connect() {
        $this->conn = new mysqli($this->servername, $this->dbUsername, $this->dbPassword, $this->dbname);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function getConnection() {
        return $this->conn;
    }

    public function closeConnection() {
        if ($this->conn) {
            $this->conn->close();
        }
    }
}

$servername = "localhost";
$dbusername = "root";
$dbPassword = "admin123";
$dbname = "details";

$databaseConnection = new DatabaseConnection($servername, $dbusername, $dbPassword, $dbname);
$conn = $databaseConnection->getConnection();


?>