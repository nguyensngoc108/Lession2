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
    // Extract the form data
    $code = $_POST['code'];
    $name = $_POST['name'];
    $parentCategory = $_POST['parent_id'];

    // Prepare the form data
    $formData = [
        'category_id' => $categoryId,
        'code' => $code,
        'name' => $name,
        'parent_id' => $parentCategory
    ];

    // Call the corresponding controller method to update the category
    $categoryController->editCategory($formData);

    // Redirect to the category management page or perform any other actions
    header("Location: CategoryManagementView.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Category</title>
    <link rel="stylesheet" href="assets/bootstrap/bootstrap.css">
    <style>
        /* Additional CSS styles */
    </style>
</head>
<body>
    <h1>Edit Category</h1>

    <form action="EditCategoryView.php?id=<?php echo $categoryId; ?>" method="POST">
        <div>
            <label for="code">Code:</label>
            <input type="text" id="code" name="code" value="<?php echo $category['code']; ?>">
        </div>
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo $category['name']; ?>">
        </div>
        <div>
            <label for="parent_id">Parent Category:</label>
            <input type="text" id="parent_id" name="parent_id" value="<?php echo $category['parent_id']; ?>">
        </div>
        <button type="submit">Save</button>
    </form>

    <script src="assets/bootstrap/bootstrap.js"></script>
    <script>
        // Additional JavaScript code
    </script>
</body>
</html>
