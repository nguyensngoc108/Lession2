<!-- CopyCategoryView.php -->

<?php
require_once 'controllers/CategoryController.php';
require_once 'models/CategoryModel.php';
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

    <?php
    // Check if form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Instantiate the CategoryController and CategoryModel
        $categoryModel = new CategoryModel($conn);
        $categoryController = new CategoryController($categoryModel);

        // Call the copyCategory method in the controller
        $categoryController->copyCategory($_POST);
    }
    ?>

    <form action="CopyCategoryView.php" method="POST">
        <!-- Display the list of available categories to copy -->
        <label for="category_id">Select a Category to Copy:</label>
        <select name="category_id" id="category_id">
            <?php
            // Fetch the list of categories from the CategoryModel
            $categoryModel = new CategoryModel($conn);
            $categories = $categoryModel->getCategories();

            // Iterate over the categories and display them as options in the select dropdown
            foreach ($categories as $category) {
                echo '<option value="' . $category['id'] . '">' . $category['name'] . '</option>';
            }
            ?>
        </select>

        <button type="submit">Copy Category</button>
    </form>

    <script src="assets/bootstrap/bootstrap.js"></script>
    <script>
        // Additional JavaScript code
    </script>
</body>
</html>
