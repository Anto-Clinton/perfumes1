<?php
$host = "127.0.0.1"; // Use "localhost" if 127.0.0.1 doesn't work
$user = "root";
$pass = "";
$dbname = "scentique_db";
$port = 3307; // Change to 3306 if MySQL is on default port

$conn = new mysqli($host, $user, $pass, $dbname, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Database connection successful!";
?>
