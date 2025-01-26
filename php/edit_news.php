<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../admin.php");
    exit();
}


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
    <title>Edit News</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h2>Edit News</h2>
    <form action="update_news.php" method="POST">
        <input type="hidden" name="id" value="<?= $news['id'] ?>">
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" value="<?= $news['title'] ?>" required>
        <br>
        <label for="content">Content:</label>
        <textarea name="content" id="content" required><?= $news['content'] ?></textarea>
        <br>
        <label for="category">Category:</label>
        <input type="text" name="category" id="category" value="<?= $news['category'] ?>" required>
        <br>
        <button type="submit">Update News</button>
    </form>
</body>
</html>

<?php $conn->close(); ?>
