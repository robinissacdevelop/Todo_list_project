<?php
require_once "/xampp/htdocs/todolistproject/models/Database.class.php";
require_once "/xampp/htdocs/todolistproject/models/Session.class.php";

// Start the session
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
            mysqli_stmt_bind_result($stmt, $user_id);
            if (mysqli_stmt_fetch($stmt)) {
                // Now you can use $user_id
                //echo "User ID: " . $user_id;
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

// Query to retrieve tasks for the user using $user_id
$sql = "SELECT id, title, description, due_date FROM tasks WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>To-Do List</title>
    <style>
        <!-- Add this style block in the head section of your HTML -- >
    /* Style for the task list container */
    .container {
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
    }

    /* Style for the headings */
    h2, h4 {
        text-align: center;
        color: #333;
    }

    /* Style for the Add button */
    #addTaskBtn {
        background-color: #333;
        color: #fff;
        border: none;
        padding: 8px 15px;
        border-radius: 5px;
        cursor: pointer;
        display: block;
        margin: 0 auto;
    }

    /* Style for the task list */
    #taskList {
        list-style: none;
        padding: 0;
    }

    /* Style for individual task items */
    #taskList li {
        background-color: #f4f4f4;
        margin-bottom: 10px;
        padding: 10px;
        border-radius: 5px;
        box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.2);
    }

    /* Style for task titles */
    #taskList li h3 {
        margin: 0;
        color: #333;
    }

    /* Style for task descriptions */
    #taskList li p {
        margin: 0;
        color: #777;
    }

    /* Style for due dates */
    #taskList li .due-date {
        font-style: italic;
        color: #999;
    }
    .completed-button {
            background-color: #3498db; /* Initial color (blue) */
            color: #fff;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .completed-button.completed {
            background-color: #4CAF50; /* Completed color (green) */
        }
    </style>
</head>

<body>
    <div class="container">
        <center>
            <h2>Welcome <?php echo $_SESSION['username']; ?></h2>
        </center>
        <center>
            <h4>To-Do List</h4>
        </center>
        <div class="task-list">
            <a href="/todolistproject/view/tasks.php" style="display: block; margin:0 auto; text-decoration:none;"><button id="addTaskBtn">Add</button></a>
        </div>
        <ul id="taskList">
            <?php
            while ($row = $result->fetch_assoc()) {
                echo "<li>";
                echo "Title: " . $row['title'] . "<br>";
                echo "Description: " . $row['description'] . "<br>";
                echo "Due Date: " . $row['due_date'] . "<br>";
                echo "<button style='background-color: #ff0000; color: #fff; border: none; padding: 8px 15px; border-radius: 5px; cursor: pointer;'><a href='?del_task=" . $row['id'] . "' style='text-decoration: none; color: #fff;'>Delete</a></button>";
                //echo "<button><a href='?del_task=" . $row['id'] . "'>Delete</a></button>";
                echo '<button class="completed-button" id="completeButton" onclick="markCompleted()">Task Completed</button>';
                echo "</li>";
            }
            if (isset($_GET['del_task'])) {
                $id = $_GET['del_task'];
                $delete_stmt = $conn->prepare("DELETE FROM tasks WHERE id = ?");
                $delete_stmt->bind_param("i", $id);
                if ($delete_stmt->execute()) {
                    // Task deleted successfully
                    header("Location: task_list.php"); // Redirect to the same page or desired page
                } else {
                    echo "Error deleting task: " . $delete_stmt->error;
                }
            }
            ?>
        </ul>
    </div>
    <script>
        // JavaScript function to toggle the "completed" class
        function markCompleted() {
            const button = document.getElementById('completeButton');
            button.classList.toggle('completed');
        }
    </script>
    <a href="/todolistproject/controler/logout.php">logout</a>
</body>

</html>
<?php
$stmt->close();
$conn->close();
?>