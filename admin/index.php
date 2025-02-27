<?php
include '../config.php';
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

$user_count = $conn->query("SELECT COUNT(*) FROM users WHERE role='user'")->fetch_row()[0];
$chef_count = $conn->query("SELECT COUNT(*) FROM users WHERE role='chef'")->fetch_row()[0];
$recipe_count = $conn->query("SELECT COUNT(*) FROM recipes")->fetch_row()[0];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Dashboard - Cookify</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <h2>Admin Dashboard</h2>
    <p>Users: <?= $user_count ?></p>
    <p>Chefs: <?= $chef_count ?></p>
    <p>Recipes: <?= $recipe_count ?></p>
    <a href="manage_users.php">Manage Users</a> | 
    <a href="manage_chefs.php">Manage Chefs</a> | 
    <a href="manage_recipes.php">Manage Recipes</a>
</body>
</html>
