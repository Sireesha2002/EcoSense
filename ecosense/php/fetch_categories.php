
<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");

// Database connection
$servername = 'localhost';
$dbname = 'skincare_db';
$username = 'root';
$password = 'root';


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

// Fetch unique categories
$sql = "SELECT DISTINCT category FROM products";
$result = $conn->query($sql);

$categories = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $categories[] = $row['category'];
    }
}

$conn->close();

echo json_encode(["categories" => $categories]);
?>

