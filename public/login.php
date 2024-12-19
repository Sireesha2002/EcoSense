<?php
session_start();
include '../includes/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, username, password_hash FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password_hash'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header("Location: index.php");
            exit;
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "No account found with that email.";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - EcoSense Skincare</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to bottom, #c8d6a3, #f2f2e4); /* Soft olive-green gradient */
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
            color: #556b2f; /* Olive green */
        }

        .error {
            color: red;
            margin-bottom: 15px;
            font-size: 14px;
        }

        label {
            display: block;
            text-align: left;
            margin-bottom: 8px;
            font-weight: bold;
            color: #556b2f; /* Olive green */
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
            background-color: #556b2f; /* Olive green */
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #6b8e23; /* Slightly lighter olive green */
        }

        .back-btn {
            margin-top: 15px;
            display: inline-block;
            padding: 10px 20px;
            background-color: #6b8e23; /* Slightly lighter olive green */
            color: white;
            text-decoration: none;
            border-radius: 8px;
        }

        .back-btn:hover {
            background-color: #556b2f; /* Olive green */
        }

        p {
            margin-top: 15px;
            font-size: 14px;
        }

        p a {
            color: #556b2f; /* Olive green */
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
        <h1>Login</h1>
        <?php if (!empty($error)): ?><p class="error"><?= htmlspecialchars($error); ?></p><?php endif; ?>
        <form method="POST">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
            <button type="submit">Login</button>
        </form>
        <p>Don't have an account? <a href="signup.php">Sign up</a></p>
        <a href="index.php" class="back-btn">Back to Home</a>
    </div>
</body>
</html>
