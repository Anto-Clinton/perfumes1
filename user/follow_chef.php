<?php
include '../config.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    echo "Login required";
    exit;
}

$user_id = $_SESSION['user_id'];
$chef_id = $_GET['chef_id'];

$conn->query("INSERT INTO follows (user_id, chef_id) VALUES ('$user_id', '$chef_id')");
header("Location: profile.php");
?>
