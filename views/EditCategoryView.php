<?php
require_once 'controllers/CategoryController.php';
require_once 'models/CategoryModel.php';

// Create an instance of the CategoryModel
$dbConnection = OpenCon();
$categoryModel = new CategoryModel($dbConnection);

// Create an instance of the CategoryController
$categoryController = new CategoryController($categoryModel);

// Check if the category ID is provided in the request
$categoryId = isset($_GET['id']) ? $_GET['id'] : 0;

// Retrieve the category details from the model based on the category ID
$category = $categoryModel->getCategoryById($categoryId);

// Handle the form submission if the request method is POST
if (!empty($_POST)) {
   $formData = $_POST;

    $categoryController->editCategory($formData);

    echo('test');
    exit();
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Edit Category</title>
    <link rel="stylesheet" href="assets/bootstrap.css">
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <h1>Edit Category</h1>

    <form action="?action=edit&id=<?=$_GET['id']?>" method="POST">
        <input type="hidden" name="category_id" value="<?php echo $category['id']; ?>">
        <label for="code">Code:</label>
        <input type="text" name="code" value="<?php echo $category['code']; ?>"><br><br>
        <label for="name">Name:</label>
        <input type="text" name="name" value="<?php echo $category['name']; ?>"><br><br>
        <label for="parent_id">Parent Category:</label>
        <select name="parent_id">
            <option value="0">None</option>
            <?php foreach ($categories as $cat) { ?>
                <option value="<?php echo $cat['id']; ?>" <?php if ($cat['id'] == $category['parent_id']) echo 'selected'; ?>>
                    <?php echo $cat['name']; ?>
                </option>
            <?php } ?>
        </select><br><br>
        <button type="submit">Save</button>
    </form>

    <script src="assets/bootstrap.js"></script>
</body>
</html>
