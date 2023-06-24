<!-- CategoryManagementView.php -->

<?php
require_once 'controllers/CategoryController.php';
require_once 'models/CategoryModel.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Category Management</title>
    <link rel="stylesheet" href="assets/bootstrap/bootstrap.css">
    <style>
        /* Additional CSS styles */
    </style>
</head>
<body>
    <h1>Category Management</h1>

    <!-- Search Form -->
    <form action="index.php" method="GET">
        <input type="text" name="search" placeholder="Search by category name" value="<?php echo $searchQuery; ?>">
        <button type="submit">Search</button>
    </form>

    <!-- Category List -->
    <div>
        <h2>Categories</h2>

        <table>
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Parent Category</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($categories as $category) { ?>
                    <tr>
                        <td><?php echo $category['code']; ?></td>
                        <td><?php echo $category['name']; ?></td>
                        <td><?php echo $category['parent_category']; ?></td>
                        <td>
                            <a href="edit.php?id=<?php echo $category['id']; ?>">Edit</a>
                            <a href="copy.php?id=<?php echo $category['id']; ?>">Copy</a>
                            <a href="details.php?id=<?php echo $category['id']; ?>">Details</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <!-- Pagination -->
        <?php echo $paginationHelper->generatePaginationLinks($totalCount, $categoriesPerPage, $currentPage); ?>
    </div>

    <script src="assets/bootstrap/bootstrap.js"></script>
    <script>
        // Additional JavaScript code
    </script>
</body>
</html>
