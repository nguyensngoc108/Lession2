<?php
require_once 'controllers/CategoryController.php';
require_once 'models/CategoryModel.php';

// Create an instance of the CategoryModel
$dbConnection = OpenCon();
$categoryModel = new CategoryModel($dbConnection);

// Create an instance of the CategoryController
$categoryController = new CategoryController($categoryModel);

// Retrieve the category ID from the request
$categoryId = isset($_GET['id']) ? $_GET['id'] : '';

// Retrieve the category details
$category = $categoryModel->getCategoryById($categoryId);

// Check if the category exists
if (!$category) {
    // Handle the case when the category does not exist
    echo "Category not found.";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Category Details</title>
    <link rel="stylesheet" href="assets/bootstrap/bootstrap.css">
    <style>
        /* Additional CSS styles */
    </style>
</head>
<body>
    <h1>Category Details</h1>

    <!-- Display Category Details -->
    <div>
        <h2>Category Information</h2>

        <p><strong>Code:</strong> <?php echo $category['code']; ?></p>
        <p><strong>Name:</strong> <?php echo $category['name']; ?></p>
        <p><strong>Parent Category:</strong> <?php echo $category['parent_id']; ?></p>
    </div>

    <script src="assets/bootstrap/bootstrap.js"></script>
    <script>
        // Additional JavaScript code
    </script>
</body>
</html>
