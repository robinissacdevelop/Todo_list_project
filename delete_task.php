<?php

require_once "/xampp/htdocs/todolistproject/Session.class.php";
require_once "/xampp/htdocs/todolistproject/Database.class.php";

// Start the session
Session::start();

// Connect to your database
$db = new Database();
$conn = $db->DB_connect();

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get the task ID from the AJAX request
$task_id = $_POST['id'];

// Get the user ID from the session
$username = $_SESSION['username'];
$sql = "SELECT id FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $username);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$user_id = $row['id'];

// Prepare a SQL query to delete the task with the provided task ID and user ID
$sql = "DELETE FROM tasks WHERE id = ? AND user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ii', $task_id, $user_id);

// Execute the prepared statement
if ($stmt->execute()) {
    echo json_encode(array('status' => 'success'));
} else {
    echo json_encode(array('status' => 'error', 'message' => 'Error deleting task'));
}

$stmt->close();
$conn->close();
?>


