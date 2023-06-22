<?php

require_once 'helper/db_connection.php';
require_once 'models/CategoryModel.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the category data from the form
    $categoryCode = $_POST['categoryCode'];
    $categoryName = $_POST['categoryName'];
    $parentCategory = $_POST['parentCategory'];

    // Create a new instance of the CategoryModel
    $conn = getDBConnection(); // Assuming you have a function named getDBConnection() in db_connection.php
    $categoryModel = new CategoryModel($conn);

    // Prepare the category data
    $categoryData = array(
        'categoryCode' => $categoryCode,
        'categoryName' => $categoryName,
        'parentCategory' => $parentCategory
    );

    // Insert the category using the CategoryModel
    $newCategoryId = $categoryModel->insertCategory($categoryData);

    // Check if the category insertion was successful
    if ($newCategoryId) {
        // Redirect to the category detail page or display a success message
        header('Location: views/categoryDetail.php?id=' . $newCategoryId); // Assuming you have a categoryDetail.php file to display the category details
        exit();
    } else {
        // Display an error message or redirect to an error page
        echo 'Failed to save the category.';
        exit();
    }
} else {
    // Handle invalid form submission (e.g., redirect to an error page)
    echo 'Invalid form submission.';
    exit();
}
