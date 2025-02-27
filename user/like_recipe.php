<?php
include '../config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["status" => "error", "message" => "Please log in first."]);
    exit;
}

$user_id = $_SESSION['user_id'];
$recipe_id = $_POST['recipe_id'];

// Check if the user has already liked the recipe
$query = $conn->query("SELECT * FROM  liked_recipes WHERE user_id = '$user_id' AND recipe_id = '$recipe_id'");

if ($query->num_rows > 0) {
    echo json_encode(["status" => "error", "message" => "already_liked"]);
    exit;
}

// Insert the like
$conn->query("INSERT INTO liked_recipes (user_id, recipe_id) VALUES ('$user_id', '$recipe_id')");

// Update the like count for the recipe
$conn->query("UPDATE recipes SET likes = likes + 1 WHERE id = '$recipe_id'");

// Fetch the new like count
$result = $conn->query("SELECT likes FROM recipes WHERE id = '$recipe_id'");
$row = $result->fetch_assoc();

echo json_encode(["status" => "success", "likes" => $row['likes']]);
?>
