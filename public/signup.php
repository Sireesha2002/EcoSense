<?php
include '../includes/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        $error = "Passwords do not match.";
    } else {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO users (username, email, password_hash) VALUES (?, ?, ?)");
        if (!$stmt) {
            die("Prepare failed: " . $conn->error); // Debugging line
        }
        $stmt->bind_param("sss", $username, $email, $password_hash);

        if ($stmt->execute()) {
            $success = "Signup successful!";
        } else {
            $error = "Error: " . htmlspecialchars($stmt->error);
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup - EcoSense Skincare</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        /* Styling similar to previous signup aesthetic */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to bottom, #c8d6a3, #f2f2e4);
            color: #333;
        }
        .container {
            max-width: 400px;
            margin: 100px auto;
            background: white;
            border-radius: 12px;
            padding: 30px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            text-align: center;
        }
        h1 {
            margin-bottom: 20px;
            color: #556b2f;
        }
        .error {
            color: red;
            margin-bottom: 15px;
            font-size: 14px;
        }
        .success {
            color: green;
            margin-bottom: 15px;
            font-size: 14px;
        }
        label {
            display: block;
            text-align: left;
            margin-bottom: 8px;
            font-weight: bold;
            color: #556b2f;
        }
        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }
        button {
            width: 100%;
            padding: 12px;
            background-color: #556b2f;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #6b8e23;
        }
        p {
            margin-top: 15px;
            font-size: 14px;
        }
        p a {
            color: #556b2f;
            text-decoration: none;
            font-weight: bold;
        }
        p a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Signup</h1>
        <?php if (!empty($error)): ?><p class="error"><?= htmlspecialchars($error); ?></p><?php endif; ?>
        <?php if (!empty($success)): ?><p class="success"><?= htmlspecialchars($success); ?></p><?php endif; ?>
        <form method="POST">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" required>
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
            <label for="confirm_password">Confirm Password</label>
            <input type="password" name="confirm_password" id="confirm_password" required>
            <button type="submit">Signup</button>
        </form>
        <p>Already have an account? <a href="login.php">Login here</a></p>
    </div>
</body>
</html>
