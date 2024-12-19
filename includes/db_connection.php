<?php
// Database connection credentials
$host = "localhost";       // Database host
$username = "root";        // Database username
$password = "";            // Database password (usually empty for XAMPP)
$dbname = "ecosense_db";   // Your database name

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
