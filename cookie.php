<?php
require_once "/xampp/htdocs/todolistproject/Session.class.php";

class Dashboard {
    private $cookieName = "user";
    private $expireTime = 86400; // 24 hours in seconds

    public function __construct() {
        Session::start();
        if (!isset($_SESSION['token'])) {
            header('location: login.php');
            exit();
        }
        $this->setCookie();
    }

    private function setCookie() {
        $cookieValue = $_SESSION['username'];
        setcookie($this->cookieName, $cookieValue, time() + $this->expireTime, "/");
    }

    public function displayDashboard() {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Dashboard</title>
        </head>
        <body>
            <h3>Welcome, user <?php echo htmlspecialchars($_SESSION['username']); ?></h3>
            <a href="task_list.php">click here see the tasks</a>
            <?php

            /*if (!isset($_COOKIE[$this->cookieName])) {
                echo "The cookie '" . htmlspecialchars($this->cookieName) . "' is not set.";
            } else {
                echo "Cookie '" . htmlspecialchars($this->cookieName) . "' is set!<br>";
                echo "Value is: " . htmlspecialchars($_SESSION['username']);
            }
            <a href="logout.php">Logout</a>
            */
            ?>
        </body>
        </html>
        <?php
    }
}

$dashboard = new Dashboard();
$dashboard->displayDashboard();
?>
