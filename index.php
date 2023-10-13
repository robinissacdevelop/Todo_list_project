<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
    <style>
        /* Body styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        /* Container styling */
        .container {
            background-color: #fff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
            padding: 20px;
            text-align: center;
            border-radius: 10px;
        }

        /* Heading styling */
        h1 {
            color: #333;
        }

        /* Sign Up link styling */
        a {
            text-decoration: none;
            background-color: #3498db;
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            display: inline-block;
            margin-top: 20px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        a:hover {
            background-color: #4CAF50;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to Your To-Do List</h1>
        <p>Organize your tasks and get things done</p>
        <a href="/todolistproject/view/signup.php">Sign Up</a>
    </div>
</body>
</html>
