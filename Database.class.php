<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

class Database {
    
    // User details
    public $ID;
    public $username;
    public $password;
    public $email;

    public static function DB_connect(){
        $conn = mysqli_connect("localhost", "root", "", "todo_db");
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        //echo "Connected ";
        return $conn;
    }
    
}
Database::DB_connect();

?>