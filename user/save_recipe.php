<?php
include '../config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    echo "error";
    exit;
}

$user_id = $_SESSION['user_id'];
$recipe_id = $_POST['recipe_id'];

// Check if the recipe is already saved
$check = $conn->query("SELECT * FROM saved_recipes WHERE user_id = '$user_id' AND recipe_id = '$recipe_id'");

if ($check->num_rows > 0) {
    // Unsave Recipe
    $conn->query("DELETE FROM saved_recipes WHERE user_id = '$user_id' AND recipe_id = '$recipe_id'");
    echo "unsaved";
} else {
    // Save Recipe
    $conn->query("INSERT INTO saved_recipes (user_id, recipe_id) VALUES ('$user_id', '$recipe_id')");
    echo "saved";
}
?>
