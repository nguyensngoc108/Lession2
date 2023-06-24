<?php
require_once 'controllers/CategoryController.php';
require_once 'models/CategoryModel.php';
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

    <!-- Add Category Form -->
    <form action="index.php" method="POST">
        <label for="code">Code:</label>
        <input type="text" name="code" id="code" required>

        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required>

        <label for="parent_category">Parent Category:</label>
        <select name="parent_category" id="parent_category">
            <option value="">None</option>
            <!-- Populate with parent categories -->
            <?php foreach ($parentCategories as $parentCategory) { ?>
                <option value="<?php echo $parentCategory['id']; ?>"><?php echo $parentCategory['name']; ?></option>
            <?php } ?>
        </select>

        <button type="submit" name="add">Add Category</button>
    </form>

    <script src="assets/bootstrap/bootstrap.js"></script>
    <script>
        // Additional JavaScript code
    </script>
</body>
</html>
