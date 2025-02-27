<?php
$host = "127.0.0.1"; // Try "localhost" if this does not work
$user = "root";
$pass = "";
$dbname = "scentique_db";

$conn = new mysqli($host, $user, $pass, $dbname); // Remove port

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Database connection successful!";
?>
<h2>hi</h2>