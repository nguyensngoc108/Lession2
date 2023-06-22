<?php
require_once 'helper/db_connection.php';
require_once 'models/CategoryModel.php';

// Retrieve category data from the database
$categoryModel = new CategoryModel();
$categories = $categoryModel->getAllCategories();

?>

<!DOCTYPE html>
<html>
<head>
    <title>Category Hierarchy</title>
    <!-- Include necessary CSS and JS libraries -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.0/js/bootstrap.bundle.min.js"></script>
</head>
<body>

    <!-- Category Hierarchy Page Content -->
    <div class="container">
        <h1>Category Hierarchy</h1>
        
        <!-- Display Category Hierarchy -->
        <div class="card">
            <div class="card-header">
                Category Hierarchy
            </div>
            <div class="card-body">
                <?php
                // Display the category hierarchy using a recursive function or loop
                // Example:
                function displayCategoryHierarchy($categories, $parentCategoryId = 0, $indentation = 0) {
                    foreach ($categories as $category) {
                        if ($category['parent_id'] == $parentCategoryId) {
                            echo str_repeat('&nbsp;', $indentation * 4);
                            echo $category['name'] . "<br>";
                            displayCategoryHierarchy($categories, $category['id'], $indentation + 1);
                        }
                    }
                }
                // Call the displayCategoryHierarchy function with the category data
                displayCategoryHierarchy($categories);
                ?>
            </div>
        </div>
        
    </div>

</body>
</html>
