<?php
require_once 'database.php';
class CategoryModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getCategoryCount($searchQuery = '') {
        $sql = "SELECT COUNT(*) AS count FROM categories";
        if (!empty($searchQuery)) {
            $sql .= " WHERE name LIKE '%" . $this->conn->real_escape_string($searchQuery) . "%'";
        }

        $result = $this->conn->query($sql);
        $count = 0;
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $count = $row['count'];
        }

        return $count;
    }

    public function getCategories($offset, $limit, $searchQuery = '') {
        $sql = "SELECT * FROM categories";
        if (!empty($searchQuery)) {
            $sql .= " WHERE name LIKE '%" . $this->conn->real_escape_string($searchQuery) . "%'";
        }
        $sql .= " LIMIT $offset, $limit";

        $result = $this->conn->query($sql);
        $categories = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $categories[] = $row;
            }
        }

        return $categories;
    }

    // Add more methods as needed for CRUD operations and other category-related functionalities
    public function addCategory($code, $name, $parentCategory) {
        // Perform any necessary validation or data sanitization
        
        // Prepare the SQL statement
        $sql = "INSERT INTO categories (code, name, parent_category) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sss", $code, $name, $parentCategory);
        
        // Execute the statement
        $stmt->execute();
        
        // Close the statement
        $stmt->close();
    }

    public function updateCategory($categoryId, $code, $name, $parentCategory) {
        // Perform any necessary validation or data sanitization
        
        // Prepare the SQL statement
        $sql = "UPDATE categories SET code = ?, name = ?, parent_category = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssi", $code, $name, $parentCategory, $categoryId);
        
        // Execute the statement
        $stmt->execute();
        
        // Close the statement
        $stmt->close();
    }

    public function copyCategory($categoryId) {
        // Retrieve the category data based on the provided category ID
        $sql = "SELECT * FROM categories WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $categoryId);
        $stmt->execute();
        $result = $stmt->get_result();
        $category = $result->fetch_assoc();
        
        // Create a new category using the retrieved data
        $this->addCategory($category['code'], $category['name'], $category['parent_category']);
        
        // Close the statement and result set
        $stmt->close();
        $result->close();
    }
}
