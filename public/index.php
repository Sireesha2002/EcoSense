<?php
session_start(); // Start the session to check user login status
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoSense Skincare</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
            background-color: #f9f9f9;
        }

        .header {
            background: #556B2F; /* Olive Green */
            color: white;
            padding: 15px 0;
            text-align: center;
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

        .hero {
            text-align: center;
    color: white;
    background-image: url('assets/images/homepage_background.png'); /* Ensure the path is correct */
    background-size: cover; /* Ensures the image covers the entire hero section */
    background-position: fixed; /* Focuses on the fixed of the image */
    height: 100vh; /* Adjust height to display the full hero section */
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding: 20px;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    overflow: hidden; /* Ensures no extra content overflows */

        }

        .hero h1 {
            font-size: 48px;
            margin-bottom: 20px;
        }

        .hero p {
            font-size: 18px;
            max-width: 600px;
            margin: 0 auto;
            line-height: 1.8;
            padding: 0 20px;
        }

        .about-section {
            padding: 40px 20px;
            text-align: center;
            background-color: #fff;
            margin-top: 20px;
        }

        .about-section h2 {
            font-size: 28px;
            margin-bottom: 20px;
            color: #556B2F; /* Olive Green */
        }

        .about-section p {
            font-size: 18px;
            line-height: 1.8;
            max-width: 800px;
            margin: 0 auto;
        }

        .footer {
            text-align: center;
            background: #556B2F; /* Olive Green */
            color: white;
            padding: 10px 0;
            position: relative;
            margin-top: 20px;
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
<header class="header">
    <nav>
        <ul class="nav-links">
            <li><a href="index.php" class="active">Home</a></li>
            <li><a href="categories.php">Categories</a></li>
            <li><a href="cart.php">Cart</a></li>
            <?php if (isset($_SESSION['user_id'])): ?>
                <li><a href="logout.php">Logout</a></li>
            <?php else: ?>
                <li><a href="login.php">Login</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>



    <div class="hero">
        <h1></h1>
        
    </div>

    <section class="about-section">
        <h2>About Us</h2>
        <p>
            Welcome to <strong>EcoSense</strong>, your destination for sustainable and eco-friendly skincare solutions.
            Our products are thoughtfully crafted using natural ingredients to nurture your skin while caring for the environment.
            Experience the perfect blend of science and nature with every application. Join us in embracing beauty that's kind to your skin and the planet.
        </p>
    </section>

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
