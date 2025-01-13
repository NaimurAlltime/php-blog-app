<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];

    $stmt = $conn->prepare("INSERT INTO posts (title, content) VALUES (?, ?)");
    $stmt->execute([$title, $content]);
    
    if ($stmt) {
        echo "<script>
            alert('Blog created successfully!');
            window.location = 'index.php';
        </script>";
    } else {
        echo "<script>
            alert('Error: Unable to add to blog.');
        </script>";
    }
   
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Blog</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- SweetAlert2 -->
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-100">
    <div class="container max-w-screen-xl mx-auto py-10">
        <h1 class="text-2xl font-bold mb-5">Add New blog</h1>
        <form action="" method="POST" class="bg-white shadow-md rounded p-5">
            <div class="mb-4">
                <label for="title" class="block text-sm font-bold mb-2">Title</label>
                <input type="text" name="title" id="title" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-400 focus:outline-none" required>
            </div>
            <div class="mb-4">
                <label for="content" class="block text-sm font-bold mb-2">Content</label>
                <textarea name="content" id="content" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-400 focus:outline-none" rows="5" required></textarea>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Submit</button>
        </form>
    </div>
</body>
</html>
