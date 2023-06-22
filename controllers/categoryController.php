<?php

require_once 'helper/db_connection.php';
require_once 'models/CategoryModel.php';

class CategoryController
{
    private $conn;
    private $categoryModel;

    public function __construct($conn)
    {
        $this->conn = $conn;
        $this->categoryModel = new CategoryModel($conn);
    }

    // Display category details
    public function viewCategory($categoryId)
    {
        // Get the category details using the CategoryModel
        $category = $this->categoryModel->getCategoryById($categoryId);

        // Display the category details in the view (e.g., render HTML, use a template engine)

        // Example: Return the category details
        return $category;
    }

    // Add a new category
    public function addCategory($categoryData)
    {
        // Perform validation on the category data
        // ...

        // Insert the new category using the CategoryModel
        $newCategoryId = $this->categoryModel->insertCategory($categoryData);

        // Example: Return the newly added category ID
        return $newCategoryId;
    }

    // Update a category
    public function updateCategory($categoryId, $categoryData)
    {
        // Perform validation on the category data
        // ...

        // Update the category using the CategoryModel
        $success = $this->categoryModel->updateCategory($categoryId, $categoryData);

        // Example: Return the update success status
        return $success;
    }

    // Copy a category
    public function copyCategory($categoryId)
    {
        // Copy the category using the CategoryModel
        $copiedCategoryId = $this->categoryModel->copyCategory($categoryId);

        // Example: Return the ID of the copied category
        return $copiedCategoryId;
    }

    // Search categories by name
    public function searchCategories($keyword)
    {
        // Perform the search using the CategoryModel
        $categories = $this->categoryModel->searchCategories($keyword);

        // Example: Return the search results
        return $categories;
    }

    // Get paginated categories
    public function getPaginatedCategories($page = 1, $perPage = 10)
    {
        // Get the paginated categories using the CategoryModel
        $paginatedCategories = $this->categoryModel->getPaginatedCategories($page, $perPage);

        // Example: Return the paginated categories
        return $paginatedCategories;
    }
}

// Create an instance of the CategoryController using the database connection
$categoryController = new CategoryController($conn);

// Example usage:
$category = $categoryController->viewCategory($categoryId);

$newCategoryId = $categoryController->addCategory($categoryData);

$success = $categoryController->updateCategory($categoryId, $categoryData);

$copiedCategoryId = $categoryController->copyCategory($categoryId);

$categories = $categoryController->searchCategories($keyword);

$paginatedCategories = $categoryController->getPaginatedCategories($page, $perPage);
