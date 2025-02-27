<?php
include '../config.php';
session_start();

if (!isset($_SESSION['user_id']) || !isset($_POST['recipe_id'])) {
    echo "Error: Missing user ID or recipe ID.";
    exit();
}

$user_id = $_SESSION['user_id'];
$recipe_id = $_POST['recipe_id'];

// SQL query to delete the saved recipe
$query = "DELETE FROM saved_recipes WHERE user_id = ? AND recipe_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ii", $user_id, $recipe_id);

if ($stmt->execute()) {
    echo "success";
} else {
    echo "Error unsaving recipe.";
}
?>
