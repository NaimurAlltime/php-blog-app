<?php
include "config.php";

// Check if the search query exists
$searchQuery = "";
if (isset($_GET['search'])) {
    $searchQuery = $_GET['search'];
    $sql = "SELECT * FROM `posts` WHERE title LIKE :search";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['search' => "%$searchQuery%"]);
} else {
    $sql = "SELECT * FROM `posts`";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
}

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>Admin Panel - Blog</title>
</head>

<body class="bg-gray-100">
    <nav class="bg-green-200 text-center text-2xl font-semibold py-4 mb-6">
        Blog Management Panel
    </nav>

    <div class="container max-w-screen-xl mx-auto p-5 bg-white rounded-lg shadow">
        <?php
        if (isset($_GET["msg"])) {
            $msg = $_GET["msg"];
            echo '<div class="bg-yellow-100 text-yellow-800 p-3 rounded mb-4">
            ' . $msg . '
            <button class="float-right text-yellow-800 font-bold" onclick="this.parentElement.remove();">&times;</button>
        </div>';
        }
        ?>

        <div class="flex justify-between items-center mb-4">
            <a href="add.php" class="bg-gray-800 text-white px-4 py-2 rounded hover:bg-gray-700">
                <i class="fas fa-plus-circle mr-1"></i>Add New Post
            </a>
            <form method="get" class="flex items-center">
                <input type="text" name="search" value="<?php echo htmlspecialchars($searchQuery); ?>" placeholder="Search..." class="px-3 py-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-green-400">
                <button type="submit" class="bg-gray-800 text-white px-4 py-2 rounded-r-md hover:bg-gray-700">
                    <i class="fa-solid fa-search"></i> Search
                </button>
            </form>
        </div>

        <table class="table-auto w-full border-collapse border border-gray-200">
            <thead class="bg-gray-300">
                <tr>
                    <th class="border border-gray-200 px-4 py-2 text-start">ID</th>
                    <th class="border border-gray-200 px-4 py-2 text-start">Blog Title</th>
                    <th class="border border-gray-200 px-4 py-2 text-start">Blog Content</th>
                    <th class="border border-gray-200 px-4 py-2 text-start">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (count($results) > 0) {
                    foreach ($results as $row) {
                ?>
                        <tr class="odd:bg-white even:bg-gray-100">
                            <td class="border border-gray-200 px-4 py-2"><?php echo $row["id"] ?></td>
                            <td class="border border-gray-200 px-4 py-2"><?php echo $row["title"] ?></td>
                            <td class="border border-gray-200 px-4 py-2"><?php echo substr($row["content"], 0, 50) . '...'; ?></td>
                            <td class="border border-gray-200 px-4 py-2">
                                <a href="edit.php?id=<?php echo $row["id"] ?>" class="bg-blue-500 px-1.5 py-1 rounded-[4px] text-white"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                                <a href="delete.php?id=<?php echo $row["id"] ?>" class="bg-red-500 px-1.5 py-1 rounded-[4px] text-white ml-4" onclick="return confirm('Are you sure you want to delete this post?');"><i class="fa-solid fa-trash"></i> Delete</a>
                            </td>
                        </tr>
                <?php
                    }
                } else {
                    echo "<tr><td colspan='4' class='border border-gray-200 px-4 py-2 text-center text-gray-500'>No records found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>
