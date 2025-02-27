<?php
// index.php
include 'config.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Al-Madina - Home</title>
    <link hentiqueref="https://fonts.googleapis.com/css2?family=Barlow:wght@400;600&family=Roboto:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Global Styles */
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f8f8;
            color: #333;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        /* Navbar */
        nav {
            background-color: #000;
            padding: 15px 30px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        nav .navbar-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
        }

        nav .logo {
            font-size: 2em;
            font-weight: 700;
            color: white;
            letter-spacing: 1px;
        }

        nav .navbar-links {
            list-style-type: none;
            display: flex;
            gap: 25px;
        }

        nav .navbar-links li {
            display: inline-block;
        }

        nav .navbar-links a {
            color: white;
            font-size: 1.2em;
            transition: color 0.3s ease;
            letter-spacing: 1px;
        }

        nav .navbar-links a:hover {
            color: #bfa378; /* Secondary Color: a warm accent */
        }

        /* Hero Section */
        .hero-section {
            background: url('assets/img/background.jpg') no-repeat center center/cover;
            padding: 120px 0;
            color: white;
            text-align: center;
            position: relative;
            margin-bottom: 50px;
            height: 50vh;
        }

        .hero-section::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.4);
            z-index: -1;
        }

        .hero-section h2 {
            font-size: 4em;
            font-weight: 700;
            color: #bfa378;
            margin-bottom: 20px;
        }

        .hero-section p {
            font-size: 1.5em;
            margin-bottom: 30px;
            font-weight: 300;
        }

        .hero-button {
            background-color: #bfa378; /* Primary Accent Color */
            color: white;
            padding: 18px 28px;
            font-size: 1.3em;
            font-weight: 600;
            border-radius: 50px;
            transition: background-color 0.3s, transform 0.3s ease;
            letter-spacing: 1px;
        }

        .hero-button:hover {
            background-color: #a48f64;
            transform: scale(1.1);
        }

        /* Center-align text */
        .text-center {
            text-align: center;
        }

        /* Features Section */
        .features-section {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 30px;
            padding: 50px 0;
            text-align: center;
            background-color: #fff;
            height: auto;
        }

        .feature-card {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease, transform 0.3s ease;
            margin: 20px;
        }

        .feature-card:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            transform: translateY(-10px);
        }

        .feature-card img {
            max-width: 100px;
            margin-bottom: 20px;
        }

        .feature-card h3 {
            font-size: 1.7em;
            margin-bottom: 10px;
            color: #bfa378;
            font-weight: 600;
        }

        .feature-card p {
            font-size: 1.1em;
            color: #777;
        }

        /* Search Section */
        .search-section {
            background-color: #ecf0f1;
            padding: 50px 0;
            text-align: center;
        }

        .search-bar {
            width: 60%;
            padding: 18px;
            font-size: 1.3em;
            border-radius: 50px;
            border: 1px solid #ccc;
            transition: border-color 0.3s;
            margin-bottom: 20px;
        }

        .search-bar:focus {
            border-color: #bfa378;
        }

        .search-button {
            background-color: #333;
            color: white;
            padding: 18px 28px;
            font-size: 1.2em;
            font-weight: 600;
            border-radius: 50px;
            transition: background-color 0.3s;
        }

        .search-button:hover {
            background-color: #555;
        }

        /* Footer */
        footer {
            background-color: #2c3e50;
            color: white;
            padding: 30px 0;
            text-align: center;
        }

        footer p {
            font-size: 1.1em;
        }

        footer a {
            color: #ecf0f1;
            font-weight: bold;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .features-section {
                grid-template-columns: 1fr 1fr;
            }

            .hero-section h2 {
                font-size: 2.8em;
            }

            .hero-section p {
                font-size: 1.3em;
            }

            .search-bar {
                width: 80%;
            }
        }
    </style>
</head>
<body>

    <!-- Navbar Section -->
    <nav>
        <div class="navbar-container">
            <div class="logo">Al-Madina</div>
            <ul class="navbar-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="shop.php">Shop</a></li>
                <li><a href="login.php">Login</a></li>
                <li><a href="register.php">Sign Up</a></li>
            </ul>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero-section">
        <h2>Indulge in Luxury Scents</h2>
        <p>Discover our exclusive collection of premium perfumes, crafted to elevate your essence.</p>
        <a href="shop.php" class="hero-button">Shop Now</a>
    </div>

    <!-- Features Section -->
    <div class="container">
        <h2 class="text-center">Our Highlights</h2>
        <div class="features-section">
            <div class="feature-card">
                <img src="assets/img/signature.jpg" alt="Signature Collection">
                <h3>Signature Collection</h3>
                <p>Explore our curated collection of exclusive scents.</p>
            </div>
            <div class="feature-card">
                <img src="assets/img/cb.webp" alt="Custom Blends">
                <h3>Custom Blends</h3>
                <p>Create your own signature scent with our bespoke services.</p>
            </div>
            <div class="feature-card">
                <img src="assets/img/gift.jpg" alt="Gift Packages">
                <h3>Elegant Gift Packaging</h3>
                <p>Perfect gifts with premium packaging for every occasion.</p>
            </div>
        </div>
    </div>

    <!-- Search Section -->
    <div class="search-section">
        <h2>Search for Your Favorite Scent</h2>
        <form method="GET" action="search_results.php">
            <input type="text" class="search-bar" name="query" placeholder="Search perfumes, brands, or notes..." required>
            <button type="submit" class="search-button">Search</button>
        </form>
    </div>

    <!-- Footer Section -->
    <footer>
        <p>&copy; 2025 Scentique - All Rights Reserved, <a href="privacy_policy.php">Privacy Policy</a></p>
        <p>Crafted with elegance for fragrance enthusiasts</p>
    </footer>

</body>
</html>
