<?php
require_once 'controllers/CategoryController.php';
require_once 'models/CategoryModel.php';
require_once 'helpers/PaginationHelper.php';
// ... include other files as needed

// Create an instance of the CategoryModel
$dbConnection = OpenCon();
$categoryModel = new CategoryModel($dbConnection);

// Create an instance of the CategoryController
$categoryController = new CategoryController($categoryModel);

// Handle different actions based on the request
$action = isset($_GET['action']) ? $_GET['action'] : '';

switch ($action) {

    case 'edit':
        $categoryId = $_GET['id'] ?? 0;
        if (empty($categoryId)) {
            echo('Not found category');
            exit();
        }
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $formData = $_POST;
            
            // Call the corresponding controller method to edit the category
            $categoryController->editCategory($formData);
    
            // Redirect back to index.php
            header("Location: index.php");
            exit();
        } else {
            // Retrieve the category details from the model based on the category ID
            $category = $categoryModel->getCategoryById($categoryId);
            
            // Retrieve all categories for the parent category dropdown
            $categories = $categoryModel->getAllCategories();
            
            // Display the EditCategoryView
            include 'views/EditCategoryView.php';
        }
        break;
    case 'add':
        // Handle the add new category action
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $formData = $_POST;

            // Call the corresponding controller method to add the category
            $categoryController->addCategory($formData);
            echo('test');
            // Redirect or perform any other actions after adding the category
           header("Location: index.php");
        } else {
            // Display the AddCategoryView
            include 'views/AddCategoryView.php';
        }
        break;

    case 'copy':
        // Handle the copy category action
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $formData = $_POST;

            // Call the corresponding controller method to copy the category
            $categoryController->copyCategory($formData);

            // Redirect or perform any other actions after copying the category
            header("Location: index.php");
        } else {
            // Display the CopyCategoryView
            include 'views/CopyCategoryView.php';
        }
        break;

    case 'details':
        // Handle the category details action
        $categoryId = isset($_GET['id']) ? $_GET['id'] : 0;

        // Retrieve the category details from the model based on the category ID
        $category = $categoryModel->getCategoryById($categoryId);

        // Include the CategoryDetailsView file and pass the category details
        include 'views/CategoryDetailsView.php';
        break;

    default:
        // Display the CategoryManagementView

        // Retrieve the search query from the request
        $searchQuery = isset($_GET['search']) ? $_GET['search'] : '';


        // Retrieve the current page number from the request
        $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

        // Set the number of categories to display per page
        $categoriesPerPage = 10;

        // Calculate the offset for pagination
        $offset = ($currentPage - 1) * $categoriesPerPage;

        // Retrieve the total number of categories
        $totalCount = $categoryModel->getCategoryCount($searchQuery);

        // Retrieve the categories for the current page
        $categories = $categoryModel->getCategories($offset, $categoriesPerPage, $searchQuery);

        // Create an instance of the PaginationHelper
        $paginationHelper = new PaginationHelper();

        // Include the CategoryManagementView file
        include 'views/CategoryManagementView.php';
        break;
}


?>
