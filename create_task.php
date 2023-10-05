<?php
// Include database connection code here
require_once "/xampp/htdocs/todolistproject/Database.class.php";

// Create a new instance of the Database class and establish a connection
$db = new Database();
$conn = $db->DB_connect();

class create_task {
    public function create($conn) { // Pass the database connection as an argument
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Retrieve task details from the form
            $title = $_POST["title"];
            $description = $_POST["description"];
            $due_date = $_POST["due_date"];

            // Insert the task into the database
            $sql = "INSERT INTO tasks (user_id, title, description, due_date) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);

            // Replace $user_id with the actual user ID from the session or authentication
            $user_id = 1; // Change this to the actual user's ID

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

// Create an instance of the create_task class and call the create method
$task_creator = new create_task();
$task_creator->create($conn);
?>
