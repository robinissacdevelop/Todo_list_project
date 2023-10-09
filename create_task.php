<?php
require_once "/xampp/htdocs/todolistproject/Database.class.php";
require_once "/xampp/htdocs/todolistproject/Session.class.php";

Session::start();

$username = $_SESSION['username'];

// Connect to your database
$db = new Database();
$conn = $db->DB_connect();

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Prepare a SQL query to fetch the user id from the users table
$sql = "SELECT id FROM users WHERE username = ?";

// Prepare a statement
if ($stmt = mysqli_prepare($conn, $sql)) {
    // Bind variables to the prepared statement as parameters
    mysqli_stmt_bind_param($stmt, "s", $username);
    
    // Attempt to execute the prepared statement
    if (mysqli_stmt_execute($stmt)) {
        // Store result
        mysqli_stmt_store_result($stmt);
        
        // Check if a user with the given username exists
        if (mysqli_stmt_num_rows($stmt) == 1) {
            // Bind result variables
            mysqli_stmt_bind_result($stmt, $id);
            if (mysqli_stmt_fetch($stmt)) {
                // Now you can use $id
                echo "User ID: " . $id;
            }
        } else {
            echo "No user found with the username: " . $username;
        }
    } else {
        echo "Oops! Something went wrong. Please try again later.";
    }
    // Close statement
    mysqli_stmt_close($stmt);
}

// Create a class to handle task creation
class create_task {
    public function create($conn, $user_id) { // Pass the user ID as an argument
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Retrieve task details from the form
            $title = $_POST["title"];
            $description = $_POST["description"];
            $due_date = $_POST["due_date"];
            
            // Insert the task into the database with the associated user ID
            $sql = "INSERT INTO tasks (user_id, title, description, due_date) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            
            $stmt->bind_param('isss', $user_id, $title, $description, $due_date);
            
            // Execute the SQL statement
            if ($stmt->execute()) {
                // Task created successfully
                header("Location: task_list.php"); // Redirect to the task list page
                exit();
            } else {
                // Handle the error (e.g., display an error message)
                echo "Error creating task: " . $stmt->error;
            }
        }
    }
}

// Create an instance of the create_task class and call the create method, passing the user ID
$task_creator = new create_task();
$task_creator->create($conn, $id);

mysqli_close($conn);
?>
