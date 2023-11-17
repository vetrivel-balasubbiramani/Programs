<?php
session_start();
require_once 'DatabaseConnection.php';
if (!isset($_SESSION['is_user']) || $_SESSION['is_user'] !== true) {
    header("Location: LoginPage.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
</head>

<body>
    <?php
    $sub_page_id = $_GET['sub_page_id'];
    $sub_id = $_GET['sub_id'];
    $space_id = $_GET['space_id'];
    $sql = "SELECT content,title FROM subpages where sub_id='$sub_id'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $title = $row['title'];
            $content = $row['content'];
        }
    } else {
        echo "No results found.";
    }
    ?>
    <div>
        <h2><?= $title; ?></h2>
        <div><?= $content; ?></div>
    </div>
    <br><br><br><br><br>
</body>

</html>