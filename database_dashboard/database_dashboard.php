<?php
// Include database connection
include '../includes/db_connection.php';

// Start session for admin authentication
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

$message = "";

// Add product functionality
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_product'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $image_path = $_POST['image_path'];
    $description = $_POST['description'];

    $query = "INSERT INTO products (name, price, image_path, description) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sdss", $name, $price, $image_path, $description);

    if ($stmt->execute()) {
        $message = "Product added successfully!";
    } else {
        $message = "Error adding product: " . $stmt->error;
    }
}

// Fetch cart data
$cart_query = "SELECT * FROM cart";
$cart_result = $conn->query($cart_query);

// Fetch products for the dashboard
$product_query = "SELECT * FROM products";
$product_result = $conn->query($product_query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Dashboard</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        .container {
            max-width: 1000px;
            margin: 50px auto;
            background: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1, h2 {
            text-align: center;
            color: #4CAF50;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }
        th {
            background-color: #f4f4f4;
        }
        input, textarea, button {
            display: block;
            width: 100%;
            margin: 10px 0;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        .success {
            color: green;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Database Dashboard</h1>

        <!-- Display success or error message -->
        <?php if ($message): ?>
            <p class="<?= strpos($message, 'successfully') !== false ? 'success' : 'error' ?>">
                <?= htmlspecialchars($message); ?>
            </p>
        <?php endif; ?>

        <!-- Add Product Form -->
        <h2>Add Product</h2>
        <form method="POST">
            <label for="name">Product Name</label>
            <input type="text" id="name" name="name" required>

            <label for="price">Price</label>
            <input type="number" id="price" name="price" step="0.01" required>

            <label for="image_path">Image Path</label>
            <input type="text" id="image_path" name="image_path" required>

            <label for="description">Description</label>
            <textarea id="description" name="description" rows="4" required></textarea>

            <button type="submit" name="add_product">Add Product</button>
        </form>

        <!-- Display Products -->
        <h2>Products</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $product_result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['id']); ?></td>
                    <td><?= htmlspecialchars($row['name']); ?></td>
                    <td>$<?= htmlspecialchars(number_format($row['price'], 2)); ?></td>
                    <td>
                        <img src="../assets/images/<?= htmlspecialchars($row['image_path']); ?>" alt="<?= htmlspecialchars($row['name']); ?>" style="width: 50px; height: auto;">
                    </td>
                    <td><?= htmlspecialchars($row['description']); ?></td>
                    <td>
                        <a href="edit_product.php?id=<?= $row['id']; ?>">Edit</a> |
                        <form method="POST" action="delete_product.php" style="display: inline;">
                            <input type="hidden" name="id" value="<?= $row['id']; ?>">
                            <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <!-- Display Cart -->
        <h2>View Cart</h2>
        <table>
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $cart_result->fetch_assoc()): ?>
                <tr>
                    <td><?= htmlspecialchars($row['user_id']); ?></td>
                    <td><?= htmlspecialchars($row['product_name']); ?></td>
                    <td>$<?= htmlspecialchars(number_format($row['price'], 2)); ?></td>
                    <td><?= htmlspecialchars($row['quantity']); ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
