<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

class SubpageForm
{
    private $pageId;
    private $user;

    public function __construct($pageId, $user)
    {
        $this->pageId = $pageId;
        $this->user = $user;
    }

    public function redirectToLoginPage()
    {
        if (!isset($_SESSION['is_user']) || $_SESSION['is_user'] !== true) {
            header("Location: LoginPage.php");
            exit();
        }
    }

    public function renderTopnav()
    {
        return '<div class="topnav">
                    <a class="active" href="#">' . "User: {$this->user}" . '</a>
                </div>';
    }

    public function renderForm()
    {
        return '<form action="SubpageEditor.php" method="post">
                    <input type="hidden" name="page_id" value="' . $this->pageId . '">
                    <div class="center">
                        Title:<input type="text" name="page_title" style="width: 500px; margin-top: 20px;">
                    </div>
                    <br><br>
                    <textarea id="full-featured" name="toolbox"> </textarea><br><br>
                    <div class="center">
                        <input type="submit" name="publish" value="publish" class="publish-button">
                    </div>
                </form>';
    }
}

session_start();
include 'DatabaseConnection.php';

$pageId = $_GET['page_id'];
$user = $_SESSION['username'];

$subpageForm = new SubpageForm($pageId, $user);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subpage Form</title>
    <link rel="stylesheet" href="style/subpage_form.css">
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
    $subpageForm->redirectToLoginPage();
    echo $subpageForm->renderTopnav();
    echo '<div>' . $subpageForm->renderForm() . '</div>';
    ?>
</body>

</html>