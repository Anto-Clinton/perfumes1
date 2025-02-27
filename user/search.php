<?php
include '../config.php';
session_start();
$search = $_GET['query'] ?? '';

$sql = "SELECT r.id, r.title, r.image, r.ingredients, r.instructions, u.name AS chef_name
        FROM recipes r
        JOIN users u ON r.chef_id = u.id
        WHERE r.title LIKE '%$search%' OR r.ingredients LIKE '%$search%'";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title> Al-Madina</title>
</head>
<body>
    <h2>Search Results for '<?= htmlspecialchars($search) ?>'</h2>
    <form method="GET">
        <input type="text" name="query" placeholder="Search recipes..." value="<?= htmlspecialchars($search) ?>" required>
        <button type="submit">Search</button>
    </form>
    <?php while ($row = $result->fetch_assoc()): ?>
        <div>
            <h3><?= $row['title'] ?></h3>
            <p>By: <?= $row['chef_name'] ?></p>
            <img src="../uploads/<?= $row['image'] ?>" width="200"><br>
            <p><strong>Ingredients:</strong> <?= $row['ingredients'] ?></p>
            <p><strong>Instructions:</strong> <?= $row['instructions'] ?></p>
        </div>
    <?php endwhile; ?>
</body>
</html>
