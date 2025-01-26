<?php
session_start();


$conn = new mysqli('localhost', 'root', '', 'news_website');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize inputs
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password']; // Password from user input

 
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $username);
    $stmt->execute();
    $result = $stmt->get_result();


    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();


        if ($password === $user['password']) { // Direct comparison since password isn't hashed
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['admin_logged_in'] = true;


            header("Location: ../dashboard.php");
            exit();
        } else {

            $error_message = "Invalid username or password.";
        }
    } else {

        $error_message = "Invalid username or password.";
    }
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <header>
        <h1>Admin Login</h1>
    </header>
    <main class="login-container">
        <form action="login.php" method="POST" class="login-form">
            <?php if (isset($error_message)): ?>
                <p class="error-message"><?= htmlspecialchars($error_message) ?></p>
            <?php endif; ?>
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            
            <button type="submit" class="btn">Login</button>
        </form>
    </main>
</body>
</html>
