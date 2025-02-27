<?php
include '../config.php'; // Include database configuration file
session_start(); // Start the session to manage user authentication

if (!isset($_GET['id'])) {
    header("Location: recipes.php"); // Redirect to recipes page if no recipe ID is provided
    exit;
}

$recipe_id = $_GET['id']; // Get the recipe ID from the URL

// Fetch recipe details from the database using the recipe ID
$query = $conn->query("
    SELECT r.id, r.title, r.image, r.likes, r.ingredients, r.instructions, c.email AS chef_email
    FROM recipes r
    JOIN users c ON r.chef_id = c.id
    WHERE r.id = '$recipe_id'
");
$recipe = $query->fetch_assoc(); // Get the recipe details as an associative array
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Details - <?= $recipe['title'] ?> - Cookify</title>
    <link rel="stylesheet" href="../assets/styles.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .recipe-details-container {
            width: 80%;
            max-width: 900px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 2.5em;
            color: #333;
            margin-bottom: 10px;
        }

        img {
            width: 100%;
            max-height: 400px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        p {
            font-size: 1.1em;
            line-height: 1.6;
            color: #555;
        }

        h2 {
            font-size: 1.5em;
            margin-top: 20px;
            color: #333;
        }

        .like-btn, .save-btn {
            background-color: #ff6f61;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 1em;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 20px;
        }

        .like-btn:hover, .save-btn:hover {
            background-color: #e55b50;
        }

        .saved {
            background-color: #4caf50;
        }

        .btn {
            display: inline-block;
            text-decoration: none;
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            margin-top: 20px;
            font-size: 1.1em;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        .recipe-details-container a {
            display: inline-block;
            text-decoration: none;
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            margin-top: 20px;
            font-size: 1.1em;
            text-align: center;
        }

        .recipe-details-container a:hover {
            background-color: #0056b3;
        }

    </style>
</head>
<body>
    <div class="recipe-details-container">
        <h1>🍽 <?= $recipe['title'] ?></h1>
        <img src="../uploads/<?= $recipe['image'] ?>" alt="<?= $recipe['title'] ?>">
        <p>By: <?= $recipe['chef_email'] ?></p>
        <p>❤️ <?= $recipe['likes'] ?> Likes</p>
        <h2>Ingredients:</h2>
        <p><?= nl2br($recipe['ingredients']) ?></p>
        <h2>Instructions:</h2>
        <p><?= nl2br($recipe['instructions']) ?></p>

        <!-- Like Button -->
        <button class="like-btn" data-id="<?= $recipe['id'] ?>">❤️ Like</button>

        <!-- Save/Unsave Button -->
        <button class="save-btn" data-id="<?= $recipe['id'] ?>">💾 Save</button>

        <a href="recipes.php" class="btn">👈 Back to Recipes</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        // Like Button Click Event
        $(".like-btn").click(function() {
            var recipeId = $(this).data("id");
            $.post("like_recipe.php", { recipe_id: recipeId }, function(response) {
                var data = JSON.parse(response);
                if (data.status === "success") {
                    alert("Recipe liked successfully!");
                    location.reload(); // Refresh the page to update likes
                } else {
                    alert(data.message);
                }
            });
        });

        // Save/Unsave Button Click Event
        $(".save-btn").click(function() {
            var recipeId = $(this).data("id");
            var button = $(this);
            $.post("save_recipe.php", { recipe_id: recipeId }, function(response) {
                if (response === "saved") {
                    button.text("✔ Saved").addClass("saved");
                } else if (response === "unsaved") {
                    button.text("💾 Save").removeClass("saved");
                }
            });
        });
    });
    </script>
</body>
</html>
