<?php
session_start();
require_once 'DatabaseConnection.php';

if (!isset($_SESSION['is_user']) || $_SESSION['is_user'] !== true) {
    header("Location: LoginPage.php?message=You need to log in to access this page");
    exit();
}

$space_id = filter_input(INPUT_POST, 'space_id', FILTER_VALIDATE_INT);
if ($space_id === false || $space_id === null) {
    exit();
}

$user = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Form</title>
    <link rel="stylesheet" href="style/page_form.css">
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea'
        });
    </script>
    <script src="page_form.js"></script>
</head>

<body>
    <div class="topnav">
        <a class="active" href="#"><?php echo "User: {$user}"; ?></a>
    </div>
    <div>
        <form action="Editor.php" method="post">
            <input type="hidden" name="space_id" value="<?php echo $space_id; ?>">
            <div class="center">
                <label for="page_title">Title:</label>
                <input type="text" id="page_title" name="page_title" style="width: 500px; margin-top: 20px;" required>
            </div>
            <br><br>
            <textarea id="full-featured" name="toolbox"> </textarea><br><br>
            <div class="center">
                <input type="submit" name="publish" value="Publish" class="publish-button">
            </div>
        </form>
    </div>
</body>

</html>