<?php
include 'config.php';

$id = $_GET['id'];
$stmt = $conn->prepare("DELETE FROM posts WHERE id = ?");
$stmt->execute([$id]);

if ($stmt) {
    echo "<script>
        alert('Blog deleted successfully!');
        window.location = 'index.php';
    </script>";
} else {
    echo "<script>
        alert('Error: Unable to delete the blog.');
    </script>";
}
?>
