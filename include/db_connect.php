<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');

$connect=mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
// Check connection
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

?>
