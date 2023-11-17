<?php
class UserSpaceDetails
{
    private $conn;
    private $user;
    private $space_id;
    private $space_name;
    private $space_description;
    private $pages = array();
    private $subpages = array();

    public function __construct($conn)
    {
        $this->conn = $conn;
        $this->user = $_SESSION['username'];
        $this->fetchSpaceDetails();
    }

    public function redirectToLoginPage()
    {
        if (!isset($_SESSION['is_user']) || $_SESSION['is_user'] !== true) {
            header("Location: LoginPage.php");
            exit();
        }
    }

    public function fetchSpaceDetails()
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
            $this->space_id = $_GET['id'];
            $sql = "SELECT * FROM spaces WHERE space_id='$this->space_id'";
            $result = $this->conn->query($sql);
            if ($result->num_rows === 1) {
                $row = $result->fetch_assoc();
                $this->space_name = $row["space_name"];
                $this->space_description = $row["description"];
            } else {
                return "Space not found.";
            }

            $sql = "SELECT * FROM pages where space_id='$this->space_id'";
            $result = $this->conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $page_id = $row["page_id"];
                    $title = $row["title"];
                    $this->pages[] = array("id" => $page_id, "title" => $title);
                }
            }

            $sql = "SELECT * FROM subpages";
            $result = $this->conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $sub_page_id = $row["page_id"];
                    $sub_title = $row["title"];
                    $sub_id = $row['sub_id'];
                    $this->subpages[] = array("sub_id" => $sub_id, "sub_title" => $sub_title, "sub_page_id" => $sub_page_id);
                }
            }
        } else {
            return "Invalid request.";
        }
    }

    public function renderTopnav()
    {
        return '<div class="topnav">
                <a class="active" href="#">' . "User: {$this->user}" . '</a>
            </div>';
    }

    public function renderTitle()
    {
        $space_id = $this->space_id;
        return '<div class="title">
                <h3>Space name: ' . $this->space_name . '</h3>
                <h3>Description: ' . $this->space_description . '</h3>
                <form action="PageForm.php" method="post">
                    <input type="hidden" name="space_id" value="' . $space_id . '">
                    <input type="submit" value="Create page" name="page">
                </form>
            </div>';
    }

    public function renderPagesAndSubpages()
    {
        $html = '<div class="container" style="margin-top: 100px;">
                <div>';

        $html .= '<h1>Page list:</h1><br>';

        if (!empty($this->pages)) {
            foreach ($this->pages as $page) {
                $page_id = $page["id"];
                $title = $page["title"];
                $html .= '<div class="page-entry">';
                $html .= '<h2 class="page-link" onclick="getContent1(' . $this->space_id . "," . $page_id . "," . $page_id . ')">' . $title . '</h2>';
                $html .= '<button class="add-subpage-button" title="Add Subpage" onclick="goToSubpageForm(' . $page_id . ')">+</button>';
                $html .= '</div>';
                foreach ($this->subpages as $subpage) {
                    $sub_id = $subpage["sub_id"];
                    $sub_title = $subpage["sub_title"];
                    $sub_page_id = $subpage["sub_page_id"];
                    if ($subpage["sub_page_id"] == $page_id) {
                        $html .= '<h2 class="subpage-link" onclick="getContent(' . $this->space_id . "," . $sub_page_id . "," . $sub_id . ')">' . $sub_title . '</h2>';
                    }
                }
            }
        } else {
            $html .= "No pages found.";
        }

        $html .= '</div></div>';
        return $html;
    }

    public function renderLogoutButton()
    {
        return '<div class="log-div">
                <button id="Logout-btn" onclick="goBack()">Back</button>
            </div>';
    }

    public function renderResultContainer()
    {
        return '<div id="result"></div>';
    }
}

session_start();
include 'DatabaseConnection.php';
$userSpaceDetails = new UserSpaceDetails($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style/User_space_details.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="user_space_details.js"></script>
</head>

<body>
    <?php
    $userSpaceDetails->redirectToLoginPage();
    echo $userSpaceDetails->renderTopnav();
    echo $userSpaceDetails->renderTitle();
    echo $userSpaceDetails->renderPagesAndSubpages();
    echo $userSpaceDetails->renderLogoutButton();
    echo $userSpaceDetails->renderResultContainer();
    ?>
</body>

</html>