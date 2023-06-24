<?php
require_once 'database.php';
require_once 'models/CategoryModel.php';
require_once 'controllers/CategoryController.php';
require_once 'helpers/PaginationHelper.php';

// Create a new database connection
$conn = OpenCon();

// Create instances of the model, controller, and pagination helper
$categoryModel = new CategoryModel($conn);
$categoryController = new CategoryController($categoryModel);
$paginationHelper = new PaginationHelper();

// Handle form submissions and actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add'])) {
        // Handle adding a new category
        $categoryController->addCategory($_POST);
    } elseif (isset($_POST['edit'])) {
        // Handle editing a category
        $categoryController->editCategory($_POST);
    } elseif (isset($_POST['copy'])) {
        // Handle copying a category
        $categoryController->copyCategory($_POST);
    }
}

// Handle search query
$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';

// Get the total count of categories
$totalCount = $categoryModel->getCategoryCount($searchQuery);

// Set the current page number
$currentPage = isset($_GET['page']) ? intval($_GET['page']) : 1;

// Set the number of categories per page
$categoriesPerPage = 10;

// Calculate the offset for pagination
$offset = ($currentPage - 1) * $categoriesPerPage;

// Get the categories for the current page
$categories = $categoryModel->getCategories($offset, $categoriesPerPage, $searchQuery);

// Close the database connection
CloseCon($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Category Management</title>
    <link rel="stylesheet" href="assets/bootstrap.css">
    <style>
        /* Additional CSS styles */
    </style>
</head>
<body>
    <h1>Category Management</h1>

    <!-- Category List -->
    <div>
        <h2>Categories</h2>

        <!-- Search Form -->
        <form action="index.php" method="GET">
            <input type="text" name="search" placeholder="Search by category name" value="<?php echo $searchQuery; ?>">
            <button type="submit">Search</button>
        </form>

        <!-- Category Table -->
        <table class="table table-bordered">
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
                            <button class="btn btn-primary" data-toggle="modal" data-target="#editCategoryModal<?php echo $category['id']; ?>">Edit</button>
                            <button class="btn btn-secondary" data-toggle="modal" data-target="#copyCategoryModal<?php echo $category['id']; ?>">Copy</button>
                            <button class="btn btn-info" data-toggle="modal" data-target="#categoryDetailsModal<?php echo $category['id']; ?>">Details</button>
                        </td>
                    </tr>

                    <!-- Edit Category Form (Popup) -->
                    <div id="editCategoryModal<?php echo $category['id']; ?>" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <!-- Edit Category Form content -->
                                <?php include 'views/EditCategoryView.php'; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Copy Category Form (Popup) -->
                    <div id="copyCategoryModal<?php echo $category['id']; ?>" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <!-- Copy Category Form content -->
                                <?php include 'views/CopyCategoryView.php'; ?>
                            </div>
                        </div>
                    </div>

                    <!-- Category Details (Popup) -->
                    <div id="categoryDetailsModal<?php echo $category['id']; ?>" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <!-- Category Details content -->
                                <?php include 'views/CategoryDetailsView.php'; ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </tbody>
        </table>

        <!-- Pagination -->
        <?php echo $paginationHelper->generatePaginationLinks($totalCount, $categoriesPerPage, $currentPage); ?>
    </div>

    <!-- Add Category Form (Popup) -->
    <div id="addCategoryModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Add Category Form content -->
                <?php include 'views/AddCategoryView.php'; ?>
            </div>
        </div>
    </div>

    <script src="assets/bootstrap.js"></script>
    <script>
        // Additional JavaScript code
    </script>
</body>
</html>
