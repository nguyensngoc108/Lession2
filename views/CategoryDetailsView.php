<!-- CategoryDetailsView.php -->

<?php
require_once 'controllers/CategoryController.php';
require_once 'models/CategoryModel.php';
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

        <?php if ($category) { ?>
            <p><strong>Code:</strong> <?php echo $category['code']; ?></p>
            <p><strong>Name:</strong> <?php echo $category['name']; ?></p>
            <p><strong>Parent Category:</strong> <?php echo $category['parent_category']; ?></p>
        <?php } else { ?>
            <p>Category not found.</p>
        <?php } ?>
    </div>

    <script src="assets/bootstrap/bootstrap.js"></script>
    <script>
        // Additional JavaScript code
    </script>
</body>
</html>
