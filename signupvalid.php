
<?php
require_once '/xampp/htdocs/todolistproject/Database.class.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

class signup
{
    public $nameErr;
    public $emailErr;
    public $passwordErr;
    private $conn;

    public function __construct()
    {
        // Create a new Database object and establish the database connection
        $db = new Database();
        $this->conn = $db->DB_connect();
    }

    public function newuservalidate($username, $email, $password)
    {
        // Validate username
        if (!preg_match('/^[A-Za-z0-9]+$/', $username)) {
            $this->nameErr = "Only alphabets and numbers are allowed as a username. Please sign up again.";
        }

        // Validate password
        if (!$this->isStrongPassword($password)) {
            // Display a message about a weak password but continue with the database insertion
            echo "Password is weak. Recommended to use a stronger password for security.";
        } else {
            echo "Password is strong";
        }

        if (!empty($this->nameErr)) {
            // Display error message and a link to sign up again
            echo $this->nameErr . "<br>";
            echo "<a href='signup.php'>Sign up again</a>";
        } else {
            // Hash the password for security
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Check if the username or email already exists in the database
            $sql = "SELECT * FROM users WHERE username ='$username' OR email='$email'";
            $result = $this->conn->query($sql);

            if ($result->num_rows > 0) {
                echo "Username or email already exists. Please choose a different username or email.";
            } else {
                // Insert the user's data into the database
                $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashedPassword')";

                if ($this->conn->query($sql) === TRUE) {
                    echo "New record created successfully. <a href='/todolistproject/login.php'>Now login here</a>";
                } else {
                    echo "Error: " . $sql . "<br>" . $this->conn->error;
                }
            }
        }

        // Close the database connection
        $this->conn->close();
    }

    private function isStrongPassword($password)
    {
        // Define the regular expression pattern for a strong password
        $pattern = '/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/';

        // Use preg_match to check if the password matches the pattern
        return preg_match($pattern, $password);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $signup = new Signup();
    $username = $_POST['name'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $signup->newuservalidate($username, $email, $password);
}
?>
