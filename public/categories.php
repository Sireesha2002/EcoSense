<?php
session_start();
include '../includes/db_connection.php';

$message = "";

// Fetch all categories
$query = "SELECT * FROM categories";
$result = $conn->query($query);

if (!$result) {
    die("Error fetching categories: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Our Categories - EcoSense Skincare</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        /* General Styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to bottom, #c8d6a3, #f2f2e4); /* Soft olive-green blend */
            color: #333;
        }

        .header {
            background: #556b2f; /* Olive Green */
            color: white;
            padding: 15px 0;
            text-align: center;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .header h1 {
            margin: 0;
            font-size: 36px;
        }

        .nav-links {
            display: flex;
            justify-content: center;
            list-style: none;
            margin: 10px 0;
            padding: 0;
        }

        .nav-links li {
            margin: 0 15px;
        }

        .nav-links a {
            text-decoration: none;
            color: white;
            font-weight: bold;
            font-size: 16px;
        }

        .nav-links a:hover {
            text-decoration: underline;
        }

        /* Hero Section */
        .hero {
            text-align: center;
            color: white;
            background: #556b2f; /* Olive Green */
            height: 150px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .hero h1 {
            font-size: 36px;
            margin: 0;
        }

        .hero p {
            font-size: 18px;
            margin: 5px 0 0;
        }

        /* Categories Section */
        .categories-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            padding: 30px 10px;
            max-width: 1200px;
            margin: 0 auto;
            background: #fff; /* Neutral background */
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .category-tile {
            width: 250px; /* Fixed width */
            height: 300px; /* Fixed height */
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            font-weight: bold;
            text-transform: capitalize;
            color: #333;
        }

        .category-tile:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
        }

        .category-image {
            width: 150px;
            height: 150px;
            margin-bottom: 15px;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid #556b2f; /* Olive Green */
        }

        .footer {
            text-align: center;
            background: #556b2f; /* Olive Green */
            color: white;
            padding: 15px 0;
        }

        .footer-links {
            margin: 10px 0;
        }

        .footer-links a {
            text-decoration: none;
            color: white;
            margin: 0 10px;
            font-size: 14px;
        }

        .footer-links a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <h1>EcoSense Skincare</h1>
        <nav>
            <ul class="nav-links">
                <li><a href="index.php">Home</a></li>
                <li><a href="categories.php" class="active">Categories</a></li>
                <li><a href="cart.php">Cart</a></li>
                <li><a href="login.php">Login</a></li>
            </ul>
        </nav>
    </header>

    <!-- Hero Section -->
    <div class="hero">
        <h1>Categories</h1>
    
    </div>

    <!-- Categories Section -->
    <div class="categories-container">
    <?php if ($result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
            <a href="<?= htmlspecialchars($row['page_path']); ?>" class="category-tile">
                <img src="../assets/images/<?= htmlspecialchars($row['image_path']); ?>" alt="<?= htmlspecialchars($row['name']); ?>" class="category-image">
                <?= htmlspecialchars($row['name']); ?>
            </a>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No categories found.</p>
    <?php endif; ?>
</div>

    <!-- Footer -->
    <footer class="footer">
        <p>&copy; 2024 EcoSense Skincare. All rights reserved.</p>
        <div class="footer-links">
            <a href="privacy.php">Privacy Policy</a>
            <a href="terms.php">Terms of Service</a>
            <a href="contact.php">Contact Us</a>
        </div>
    </footer>
</body>
</html>
