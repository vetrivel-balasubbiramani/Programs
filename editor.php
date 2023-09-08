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
    
    require_once 'DatabaseConnection.php';


    session_start();
    

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['publish'])) {
        $page_description = $_POST["toolbox"];
        $title = $_POST["page_title"];
        $space_id = $_POST['space_id'];

         $sql = "INSERT INTO pages (`content`, `title`, `space_id`) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);

        if (!$stmt) {
            die("Error: " . $conn->error);
        }

        $stmt->bind_param("ssi", $page_description, $title, $space_id);

        if ($stmt->execute()) {
            echo " ";
        } else {
            echo "Error: " . $stmt->error;
        }
    }

    
    header("Location:user_space_details.php?id=".$space_id);

    ?>
    
</body>

</html>





