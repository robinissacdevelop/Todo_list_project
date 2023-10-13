<?php
require_once "/xampp/htdocs/todolistproject/models/Session.class.php";

class Dashboard
{
    private $cookieName = "user";
    private $expireTime = 86400; // 24 hours in seconds

    public function __construct()
    {
        Session::start();
        if (!isset($_SESSION['token'])) {
            header('location: login.php');
            exit();
        }
        $this->setCookie();
    }

    private function setCookie()
    {
        $cookieValue = $_SESSION['username'];
        setcookie($this->cookieName, $cookieValue, time() + $this->expireTime, "/");
    }

    public function displayDashboard()
    {
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Dashboard</title>
            <style>
                body {
                    background-color: #f0f0f0;
                    font-family: Arial, sans-serif;
                    text-align: center;
                }

                h3 {
                    color: #333;
                }

                a {
                    display: block;
                    background-color: #3498db;
                    color: #fff;
                    padding: 10px 20px;
                    border-radius: 5px;
                    text-decoration: none;
                    margin-top: 20px;
                    width: fit-content;
                }

                a:hover {
                    background-color: #4CAF50;
                }
            </style>

        </head>

        <body>
            <h3>Welcome, user <?php echo htmlspecialchars($_SESSION['username']); ?></h3>
            <center><a href="/todolistproject/controler/task_list.php">click here see the tasks</a></center>
        </body>

        </html>
<?php
    }
}

$dashboard = new Dashboard();
$dashboard->displayDashboard();
?>