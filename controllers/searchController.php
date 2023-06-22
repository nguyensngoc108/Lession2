<?php

require_once 'helper/db_connection.php';
require_once 'models/CategoryModel.php';

class SearchController
{
    private $conn;
    private $categoryModel;

    public function __construct($conn)
    {
        $this->conn = $conn;
        $this->categoryModel = new CategoryModel($conn);
    }

    // Search categories by name
    public function searchCategories($keyword)
    {
        // Perform the search using the CategoryModel
        $categories = $this->categoryModel->searchCategories($keyword);

        // Example: Return the search results
        return $categories;
    }
}

// Create an instance of the SearchController using the database connection
$searchController = new SearchController($conn);

// Example usage:
$categories = $searchController->searchCategories($keyword);
