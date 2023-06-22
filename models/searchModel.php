<?php

require_once 'helper/db_connection.php';
require_once 'models/CategoryModel.php';

class SearchModel
{
    private $categoryModel;

    public function __construct($conn)
    {
        $this->categoryModel = new CategoryModel($conn);
    }

    // Search categories by name
    public function searchCategories($keyword)
    {
        $categories = $this->categoryModel->searchCategories($keyword);
        return $categories;
    }
}

?>
