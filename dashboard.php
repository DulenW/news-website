<?php
session_start();


if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    header("Location: php/login.php"); // Redirect to login page
    exit();
}


$conn = new mysqli('localhost', 'root', '', 'news_website');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT * FROM news ORDER BY created_at DESC";
$result = $conn->query($sql);


if (!$result) {
    die("Query Error: " . $conn->error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header class="dashboard-header">
        <h1>Admin Dashboard</h1>
        <a href="php/logout.php" class="logout-btn">Logout</a>
    </header>

    <main class="dashboard-container">
        <!-- Add News Section -->
        <section class="add-news">
            <h2>Add News</h2>
            <form action="php/add_news.php" method="POST" class="news-form">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" required>
                
                <label for="content">Content</label>
                <textarea name="content" id="content" rows="5" required></textarea>
                
                <label for="category">Category</label>
                <input type="text" name="category" id="category" required>
                
                <button type="submit" class="btn">Add News</button>
            </form>
        </section>


        <section class="manage-news">
            <h2>Manage News</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?= htmlspecialchars($row['id']) ?></td>
                                <td><?= htmlspecialchars($row['title']) ?></td>
                                <td><?= htmlspecialchars($row['category']) ?></td>
                                <td>
                                    <a href="php/edit_news.php?id=<?= htmlspecialchars($row['id']) ?>" class="action-btn edit-btn">Edit</a>
                                    <a href="php/delete_news.php?id=<?= htmlspecialchars($row['id']) ?>" class="action-btn delete-btn" onclick="return confirm('Are you sure?')">Delete</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4">No news available.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </section>
    </main>
</body>
</html>
