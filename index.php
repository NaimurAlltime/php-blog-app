<?php
require 'admin/config.php';

// Fetch posts
$stmt = $conn->query("SELECT * FROM posts ORDER BY created_at DESC");
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto py-10">
        <h1 class="text-3xl font-bold mb-5">Blog Posts</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
            <?php foreach ($posts as $post): ?>
            <div class="bg-white shadow-md rounded p-5">
                <h2 class="text-xl font-bold mb-2"><?= $post['title'] ?></h2>
                <p><?= substr($post['content'], 0, 100) ?>...</p>
                <p class="text-sm text-gray-500 mt-2">Published: <?= $post['created_at'] ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
