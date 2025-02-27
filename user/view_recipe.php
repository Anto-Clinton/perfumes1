<?php
include '../config.php';
session_start();

if (!isset($_GET['id'])) {
    echo "Recipe not found!";
    exit();
}

$recipe_id = intval($_GET['id']);
$user_id = $_SESSION['user_id'] ?? null;

// Fetch recipe details
$query = "SELECT * FROM recipes WHERE id = '$recipe_id'";
$result = $conn->query($query);
$recipe = $result->fetch_assoc();

if (!$recipe) {
    echo "Recipe not found!";
    exit();
}

// Check if user has liked the recipe
$liked_query = "SELECT * FROM likes WHERE user_id = '$user_id' AND recipe_id = '$recipe_id'";
$liked_result = $conn->query($liked_query);
$is_liked = $liked_result->num_rows > 0;

// Check if user has saved the recipe
$saved_query = "SELECT * FROM saved_recipes WHERE user_id = '$user_id' AND recipe_id = '$recipe_id'";
$saved_result = $conn->query($saved_query);
$is_saved = $saved_result->num_rows > 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $recipe['title'] ?></title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>

<div class="recipe-detail-container">
    <h2><?= $recipe['title'] ?></h2>
    <img src="../uploads/<?= $recipe['image'] ?>" alt="<?= $recipe['title'] ?>">
    
    <h3>Ingredients</h3>
    <p><?= nl2br($recipe['ingredients']) ?></p>
    
    <h3>Instructions</h3>
    <p><?= nl2br($recipe['instructions']) ?></p>

   
    <!-- Back Button -->
    <a href="javascript:history.back()" class="btn">⬅ Back to Recipes</a>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


<style>
.recipe-detail-container {
    width: 60%;
    margin: auto;
    text-align: center;
    padding: 20px;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
}

.recipe-detail-container img {
    width: 100%;
    max-height: 400px;
    object-fit: cover;
    border-radius: 10px;
}

.btn {
    margin: 10px;
    padding: 10px 20px;
    background-color: #28a745;
    color: #fff;
    border-radius: 5px;
    cursor: pointer;
    text-decoration: none;
}

.btn:disabled {
    background-color: #aaa;
}

.like-btn {
    background-color: #007bff;
}

.save-btn {
    background-color: #ffc107;
}

.btn:hover {
    opacity: 0.8;
}
</style>

</body>
</html>
