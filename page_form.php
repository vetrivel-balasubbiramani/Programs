<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
    <?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    $space_id = $_POST['space_id'];
    session_start();
    include 'DatabaseConnection.php';

    if (!isset($_SESSION['is_user']) || $_SESSION['is_user'] !== true) {
        header("Location: LoginPage.php");
        exit();
    }

    $user = $_SESSION['username'];
    ?>
    <div class="topnav">
        <a class="active" href="#"><?php echo "User: {$user}"; ?></a>
    </div>
    <div>
        <form action="editor.php" method="post">
            <input type="hidden" name="space_id" value="<?php echo $space_id; ?>">
            <div class="center">
            Title:<input type="text" name="page_title" style="width: 500px; margin-top: 20px;">
            </div>
            <br><br>
            <textarea id="full-featured" name="toolbox"> </textarea><br><br>
            <div class="center">
            <input type="submit" name="publish" value="publish" class="publish-button">
            </div>
        </form>
    </div>

</body>

</html>