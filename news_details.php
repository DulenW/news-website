<?php
$conn = new mysqli('localhost', 'root', '', 'news_website');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id']; 
$sql = "SELECT * FROM news WHERE id = $id";
$result = $conn->query($sql);
$news = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title><?= htmlspecialchars($news['title']) ?></title>
</head>
<body>
    <header>
        <h1><?= htmlspecialchars($news['title']) ?></h1>
        <a href="index.php">Back to Home</a>
    </header>
    <main>
        <p><strong>Category:</strong> <?= htmlspecialchars($news['category']) ?></p>
        <p><?= htmlspecialchars($news['content']) ?></p>
    </main>
</body>
</html>
