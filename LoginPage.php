<?php
session_start();
require_once 'DatabaseConnection.php';

class LoginPage
{
    private $conn;
    private $error_message = "";

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function sanitizeInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    public function handleLogin()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $user = $this->sanitizeInput($_POST["user"]);
            $password = $_POST["password"];
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE BINARY username=?");
            $stmt->bind_param("s", $user);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows === 1) {
                $row = $result->fetch_assoc();
                $hashed_password = $row["password"];
                if (password_verify($password, $hashed_password)) {
                    $_SESSION['is_user'] = true;
                    $_SESSION["username"] = $user;
                    header("Location: UserPage.php");
                    exit();
                } else {
                    $this->error_message = "Invalid username or password. Please try again.";
                }
            } else {
                $this->error_message = "Invalid username or password. Please try again.";
            }

            $stmt->close();
        }
    }

    public function getErrorMessage()
    {
        return $this->error_message;
    }
}

$userLogin = new LoginPage($conn);
$userLogin->handleLogin();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style/LoginPage.css">
    <script>
        window.onload = function() {
            var errorMessage = "<?php echo $userLogin->getErrorMessage(); ?>";
            if (errorMessage !== "") {
                document.getElementById("error-message").textContent = errorMessage;
            }
        }
    </script>
</head>

<body>
    <div class="login-container">
        <h2 class="login-title">Login</h2>
        <form class="login-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label class="login-label" for="user">Username:</label>
            <input class="login-input" type="text" id="user" name="user" required>
            <label class="login-label" for="password">Password:</label>
            <input class="login-input" type="password" id="password" name="password" required>
            <div id="error-message" style="color: red;"></div>
            <input class="login-button" type="submit" value="Login">
        </form>
    </div>
</body>

</html>