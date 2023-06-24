<?php
require_once 'models/CategoryModel.php';

class CategoryController {
    private $categoryModel;

    public function __construct($categoryModel) {
        $this->categoryModel = $categoryModel;
    }

    public function addCategory($formData) {
        // Handle adding a new category
        // Extract the form data
        $code = $formData['code'];
        $name = $formData['name'];
        $parentCategory = $formData['parent_id'];

        // Perform any validation or data sanitization if needed

        // Call the corresponding model method to add the category
        $this->categoryModel->addCategory($code, $name, $parentCategory);

        // Redirect or perform any other actions after adding the category
    }

    public function editCategory($formData) {
        // Retrieve the category ID from the request
        $categoryId = $formData['category_id'];
        $code = $formData['code'];
        $name = $formData['name'];
        $parentCategory = $formData['parent_id'];
    
        $this->categoryModel->editCategory($categoryId, $code, $name, $parentCategory);
    
        // Redirect to the index.php file after editing the category
        header("Location: index.php");
    }
    



    public function copyCategory($formData) {
        // Handle copying a category
        // Extract the form data
        $categoryId = $formData['category_id'];

        // Call the corresponding model method to copy the category
        $this->categoryModel->copyCategory($categoryId);

        // Redirect or perform any other actions after copying the category
    }

    // Add more methods as needed for handling other category-related actions
}

?>
