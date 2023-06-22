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
    <title>Category List</title>
    <!-- Include necessary CSS and JS libraries -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.0/js/bootstrap.bundle.min.js"></script>
</head>
<body>

    <!-- Category List Page Content -->
    <div class="container">
        <h1>Category List</h1>
        
        <!-- Display Category List -->
        <div class="card">
            <div class="card-header">
                Category List
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Category Code</th>
                            <th>Category Name</th>
                            <th>Parent Category</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($categories as $category): ?>
                            <tr>
                                <td><?php echo $category['code']; ?></td>
                                <td><?php echo $category['name']; ?></td>
                                <td><?php echo $category['parent_category']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>

</body>
</html>
