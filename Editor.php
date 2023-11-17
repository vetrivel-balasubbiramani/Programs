<?php
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
header("Location:UserSpaceDetails.php?id=" . $space_id);
