<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
require_once 'DatabaseConnection.php';

function redirectToLoginPage()
{
    if (!isset($_SESSION['is_user']) || $_SESSION['is_user'] !== true) {
        header("Location: LoginPage.php");
        exit();
    }
}

function getPageDetails($conn)
{
    $pageDetails = [];
    if ($_SERVER["REQUEST_METHOD"] === "GET") {
        $user = $_SESSION["username"];
        $page_id = $_GET['sub_page_id'];
        $space_id = $_GET['space_id'];
        $sub_id = $_GET['sub_id'];

        if (isset($_GET['space_id'])) {
            $sql = "SELECT * FROM pages WHERE page_id='$page_id'";
            $result = $conn->query($sql);

            if ($result->num_rows === 1) {
                $row = $result->fetch_assoc();
                $pageDetails['page_title'] = $row["title"];
                $pageDetails['content'] = $row["content"];
            } else {
                $pageDetails['error'] = "Page not found.";
            }
        } else {
            $pageDetails['error'] = "Error: Invalid request";
        }
    }
    return $pageDetails;
}

redirectToLoginPage();

$pageDetails = getPageDetails($conn);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageDetails['page_title'] ?? ''; ?></title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
</head>

<body>
    <div>
        <?php
        if (isset($pageDetails['error'])) {
            echo $pageDetails['error'];
            exit;
        }
        ?>
        <div>
            <h2><?= $pageDetails['page_title'] ?? ''; ?></h2>
            <div><?= $pageDetails['content'] ?? ''; ?></div>
        </div>
        <br><br><br><br><br>
        <div>
            Comment section:
            <form method="post">
                <input type="hidden" id="hid-val1" name="page_id" value="<?= $_GET['sub_page_id'] ?? ''; ?>">
                <input type="hidden" id="hid-val2" name="page_id" value="<?= $_GET['space_id'] ?? ''; ?>">
                <input type="hidden" id="hid-val3" name="page_id" value="<?= $_GET['sub_id'] ?? ''; ?>">
                <input type="text" id="input-val" name="comment" required><br><br>
                <input type="button" id="btn-click" name="submit" value="Add Comment"><br><br>
            </form>
        </div>
    </div>

    <?php
    $sql = "SELECT * FROM comments where page_id='{$_GET['sub_page_id']}'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $user_cmt = $row['user_cmt'];
            $cmt = $row['cmt'];

            echo "<h3>$user_cmt : $cmt</h3><br/>";
            echo "<hr>";
        }
    }
    ?>

    <script>
        $(document).ready(function() {
            $("#btn-click").click(function() {
                var inputValue1 = $("#hid-val1").val();
                var inputValue2 = $("#input-val").val();
                var inputValue3 = $("#hid-val2").val();
                var inputValue4 = $("#hid-val3").val();
                $.ajax({
                    type: "POST",
                    url: "UserComment.php",
                    data: {
                        page_id: inputValue1,
                        comment: inputValue2
                    },
                    success: function(response) {
                        getContent1(inputValue3, inputValue1, inputValue4);
                    }
                });
            });
        });
    </script>
</body>

</html>