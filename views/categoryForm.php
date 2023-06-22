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
    <title>Category Form</title>
    <!-- Include necessary CSS and JS libraries -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.0/js/bootstrap.bundle.min.js"></script>
</head>
<body>

    <!-- Category Form Page Content -->
    <div class="container">
        <h1>Category Form</h1>
        
        <!-- Add/Edit Category Form -->
        <div class="card">
            <div class="card-header">
                Category Information
            </div>
            <div class="card-body">
                <form action="saveCategory.php" method="POST">
                    <!-- Category fields -->
                    <div class="mb-3">
                        <label for="categoryCode" class="form-label">Category Code</label>
                        <input type="text" class="form-control" id="categoryCode" name="categoryCode">
                    </div>
                    <div class="mb-3">
                        <label for="categoryName" class="form-label">Category Name</label>
                        <input type="text" class="form-control" id="categoryName" name="categoryName">
                    </div>
                    <div class="mb-3">
                        <label for="parentCategory" class="form-label">Parent Category</label>
                        <input type="text" class="form-control" id="parentCategory" name="parentCategory">
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="#" class="btn btn-secondary" onclick="window.close();">Cancel</a>
                </form>
            </div>
        </div>
        
    </div>

</body>
</html>
