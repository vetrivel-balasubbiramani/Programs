<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
   
</head>

<body>
    <?php
    // error_reporting(E_ALL);
    // ini_set('display_errors', 1);
    // header("Access-Control-Allow-Origin: *");

    session_start();
    require_once 'DatabaseConnection.php';


    $page_id = $_POST['page_id'];

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['publish'])) {
        $page_description = $_POST["toolbox"];
        $title = $_POST["page_title"];

        $sql = "INSERT INTO subpages (`content`, `title`, `page_id`) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            die("Error: " . $conn->error);
        }

        $stmt->bind_param("ssi", $page_description, $title, $page_id);

        if ($stmt->execute()) {
            echo " ";
        } else {
            echo "Error: " . $stmt->error;
        }

        $sql = "SELECT space_id FROM pages WHERE page_id= $page_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $space_id = $row['space_id'];
            }
        }
    }
    header("Location:user_space_details.php?id=".$space_id);
    ?>
   
</body>

</html>