<?php
session_start();
require_once 'DatabaseConnection.php';

class SubpageEditor
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function handleFormSubmission()
    {
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['publish'])) {
            $pageId = $_POST['page_id'];
            $pageDescription = $_POST["toolbox"];
            $title = $_POST["page_title"];

            $sql = "INSERT INTO subpages (`content`, `title`, `page_id`) VALUES (?, ?, ?)";
            $stmt = $this->conn->prepare($sql);

            if (!$stmt) {
                die("Error: " . $this->conn->error);
            }

            $stmt->bind_param("ssi", $pageDescription, $title, $pageId);

            if ($stmt->execute()) {
                echo " ";
            } else {
                echo "Error: " . $stmt->error;
            }

            $sql = "SELECT space_id FROM pages WHERE page_id = $pageId";
            $result = $this->conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $spaceId = $row['space_id'];
                }
            }

            header("Location: UserSpaceDetails.php?id=" . $spaceId);
        }
    }
}

$subpageEditor = new SubpageEditor($conn);
$subpageEditor->handleFormSubmission();
