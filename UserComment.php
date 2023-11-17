<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
require_once 'DatabaseConnection.php';

if (!isset($_SESSION['is_user']) || $_SESSION['is_user'] !== true) {
    header("Location: LoginPage.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_SESSION["username"];
    $page_id = $_POST['page_id'];
    $comment = $_POST['comment'];
    $page_id = mysqli_real_escape_string($conn, $page_id);
    $user = mysqli_real_escape_string($conn, $user);
    $comment = mysqli_real_escape_string($conn, $comment);
    $stmt = $conn->prepare("INSERT INTO comments (page_id, user_cmt, cmt) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $page_id, $user, $comment);
    if ($stmt->execute()) {
        echo "Comment added successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Error: Invalid request";
    exit;
}
