<?php
include 'config.php';
session_start();

// Fetch all products from the database
$query = "SELECT * FROM products ORDER BY created_at DESC";
$result = $conn->query($query);
if (!$result) {
    die("Query error: " . $conn->error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Al-Madina - Shop</title>
  <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/styles.css">
  <style>
    /* Basic styling for the shop page */
    body {
      font-family: 'Barlow', sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f8f8f8;
      color: #333;
    }
    header {
      background: #333;
      padding: 15px 0;
      color: #fff;
      text-align: center;
    }
    .nav-container {
      width: 80%;
      margin: auto;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .nav-container nav a {
      color: #fff;
      margin: 0 10px;
      text-decoration: none;
    }
    .nav-container nav a:hover {
      text-decoration: underline;
    }
    .shop-container {
      width: 80%;
      margin: 20px auto;
      padding: 20px;
      background: #fff;
      border-radius: 8px;
      box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    }
    .products-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
      gap: 20px;
    }
    .product-card {
      background: #fff;
      border: 1px solid #ddd;
      border-radius: 8px;
      overflow: hidden;
      text-align: center;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .product-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 16px rgba(0,0,0,0.15);
    }
    .product-card img {
      width: 100%;
      height: 300px;
      object-fit: cover;
    }
    .product-details {
      padding: 15px;
    }
    .product-title {
      font-size: 1.3em;
      margin: 10px 0;
      color: #bfa378;
    }
    .product-price {
      font-size: 1.1em;
      color: #333;
    }
    .view-btn, .buy-btn {
      display: inline-block;
      background: #bfa378;
      color: #fff;
      padding: 10px 15px;
      margin-top: 10px;
      border-radius: 4px;
      text-decoration: none;
      transition: background 0.3s;
    }
    .view-btn:hover, .buy-btn:hover {
      background: #a48f64;
    }
    .buy-btn {
      margin-left: 5px;
    }
  </style>
</head>
<body>
  <header>
    <div class="nav-container">
      <h2>Al-Madina</h2>
      <nav>
        <a href="index.php">Home</a>
        <a href="shop.php">Shop</a>
        <?php if(isset($_SESSION['user_id'])): ?>
          <a href="user/profile.php">Profile</a>
          <a href="logout.php">Logout</a>
        <?php else: ?>
          <a href="login.php">Login</a>
          <a href="register.php">Sign Up</a>
        <?php endif; ?>
      </nav>
    </div>
  </header>

  <div class="shop-container">
    <h2 style="text-align:center; color: #bfa378;">Our Exclusive Collection</h2>
    <div class="products-grid">
      <?php while ($product = $result->fetch_assoc()): ?>
        <div class="product-card">
          <?php
            $image_path = "uploads/" . $product['image'];
            if (!file_exists($image_path) || empty($product['image'])) {
                $image_path = "assets/default_product.jpg";
            }
          ?>
          <img src="<?= htmlspecialchars($image_path) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
          <div class="product-details">
            <h3 class="product-title"><?= htmlspecialchars($product['name']) ?></h3>
            <p class="product-price">$<?= number_format($product['price'], 2) ?></p>
            <a href="view_product.php?id=<?= htmlspecialchars($product['id']) ?>" class="view-btn">View Details</a>
            <a href="buy_now.php?id=<?= htmlspecialchars($product['id']) ?>" class="buy-btn">Buy Now</a>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  </div>
</body>
</html>
