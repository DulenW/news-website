<?php
$conn = new mysqli('localhost', 'root', '', 'news_website');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch the latest 5 news articles
$sql = "SELECT * FROM news ORDER BY created_at DESC LIMIT 5";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>News Website</title>
</head>
<body>
    <header>
        <h1>Welcome to the News Website</h1>
        <nav>
            <a href="index.php">Home</a>
            <a href="about.php">About Us</a>
            <a href="contact.php">Contact Us</a>
        </nav>
    </header>
    <main>
        <h2>Latest News</h2>
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <article>
                    <h3><?= htmlspecialchars($row['title']) ?></h3>
                    <p><?= htmlspecialchars(substr($row['content'], 0, 100)) ?>...</p>
                    <a href="news_details.php?id=<?= $row['id'] ?>">Read More</a>
                </article>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No news available.</p>
        <?php endif; ?>
    </main>
</body>
</html>
