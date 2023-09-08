<?php

// error_reporting(E_ALL);
// ini_set('display_errors', 1);

class AdminPage
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
        
    }

    

    

    public function handleSpaceCreation()
    {
        

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['create_space'])) {
            function sanitize_input($data)
            {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }

            $space_name = sanitize_input($_POST["space_name"]);
            $space_description = sanitize_input($_POST["space_description"]);

            $sql = "INSERT INTO spaces (space_name, description) VALUES ('$space_name', '$space_description')";
            if ($this->conn->query($sql) === TRUE) {
                echo "Space created successfully!";
            } else {
                echo "Error: " . $sql . "<br>" . $this->conn->error;
            }
        }
    }

    public function renderSpacesList()
    {
        echo '<h2 style="text-align: center;">Spaces list:</h2>
                <div class="folder-container">';

        $sql = "SELECT * FROM spaces";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $space_id = $row["space_id"];
                $space_name = $row["space_name"];
                echo '<a class="folder" href="Admin_space_details.php?id=' . $space_id . '">';
                echo "<button>{$space_name}</button>" . '<br>';
                echo '</a>';
            }
        } else {
            echo "No spaces created yet.";
        }

        echo '</div><br><br>';
    }
}

require_once 'DatabaseConnection.php';

$adminPage = new AdminPage($conn);

?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin Page</title>
    <link rel="stylesheet" href="style/Admin.css">
    <script>
        function goLogout() {
            window.location.href = 'signupPage.php';
        }
    </script>
</head>
<body>

    <div class="header">
    <div class="topnav">
        <a style="color:red;text-decoration:none;" class="active" href="#">User:Admin</a>
    </div>
    <h2>Create Spaces</h2>
    </div>

    <div class="spaces-container">
    <form class="create-spaces-form" action="Admin.php" method="post">
        <label for="space_name">Space Name:</label>
        <input type="text" id="space_name" name="space_name" required>

        <label for="space_description">Space Description:</label>
        <textarea id="space_description" name="space_description" rows="4" required></textarea>

        <input class="create-spaces-button" type="submit" name="create_space" value="Create Space">
    </form>
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $adminPage->handleSpaceCreation();
        }
    $adminPage->renderSpacesList();
    ?>

    <div>
        <button id="Logout-btn" onclick="goLogout()">Logout</button>
    </div>

    </div>
</body>

</html>