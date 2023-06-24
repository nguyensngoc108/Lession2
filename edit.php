<?php
require_once 'database.php';
require_once 'models/CategoryModel.php';
require_once 'controllers/CategoryController.php';

// Create a database connection
$conn = OpenCon();

// Initialize the CategoryModel and CategoryController
$categoryModel = new CategoryModel($conn);
$categoryController = new CategoryController($categoryModel);

// Check if category ID is provided in the query string
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $categoryId = $_GET['id'];

    // Get the category details
    $category = $categoryModel->getCategoryById($categoryId);

    // Check if the category exists
    if ($category) {
        // Handle form submission
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Retrieve and validate the form data
            $code = $_POST['code'];
            $name = $_POST['name'];
            $parentCategory = $_POST['parent_category'];

            // Update the category
            $result = $categoryController->updateCategory($categoryId, $code, $name, $parentCategory);

            if ($result) {
                // Category updated successfully
                // Redirect to the category management page or display a success message
                header('Location: index.php');
                exit;
            } else {
                // Error occurred while updating the category
                // Display an error message or handle the error as desired
                echo 'Error occurred while updating the category.';
            }
        }

        // Get all categories for the select options
        $categories = $categoryModel->getCategories();

    } else {
        // Category not found
        // Display an error message or handle the error as desired
        echo 'Category not found.';
    }
} else {
    // Category ID not provided in the query string
    // Display an error message or handle the error as desired
    echo 'Category ID not provided.';
}

// Close the database connection
CloseCon($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Category</title>
    <link rel="stylesheet" href="assets/bootstrap.css">
    <style>
        /* Additional CSS styles */
    </style>
</head>
<body>
    <h1>Edit Category</h1>

    <!-- Edit Category Form -->
    <form action="edit.php?id=<?php echo $categoryId; ?>" method="POST">
        <div>
            <label for="code">Code:</label>
            <input type="text" name="code" id="code" value="<?php echo $category['code'] ?? ''; ?>">
        </div>
        <div>
            <label for="name">Name:</label>
            <input type="text" name="name" id="name" value="<?php echo $category['name'] ?? ''; ?>">
        </div>
        <div>
            <label for="parent_category">Parent Category:</label>
            <select name="parent_category" id="parent_category">
                <!-- Populate the select options with categories -->
                <?php foreach ($categories as $categoryItem): ?>
                    <option value="<?php echo $categoryItem['id']; ?>" <?php echo ($categoryItem['id'] === ($category['parent_category'] ?? '')) ? 'selected' : ''; ?>>
                        <?php echo $categoryItem['name']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit">Update</button>
    </form>

    <script src="assets/bootstrap.js"></script>
    <script>
        // Additional JavaScript code
    </script>
</body>
</html>
