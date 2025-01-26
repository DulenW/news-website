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


$id = $_POST['id'];
$title = $_POST['title'];
$content = $_POST['content'];
$category = $_POST['category'];


$sql = "UPDATE news SET title = '$title', content = '$content', category = '$category' WHERE id = $id";
if ($conn->query($sql) === TRUE) {
    echo "News updated successfully!";
} else {
    echo "Error updating news: " . $conn->error;
}

$conn->close();
header("Location: ../dashboard.php");
exit();
?>
