<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'news_website');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch news
$sql = "SELECT * FROM news ORDER BY created_at DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<article>";
        echo "<h3>" . $row['title'] . "</h3>";
        echo "<p>" . $row['content'] . "</p>";
        echo "<p><em>Category: " . $row['category'] . "</em></p>";
        echo "</article>";
    }
} else {
    echo "No news available.";
}

$conn->close();
?>