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

// Get the news ID to delete
$id = $_GET['id'];

// Delete the news
$sql = "DELETE FROM news WHERE id = $id";
if ($conn->query($sql) === TRUE) {
    echo "News deleted successfully!";
} else {
    echo "Error deleting news: " . $conn->error;
}

$conn->close();
header("Location: ../dashboard.php");
exit();
?>
