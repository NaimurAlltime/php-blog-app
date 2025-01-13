<?php
require 'config.php';

// Fetch posts
$stmt = $conn->query("SELECT * FROM posts ORDER BY created_at DESC");
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto py-10">
        <h1 class="text-2xl font-bold mb-5">Admin Panel</h1>
        <a href="add.php" class="bg-blue-500 text-white px-4 py-2 rounded">Add Post</a>
        <table class="w-full mt-5 bg-white shadow-md rounded">
            <thead>
                <tr class="bg-gray-200">
                    <th class="px-4 py-2">ID</th>
                    <th class="px-4 py-2">Title</th>
                    <th class="px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($posts as $post): ?>
                <tr>
                    <td class="border px-4 py-2"><?= $post['id'] ?></td>
                    <td class="border px-4 py-2"><?= $post['title'] ?></td>
                    <td class="border px-4 py-2">
                        <a href="edit.php?id=<?= $post['id'] ?>" class="text-blue-500">Edit</a>
                        <a href="delete.php?id=<?= $post['id'] ?>" class="text-red-500" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
