<?php

require_once "/xampp/htdocs/todolistproject/Database.class.php";
require_once "/xampp/htdocs/todolistproject/Session.class.php";

// Start the session to manage user authentication
Session::start();

// Check if the user is authenticated (you should have your own authentication logic)
var_dump($_SESSION['user_id']);

?>