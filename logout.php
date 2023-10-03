<?php
require_once "/xampp/htdocs/todolistproject/Session.class.php";
Session::start();
Session::unset();
Session::destroy();
header('location:/todolistproject/login.php');
?>