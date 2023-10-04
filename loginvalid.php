<?php
require_once "/xampp/htdocs/todolistproject/Database.class.php"; // Import the Database class
require_once "/xampp/htdocs/todolistproject/Session.class.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);
Session::start();

class login {
    private $conn;
    
    public function __construct() {
        $db = new Database();
        $this->conn = $db->DB_connect();
    }
    
    public function userLogin() { // Renamed the method to userLogin
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Getting user details
            $user = $_POST['name'];
            $pass = $_POST['password'];
        
            // Prepare and bind
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE username = ?");
            $stmt->bind_param("s", $user);
            // Execute the query
            $stmt->execute();
        
            // Get the result
            $result = $stmt->get_result();
        
            if ($result->num_rows == 1) {
                $row = $result->fetch_assoc();
                $hashedPassword = $row['password'];
                // Verify the entered password using password_verify
                if (password_verify($pass, $hashedPassword)) {
                    // Password is correct
                    // Generate a unique token
                    $token = bin2hex(random_bytes(32)); // Generate a random token
                    // Store the token in the database
                    $userId = $row['id'];
                    $this->storeTokenInDatabase($userId, $token);
                    // Set the token in a cookie or session
                    $_SESSION['token'] = $token;
                    $_SESSION['username'] = $user;
                    header("location: cookie.php");
                    exit(); // Added exit to prevent further execution
                } else {
                    // Password is incorrect
                    echo "Login failed <a href='login.php'>Login again</a>";
                }
            } else {
                // User does not exist
                echo "User does not exist <a href='login.php'>Login again</a>";
            }
            $stmt->close();
        }
    }

    private function storeTokenInDatabase($userId, $token) {
        // Store the token in the database for the user
        $stmt = $this->conn->prepare("INSERT INTO sessions (user_id, token) VALUES (?, ?)");
        $stmt->bind_param("ss", $userId, $token);
        $stmt->execute();
        $stmt->close();
    }
}

$login = new login();
$login->userLogin(); // Call the userLogin method
?>
