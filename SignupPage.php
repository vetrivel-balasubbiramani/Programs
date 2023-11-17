<?php
require_once 'DatabaseConnection.php';
class SignupPage
{
    private $conn;
    private $error_message = "";
    private $success_message = "";
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
    public function handleSignup()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["Login"])) {
                header("Location: LoginPage.php");
                exit;
            }
            $username = $this->sanitizeInput($_POST["username"]);
            $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
            $cnfpassword = password_hash($_POST["cnfpassword"], PASSWORD_DEFAULT);

            if ($_POST["password"] !== $_POST["cnfpassword"]) {
                $this->error_message = "Passwords do not match. Please re-enter the passwords.";
            } else {
                $sql = "INSERT INTO users (username, password, cnfpassword) VALUES ('$username', '$password', '$cnfpassword')";

                if ($this->conn->query($sql) === TRUE) {
                    $this->success_message = "Registration successful!";
                    $this->error_message = "";
                } else {
                    $this->error_message = "Error: " . $sql . "<br>" . $this->conn->error;
                }
            }
        }
    }

    public function getErrorMessage()
    {
        return $this->error_message;
    }

    public function getSuccessMessage()
    {
        return $this->success_message;
    }
}
$signupPage = new SignupPage($conn);
$signupPage->handleSignup();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Signup Page</title>
    <link rel="stylesheet" href="style/signupPage.css">
    <script>
        window.onload = function() {
            var errorMessage = "<?php echo $signupPage->getErrorMessage(); ?>";
            var successMessage = "<?php echo $signupPage->getSuccessMessage(); ?>";
            if (errorMessage !== "") {
                document.getElementById("error-message").textContent = errorMessage;
            }
            if (successMessage !== "") {
                document.getElementById("success-message").textContent = successMessage;
                setTimeout(function() {
                    window.location.href = "LoginPage.php";
                }, 1000); 
            }
        };
    </script>
</head>

<body>
    <div class="form-container">
        <h2 class="form-title">Signup</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label class="form-label" for="username">Username:</label>
            <input class="form-input" type="text" id="username" name="username" required>
            <label class="form-label" for="password">Password:</label>
            <input class="form-input" type="password" id="password" name="password" required>
            <label class="form-label" for="cnfpassword">Confirm Password:</label>
            <input class="form-input" type="password" id="cnfpassword" name="cnfpassword" required>
            <div id="error-message" style="color: red;"></div>
            <div id="success-message" style="color: green;"></div>
            <div class="form-buttons">
                <input class="form-button" type="submit" value="Sign Up">
                <a class="login-link" href="LoginPage.php">Already have an account? Login</a>
            </div>
        </form>
        <form action="AdminLogin.php">
            <label class="form-label">Admin Login:</label>
            <input class="form-button" type="submit" value="Admin Login" name="AdminLogin">
        </form>
    </div>
</body>

</html>