<?php
require_once 'helper/db_connection.php';

class CategoryModel
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getAllCategories($page = 1, $perPage = 10)
    {
        $offset = ($page - 1) * $perPage;
        $sql = "SELECT * FROM categories LIMIT $offset, $perPage";
        $result = $this->conn->query($sql);

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

    public function getTotalCategories()
    {
        $sql = "SELECT COUNT(*) as total FROM categories";
        $result = $this->conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            return $row['total'];
        } else {
            return 0;
        }
    }

    public function getCategoryById($categoryId)
    {
        $sql = "SELECT * FROM categories WHERE id = $categoryId";
        $result = $this->conn->query($sql);

        if ($result->num_rows == 1) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }

    public function createCategory($name, $parentId = null)
    {
        $name = $this->conn->real_escape_string($name);
        $parentId = $parentId ? intval($parentId) : 'NULL';

        $sql = "INSERT INTO categories (name, parent_id) VALUES ('$name', $parentId)";
        $result = $this->conn->query($sql);

        if ($result) {
            return $this->conn->insert_id;
        } else {
            return null;
        }
    }

    public function updateCategory($categoryId, $name)
    {
        $name = $this->conn->real_escape_string($name);

        $sql = "UPDATE categories SET name = '$name' WHERE id = $categoryId";
        $result = $this->conn->query($sql);

        return $result;
    }

    public function deleteCategory($categoryId)
    {
        $sql = "DELETE FROM categories WHERE id = $categoryId";
        $result = $this->conn->query($sql);

        return $result;
    }

    public function searchCategories($keyword)
    {
        $keyword = $this->conn->real_escape_string($keyword);
        $sql = "SELECT * FROM categories WHERE name LIKE '%$keyword%'";
        $result = $this->conn->query($sql);

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

    public function getParentCategories($categoryId)
    {
        $sql = "SELECT * FROM categories WHERE id IN (
                    SELECT parent_id FROM categories WHERE id = $categoryId
                )";
        $result = $this->conn->query($sql);

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

    public function getChildCategories($categoryId)
    {
        $sql = "SELECT * FROM categories WHERE parent_id = $categoryId";
        $result = $this->conn->query($sql);

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
