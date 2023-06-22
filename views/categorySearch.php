<?php

require_once 'helper/db_connection.php';
require_once 'models/CategoryModel.php';

// Retrieve category data from the database
$categoryModel = new CategoryModel();
$categories = $categoryModel->getAllCategories();

// Search categories by name
if (isset($_POST['search'])) {
    $searchName = $_POST['searchName'];
    $categories = $categoryModel->searchCategoriesByName($searchName);
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Category Search</title>
    <!-- Include necessary CSS and JS libraries -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.0/js/bootstrap.bundle.min.js"></script>
</head>
<body>

    <!-- Category Search Page Content -->
    <div class="container">
        <h1>Category Search</h1>
        
        <!-- Search Form -->
        <div class="card">
            <div class="card-header">
                Search Categories
            </div>
            <div class="card-body">
                <form action="categorySearch.php" method="POST">
                    <div class="mb-3">
                        <label for="searchName" class="form-label">Category Name</label>
                        <input type="text" class="form-control" id="searchName" name="searchName">
                    </div>
                    <button type="submit" name="search" class="btn btn-primary">Search</button>
                </form>
            </div>
        </div>
        
        <!-- Display Categories -->
        <div class="card mt-3">
            <div class="card-header">
                Category List
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Category Code</th>
                            <th>Category Name</th>
                            <th>Parent Category</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($categories as $category) : ?>
                            <tr>
                                <td><?php echo $category['categoryCode']; ?></td>
                                <td><?php echo $category['categoryName']; ?></td>
                                <td><?php echo $category['parentCategory']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>

</body>
</html>
