<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../admin.php");
    exit();
}

// Database connection
$conn = new mysqli('localhost', 'root', '', 'news_website');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$title = $_POST['title'];
$content = $_POST['content'];
$category = $_POST['category'];

// Insert news into the database
$sql = "INSERT INTO news (title, content, category) VALUES ('$title', '$content', '$category')";
if ($conn->query($sql) === TRUE) {
    echo "News added successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
header("Location: ../dashboard.php");
exit();
?>
