<?php
require_once "/xampp/htdocs/todolistproject/Session.class.php";
Session::start();
Session::unset();
Session::destroy();
// Clear the user ID cookie


header('location:/todolistproject/login.php');
?>