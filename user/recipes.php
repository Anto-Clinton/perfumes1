<?php
include '../config.php';
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
    header("Location: ../login.php");
    exit;
}

// Fetch all recipes
$recipes = $conn->query("
    SELECT r.id, r.title, r.image, r.likes, c.name AS chef_name
    FROM recipes r
    JOIN users c ON r.chef_id = c.id
");

// Fetch user's saved recipes
$user_id = $_SESSION['user_id'];
$saved_query = $conn->query("SELECT recipe_id FROM saved_recipes WHERE user_id = '$user_id'");
$saved_recipes = [];
while ($row = $saved_query->fetch_assoc()) {
    $saved_recipes[] = $row['recipe_id'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Recipes -Al-Madina</title>
    <link rel="stylesheet" href="../assets/styles.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- jQuery for AJAX -->
</head>
<body>
    <header>
    <div class="nav-container">
        <h2>Al-Madina</h2>
        <nav>
            <a href="../index.php">Home</a>
            <a href="../about.php">About</a>
            <a href="../user/profile.php">Profile</a>
            <a href="../logout.php">Logout</a>
        </nav>
    </div>
</header>
    <div class="recipes-container">
        <h1>🍽 Discover Recipes</h1>
        <a href="profile.php" class="btn">👤 My Profile</a>
        <a href="../logout.php" class="btn logout">🚪 Logout</a>

        <div class="recipe-list">
            <?php while ($row = $recipes->fetch_assoc()): ?>
                <div class="recipe-card">
                    <img src="../uploads/<?= $row['image'] ?>" alt="<?= $row['title'] ?>">
                    <h3><?= $row['title'] ?></h3>
                    <p>By: <?= $row['chef_name'] ?></p>
                    <p>❤️ <span id="like-count-<?= $row['id'] ?>"><?= $row['likes'] ?></span> Likes</p>

                    <!-- Like Button -->
                    <button class="like-btn" data-id="<?= $row['id'] ?>">❤️ Like</button>

                    <!-- Save/Unsave Button -->
                    <?php if (in_array($row['id'], $saved_recipes)): ?>
                        <button class="save-btn saved" data-id="<?= $row['id'] ?>">✔ Saved</button>
                    <?php else: ?>
                        <button class="save-btn" data-id="<?= $row['id'] ?>">💾 Save</button>
                    <?php endif; ?>

                    <a href="recipe_details.php?id=<?= $row['id'] ?>" class="btn">📖 View</a>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <script>
$(document).ready(function() {
    // Like Button Click Event
    $(".like-btn").click(function() {
        var recipeId = $(this).data("id");
        $.post("like_recipe.php", { recipe_id: recipeId }, function(response) {
            var data = JSON.parse(response);
            if (data.status === "success") {
                $("#like-count-" + recipeId).text(data.likes);
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
