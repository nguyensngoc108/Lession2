<?php
require_once 'controllers/CategoryController.php';
require_once 'models/CategoryModel.php';

// Create an instance of the CategoryModel
$dbConnection = OpenCon();
$categoryModel = new CategoryModel($dbConnection);

// Create an instance of the CategoryController
$categoryController = new CategoryController($categoryModel);

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Extract the form data
    $code = $_POST['code'];
    $name = $_POST['name'];
    $parentCategory = $_POST['parent_category'];

    // Call the corresponding controller method to add the category
    $categoryController->addCategory(['code' => $code, 'name' => $name, 'parent_category' => $parentCategory]);

    // Redirect to the category management page or perform any other actions
    header("Location: CategoryManagementView.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Category</title>
    <link rel="stylesheet" href="assets/bootstrap/bootstrap.css">
    <style>
        /* Additional CSS styles */
    </style>
</head>
<body>
    <h1>Add Category</h1>

    <form action="AddCategoryView.php" method="POST">
        <label for="code">Code:</label>
        <input type="text" id="code" name="code" required>
        <br>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        <br>
        <label for="parent_category">Parent Category:</label>
        <input type="text" id="parent_category" name="parent_category">
        <br>
        <button type="submit">Add Category</button>
    </form>

    <script src="assets/bootstrap/bootstrap.js"></script>
    <script>
        // Additional JavaScript code
    </script>
</body>
</html>
