document.addEventListener("DOMContentLoaded", function() {
    const taskInput = document.getElementById("taskInput");
    const addTaskBtn = document.getElementById("addTaskBtn");
    const taskList = document.getElementById("taskList");

    // Function to add a new task
    function addTask() {
        const taskText = taskInput.value.trim();
        if (taskText !== "") {
            const listItem = document.createElement("li");
            listItem.innerHTML = `
                ${taskText}
                <button class="deleteBtn">Delete</button>
            `;
            taskList.appendChild(listItem);
            taskInput.value = "";
        }
    }

    // Function to remove a task
    function removeTask(event) {
        if (event.target.classList.contains("deleteBtn")) {
            event.target.parentElement.remove();
        }
    }

    // Event listeners
    addTaskBtn.addEventListener("click", addTask);
    taskList.addEventListener("click", removeTask);
    taskInput.addEventListener("keypress", function(event) {
        if (event.key === "Enter") {
            addTask();
        }
    });
});
