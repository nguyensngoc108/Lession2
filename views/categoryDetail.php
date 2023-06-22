<?php

require_once 'helper/db_connection.php';
require_once 'models/CategoryModel.php';

// Retrieve category data from the database
$categoryModel = new CategoryModel();
$categories = $categoryModel->getAllCategories();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Category Detail</title>
    <!-- Include necessary CSS and JS libraries -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.0/js/bootstrap.bundle.min.js"></script>
</head>
<body>

    <!-- Category Detail Page Content -->
    <div class="container">
        <h1>Category Detail</h1>
        
        <!-- Display category information -->
        <div class="card">
            <div class="card-header">
                Category Information
            </div>
            <div class="card-body">
                <p><strong>Category ID:</strong> <?php echo $category['id']; ?></p>
                <p><strong>Category Name:</strong> <?php echo $category['name']; ?></p>
                <p><strong>Parent Category:</strong> <?php echo $category['parent_category']; ?></p>
            </div>
        </div>
        
        <!-- Buttons for Edit, Copy, and Close -->
        <div class="mt-3">
            <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editCategoryModal">
                Edit Category
            </a>
            <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#copyCategoryModal">
                Copy Category
            </a>
            <a href="#" class="btn btn-secondary" onclick="window.close();">
                Close
            </a>
        </div>
        
    </div>

    <!-- Edit Category Modal -->
    <div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal content goes here -->
                <div class="modal-header">
                    <h5 class="modal-title" id="editCategoryModalLabel">Edit Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Edit category form goes here -->
                    <form action="editCategory.php" method="POST">
                        <input type="hidden" name="categoryId" value="<?php echo $category['id']; ?>">
                        <!-- Category fields to edit -->
                        <div class="mb-3">
                            <label for="categoryName" class="form-label">Category Name</label>
                            <input type="text" class="form-control" id="categoryName" name="categoryName" value="<?php echo $category['name']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="parentCategory" class="form-label">Parent Category</label>
                            <input type="text" class="form-control" id="parentCategory" name="parentCategory" value="<?php echo $category['parent_category']; ?>">
                        </div>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Copy Category Modal -->
    <div class="modal fade" id="copyCategoryModal" tabindex="-1" aria-labelledby="copyCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal content goes here -->
                <div class="modal-header">
                    <h5 class="modal-title" id="copyCategoryModalLabel">Copy Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Copy category form goes here -->
                    <form action="copyCategory.php" method="POST">
                        <input type="hidden" name="categoryId" value="<?php echo $category['id']; ?>">
                        <p>Are you sure you want to copy this category?</p>
                        <button type="submit" class="btn btn-success">Copy</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
