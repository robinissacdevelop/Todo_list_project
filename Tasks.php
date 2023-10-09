<!DOCTYPE html>
<html>
<head>
    <title>Create New Task</title>
</head>
<body>
    <h2>Create a New Task</h2>
    <form action="create_task.php" method="POST">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required><br><br>
        
        <label for="description">Description:</label>
        <textarea id="description" name="description"></textarea><br><br>
        
        <label for="due_date">Due Date:</label>
        <input type="date" id="due_date" name="due_date"><br><br>
        
        <input type="submit" value="Create Task">
    </form>
</body>
</html>