<?php
// Start session and include necessary files
session_start();
include '../includes/db_connection.php'; // Adjust the path based on your directory structure
include '../includes/header.php';       // Include header if necessary

$message = "";

// Handle adding a new category
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_category'])) {
    $name = trim($_POST['name']);
    $image_path = trim($_POST['image_path']);

    if (empty($name) || empty($image_path)) {
        $message = "Please fill in all fields.";
    } else {
        $query = "INSERT INTO categories (name, image_path) VALUES (?, ?)";
        $stmt = $conn->prepare($query);
        if ($stmt) {
            $stmt->bind_param("ss", $name, $image_path);
            if ($stmt->execute()) {
                $message = "Category added successfully!";
            } else {
                $message = "Error adding category: " . htmlspecialchars($stmt->error);
            }
            $stmt->close();
        } else {
            $message = "Database error: " . htmlspecialchars($conn->error);
        }
    }
}

// Handle deleting a category
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_category'])) {
    $id = intval($_POST['id']);
    if ($id > 0) {
        $query = "DELETE FROM categories WHERE id = ?";
        $stmt = $conn->prepare($query);
        if ($stmt) {
            $stmt->bind_param("i", $id);
            if ($stmt->execute()) {
                $message = "Category deleted successfully!";
            } else {
                $message = "Error deleting category: " . htmlspecialchars($stmt->error);
            }
            $stmt->close();
        } else {
            $message = "Database error: " . htmlspecialchars($conn->error);
        }
    } else {
        $message = "Invalid category ID.";
    }
}

// Fetch all categories
$query = "SELECT * FROM categories ORDER BY id DESC";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Categories - EcoSense Skincare</title>
    <link rel="stylesheet" href="../public/css/style.css">
    <style>
        .container {
            max-width: 800px;
            margin: 50px auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
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

        .category-image {
            width: 100px;
            height: auto;
        }

        form {
            margin-top: 20px;
        }

        input, button {
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        button {
            background-color: #556B2F;
            color: white;
            cursor: pointer;
        }

        button:hover {
            background-color: #6B8E23;
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
        <h1>Manage Categories</h1>

        <!-- Display success or error messages -->
        <?php if (!empty($message)): ?>
            <p class="<?= strpos($message, 'successfully') !== false ? 'success' : 'error' ?>">
                <?= htmlspecialchars($message); ?>
            </p>
        <?php endif; ?>

        <!-- Table for categories -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result && $result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['id']); ?></td>
                            <td><?= htmlspecialchars($row['name']); ?></td>
                            <td>
                                <?php if (!empty($row['image_path'])): ?>
                                    <img src="../public/assets/images/<?= htmlspecialchars($row['image_path']); ?>" alt="<?= htmlspecialchars($row['name']); ?>" class="category-image">
                                <?php else: ?>
                                    N/A
                                <?php endif; ?>
                            </td>
                            <td>
                                <!-- Delete category -->
                                <form method="POST" onsubmit="return confirm('Are you sure you want to delete this category?');">
                                    <input type="hidden" name="id" value="<?= htmlspecialchars($row['id']); ?>">
                                    <button type="submit" name="delete_category" class="delete-button">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">No categories found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <!-- Form to add a new category -->
        <h2>Add New Category</h2>
        <form method="POST" class="category-form">
            <label for="name">Category Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="image_path">Image Path:</label>
            <input type="text" id="image_path" name="image_path" placeholder="e.g., cleanser.png" required>

            <button type="submit" name="add_category">Add Category</button>
        </form>
    </div>
</body>
</html>
