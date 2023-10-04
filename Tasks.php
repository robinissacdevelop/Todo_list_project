<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>To-Do List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .task-list {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        input[type="text"] {
            flex-grow: 1;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            background-color: #333;
            color: #fff;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        li {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #f9f9f9;
            padding: 5px 10px;
            margin: 5px 0;
            border-radius: 5px;
        }

        li button {
            background-color: #e74c3c;
            color: #fff;
            border: none;
            padding: 3px 8px;
            border-radius: 3px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>To-Do List</h1>
        <div class="task-list">
            <input type="text" id="taskInput" placeholder="Add a new task">
            <button id="addTaskBtn">Add</button>
        </div>
        <ul id="taskList"></ul>
    </div>
    <script src="script.js"></script>
</body>

</html>