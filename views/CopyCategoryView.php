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

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Call the corresponding controller method to copy the category
    $categoryController->copyCategory(['category_id' => $categoryId]);

    // Redirect to the category management page or perform any other actions
    header("Location: CategoryManagementView.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Copy Category</title>
    <link rel="stylesheet" href="assets/bootstrap/bootstrap.css">
    <style>
        /* Additional CSS styles */
    </style>
</head>
<body>
    <h1>Copy Category</h1>

    <form action="CopyCategoryView.php?id=<?php echo $categoryId; ?>" method="POST">
        <p>Are you sure you want to copy the category "<?php echo $category['name']; ?>"?</p>
        <button type="submit">Copy</button>
    </form>

    <script src="assets/bootstrap/bootstrap.js"></script>
    <script>
        // Additional JavaScript code
    </script>
</body>
</html>
