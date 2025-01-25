<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    // Redirect to admin login if not logged in
    header("Location: admin.php");
    exit();
}

// Database connection
$conn = new mysqli('localhost', 'root', '', 'news_website');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all news articles
$sql = "SELECT * FROM news ORDER BY created_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>
    <h2>Welcome to Admin Dashboard</h2>
    <a href="php/logout.php">Logout</a>

    <h3>Add News</h3>
    <form action="php/add_news.php" method="POST">
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" required>
        <br>
        <label for="content">Content:</label>
        <textarea name="content" id="content" required></textarea>
        <br>
        <label for="category">Category:</label>
        <input type="text" name="category" id="category" required>
        <br>
        <button type="submit">Add News</button>
    </form>

    <h3>Manage News</h3>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Category</th>
            <th>Actions</th>
        </tr>
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['title'] ?></td>
                    <td><?= $row['category'] ?></td>
                    <td>
                        <a href="php/edit_news.php?id=<?= $row['id'] ?>">Edit</a> |
                        <a href="php/delete_news.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr><td colspan="4">No news available.</td></tr>
        <?php endif; ?>
    </table>
</body>
</html>

<?php $conn->close(); ?>
