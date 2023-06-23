<?php


require_once './categoryController.php';
require_once './paginationController.php';
require_once './parentChildController.php';
require_once './popUpController.php';
require_once './searchController.php';

require_once 'helper/db_connection.php';
require_once 'helper/saveCategory.php';

require_once 'models/categoryModel.php';
require_once 'models/childCategoryModel.php';
require_once 'models/paginationModel.php';
require_once 'models/searchModel.php';

?>

<!DOCTYPE html>
<html>
<head>
    <title>Quản lý danh mục</title>
    <!-- Add necessary stylesheets and scripts here -->
</head>
<body>
    <h1>Quản lý danh mục</h1>

    <!-- Display the list of categories -->
    <?php
        // Instantiate required objects
        $categoriesModel = new CategoryModel();
        $paginationModel = new PaginationModel();
        $categoryController = new CategoryController($categoriesModel, $paginationModel);
        
        // Retrieve categories based on pagination
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $categories = $categoryController->getCategoriesByPage($page, 10);

        // Display the categories
        foreach ($categories as $category) {
            echo "<p>{$category['code']} - {$category['name']}</p>";
            // Display child categories recursively if any
            $categoryController->displayChildCategories($category['id'], 1);
        }
    ?>

    <!-- Add category form or popup for adding/editing category -->
    <?php
        $popUpController = new PopUpController();
        // Check if an action is requested (e.g., add, edit, copy)
        if (isset($_GET['action'])) {
            $action = $_GET['action'];
            if ($action === 'add' || $action === 'edit' || $action === 'copy') {
                // Render the category form as a popup or on the page
                $categoryForm = $categoryController->renderCategoryForm($action);
                $popUpController->displayPopUp($categoryForm);
            }
        }
    ?>

    <!-- Category search functionality -->
    <form method="GET" action="searchController.php">
        <input type="text" name="search" placeholder="Search category">
        <input type="submit" value="Search">
    </form>

    <!-- Pagination links -->
    <?php
        $paginationController = new PaginationController($categoriesModel);
        $totalPages = $paginationController->getTotalPages(10);
        $paginationController->displayPaginationLinks($totalPages);
    ?>

    <!-- Add necessary scripts here -->

</body>

</html>



