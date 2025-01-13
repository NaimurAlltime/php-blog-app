<?php
require 'config.php';

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM posts WHERE id = ?");
$stmt->execute([$id]);
$post = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];

    $stmt = $conn->prepare("UPDATE posts SET title = ?, content = ? WHERE id = ?");
    $stmt->execute([$title, $content, $id]);

    if ($stmt) {
        echo "<script>
            alert('Blog Updated successfully!');
            window.location = 'index.php';
        </script>";
    } else {
        echo "<script>
            alert('Error: Unable to update to blog.');
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Blog</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container max-w-screen-xl mx-auto py-10">
        <h1 class="text-2xl font-bold mb-5">Edit Blog</h1>
        <form action="" method="POST" class="bg-white shadow-md rounded p-5">
            <div class="mb-4">
                <label for="title" class="block text-sm font-bold mb-2">Title</label>
                <input type="text" name="title" id="title" value="<?= $post['title'] ?>" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-400 focus:outline-none" required>
            </div>
            <div class="mb-4">
                <label for="content" class="block text-sm font-bold mb-2">Content</label>
                <textarea name="content" id="content" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-400 focus:outline-none" rows="5" required><?= $post['content'] ?></textarea>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
        </form>
    </div>
</body>
</html>
