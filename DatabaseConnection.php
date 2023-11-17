<?php
class DatabaseConnection
{
    private $conn;

    public function __construct(
        private string $servername,
        private string $dbUsername,
        private string $dbPassword,
        private string $dbname
    ) {
        $this->connect();
    }

    private function connect()
    {
        $this->conn = new mysqli($this->servername, $this->dbUsername, $this->dbPassword, $this->dbname);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }
    public function getConnection()
    {
        return $this->conn;
    }
}
$servername = "localhost";
$dbusername = "root";
$dbPassword = "admin123";
$dbname = "details";
$databaseConnection = new DatabaseConnection($servername, $dbusername, $dbPassword, $dbname);
$conn = $databaseConnection->getConnection();
