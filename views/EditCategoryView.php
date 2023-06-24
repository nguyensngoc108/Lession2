<!-- EditCategoryView.php -->

<?php
require_once 'controllers/CategoryController.php';
require_once 'models/CategoryModel.php';
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

    <?php
    // Check if form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Instantiate the CategoryController and CategoryModel
        $categoryModel = new CategoryModel($conn);
        $categoryController = new CategoryController($categoryModel);

        // Call the editCategory method in the controller
        $categoryController->editCategory($_POST);
    }
    ?>

    <?php
    // Check if the category ID is provided in the query string
    if (isset($_GET['category_id'])) {
        // Retrieve the category ID from the query string
        $categoryId = $_GET['category_id'];

        // Fetch the category details from the CategoryModel
        $categoryModel = new CategoryModel($conn);
        $category = $categoryModel->getCategoryById($categoryId);
    } else {
        // Redirect or handle the case when category ID is not provided
    }
    ?>

    <form action="EditCategoryView.php" method="POST">
        <input type="hidden" name="category_id" value="<?php echo $categoryId; ?>">

        <label for="code">Code:</label>
        <input type="text" name="code" id="code" value="<?php echo $category['code']; ?>" required>

        <label for="name">Name:</label>
        <input type="text" name="name" id="name" value="<?php echo $category['name']; ?>" required>

        <label for="parent_category">Parent Category:</label>
        <select name="parent_category" id="parent_category">
            <option value="">None</option>
            <?php
            // Fetch the list of categories from the CategoryModel
            $categories = $categoryModel->getCategories();

            // Iterate over the categories and display them as options in the select dropdown
            foreach ($categories as $cat) {
                $selected = ($cat['id'] == $category['parent_category']) ? 'selected' : '';
                echo '<option value="' . $cat['id'] . '" ' . $selected . '>' . $cat['name'] . '</option>';
            }
            ?>
        </select>

        <button type="submit">Save Changes</button>
    </form>

    <script src="assets/bootstrap/bootstrap.js"></script>
    <script>
        // Additional JavaScript code
    </script>
</body>
</html>
