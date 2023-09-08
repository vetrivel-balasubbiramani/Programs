<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
require_once 'DatabaseConnection.php';
class UserPage
{
    private $conn;
    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    public function redirectToLoginPage()
    {
        if (!isset($_SESSION['is_user']) || $_SESSION['is_user'] !== true) {
            header("Location: LoginPage.php");
            exit();
        }
    }
    public function getUser()
    {
        return $_SESSION["username"];
    }
    public function renderTopNav()
    {
        $user = $this->getUser();
        echo '<div class="topnav">
                <a style="color:red;text-decoration:none;" class="active" href="#">' . "User: {$user}" . '</a>
            </div>';
    }
    public function renderFolderContainer()
    {
        $user = $this->getUser();
        $get_row = "SELECT * FROM users WHERE username= '$user'";
        $result1 = $this->conn->query($get_row);
        
        if ($result1->num_rows === 1) {
            $row = $result1->fetch_assoc();
            $user_id = $row['id'];
            $space_access = $row['space_access'];

            $space_access_array = explode(',', $space_access);
            $space_access_array = array_map('intval', $space_access_array);
        }
        $sql = "SELECT * FROM spaces";
        $result = $this->conn->query($sql);

        echo '<div class="folder-container">';

        $spacesFound = false; // Track whether any spaces were found

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $space_id = $row["space_id"];
            $space_name = $row["space_name"];

            if (in_array($space_id, $space_access_array)) {
                echo '<div class="folder" onclick="window.location.href=\'user_space_details.php?id=' . $space_id . '\'">';
                echo "<strong>{$space_name}</strong>" . '<br>';
                echo '</div>';
                $spacesFound = true; // Set to true if at least one space is found
            }
        }
    }

    if (!$spacesFound) {
        echo '<div>No spaces created yet</div>';
    }

    echo '</div>';
}

}
$userPage = new UserPage($conn);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Page</title>
    <link rel="stylesheet" href="style/userPage.css">
    <script>
  function goLogout() {
      window.location.href = 'signupPage.php';
  }
</script>
</head>
<body>
    <div class="header">
        <?php
        $userPage->renderTopNav();
        ?>
        <h1>Available Spaces</h1>
    </div>

    <div class="container">
        <?php 
        $userPage->renderFolderContainer();
        ?>
    </div>

    <div class="container log-div">
        <button class="logout-button" onclick="goLogout()">Log Out</button>
    </div>
</body>
</html