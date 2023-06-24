<?php
require_once 'controllers/CategoryController.php';
require_once 'models/CategoryModel.php';
require_once 'helpers/PaginationHelper.php';
// require_once 'database.php';

// Create an instance of the CategoryModel
$dbConnection = OpenCon();
$categoryModel = new CategoryModel($dbConnection);

// Create an instance of the CategoryController
$categoryController = new CategoryController($categoryModel);

// Retrieve the search query from the request
$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';

// Retrieve the current page number from the request
$currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

// Set the number of categories to display per page
$categoriesPerPage = 10;

// Calculate the offset for pagination
$offset = ($currentPage - 1) * $categoriesPerPage;

// Retrieve the total number of categories
$totalCount = $categoryModel->getCategoryCount($searchQuery);

// Retrieve the categories for the current page
$categories = $categoryModel->getCategories($offset, $categoriesPerPage, $searchQuery);

// Create an instance of the PaginationHelper
$paginationHelper = new PaginationHelper();

// Close the database connection
CloseCon($dbConnection);
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
    <form action="CategoryManagementView.php" method="GET">
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
                            <a href="EditCategoryView.php?id=<?php echo $category['id']; ?>">Edit</a>
                            <a href="CopyCategoryView.php?id=<?php echo $category['id']; ?>">Copy</a>
                            <a href="CategoryDetailsView.php?id=<?php echo $category['id']; ?>">Details</a>
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