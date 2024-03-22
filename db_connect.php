<?php
$servername = "localhost"; // Change this if your MySQL server is running on a different host
$username = "stha"; // Change this if you're using a different MySQL username
$password = "admin1234"; // Change this if you've set a password for your MySQL server
$database = "meeting_room_booking"; // Change this if your database name is different

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>


<!-- define('ROOT_URL','https://localhost/blog/');
define('DB_HOST','localhost');
define('DB_USER','stha');
define('DB_PASS','admin1234');
define('DB_NAME','blog'); -->