<?php

require_once 'helper/db_connection.php';
require_once 'models/CategoryModel.php';

class ChildCategoryModel extends CategoryModel
{
    public function getChildCategories($categoryId)
    {
        $sql = "SELECT * FROM categories WHERE parent_id = $categoryId";
        $result = $this->getConnection()->query($sql);

        if ($result->num_rows > 0) {
            $categories = [];
            while ($row = $result->fetch_assoc()) {
                $categories[] = $row;
            }
            return $categories;
        } else {
            return [];
        }
    }
}

?>
