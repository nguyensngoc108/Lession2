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
    <link rel="stylesheet" href="assets/bootstrap.css">
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <div class="container">
        <h1>Category Details</h1>

        <!-- Display Category Details -->
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Category Information</h2>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label"><strong>Code:</strong></label>
                    <div class="col-sm-10">
                        <p class="form-control-static"><?php echo $category['code']; ?></p>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label"><strong>Name:</strong></label>
                    <div class="col-sm-10">
                        <p class="form-control-static"><?php echo $category['name']; ?></p>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-2 col-form-label"><strong>Parent Category:</strong></label>
                    <div class="col-sm-10">
                        <p class="form-control-static"><?php echo $category['parent_id']; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/bootstrap.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
</body>
</html>
