<?php
include '../config.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Get all chefs
$chefs = $conn->query("SELECT id, name FROM users WHERE role = 'chef'");

// Get followed chefs
$followed_chefs = [];
$result = $conn->query("SELECT chef_id FROM follows WHERE user_id = '$user_id'");
while ($row = $result->fetch_assoc()) {
    $followed_chefs[] = $row['chef_id'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title> Al-Madina</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <h2>Chefs</h2>
    <ul>
        <?php while ($row = $chefs->fetch_assoc()): ?>
            <li>
                <?= $row['name'] ?>
                <?php if (!in_array($row['id'], $followed_chefs)): ?>
                    <a href="follow_chef.php?chef_id=<?= $row['id'] ?>">Follow</a>
                <?php else: ?>
                    <span>Following</span>
                <?php endif; ?>
            </li>
        <?php endwhile; ?>
    </ul>

    <a href="profile.php">Back to Profile</a>
</body>
</html>
