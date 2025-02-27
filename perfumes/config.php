<?php
$host = "localhost";  // Change to "127.0.0.1" if localhost does not work
$user = "root";
$pass = "";
$dbname = "scentique_db";
$port = 3307;  // Change to 3306 if MySQL is using the default port

// Create connection
$conn = new mysqli($host, $user, $pass, $dbname, $port);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
