<?php
require_once "/xampp/htdocs/todolistproject/models/Session.class.php";
Session::start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Create New Task</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
        }

        input[type="text"],
        input[type="date"],
        textarea {
            width: 95%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        textarea {
            height: 100px;
        }

        input[type="submit"] {
            background: #007BFF;
            color: #fff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
        }

        input[type="submit"]:hover {
            background: #0056b3;
        }

        .task-container {
            position: relative;
            /* Other styling for your task container */
        }

        /* Style for the "Go Back" button */
        .go-back-button {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: #3498db;
            color: #fff;
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            
        }

        .go-back-button:hover {
            background-color: #4CAF50;
            /* Background color when hovered */
        }
    </style>
</head>

<body>
    <h2>Create a New Task <?php echo $_SESSION['username']; ?></h2>
    <form action="/todolistproject/controler/create_task.php" method="POST">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required><br><br>

        <label for="description">Description:</label>
        <textarea id="description" name="description"></textarea><br><br>

        <label for="due_date">Due Date:</label>
        <input type="date" id="due_date" name="due_date"><br><br>

        <input type="submit" value="Create Task">
        <button class="go-back-button">
            <a href="/todolistproject/controler/task_list.php" style="color: #fff; text-decoration: none;">Go Back</a>
        </button>
    </form>
</body>

</html>