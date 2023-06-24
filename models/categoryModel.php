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

    public function getCategoryById($categoryId) {
        $sql = "SELECT * FROM categories WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $categoryId);
        $stmt->execute();
        $result = $stmt->get_result();
        $category = $result->fetch_assoc();
        $stmt->close();
        return $category;
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

    public function addCategory($code, $name, $parentId) {
        // Perform any necessary validation or data sanitization

        // Prepare the SQL statement
        $sql = "INSERT INTO categories (code, name, parent_id) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssi", $code, $name, $parentId);

        // Execute the statement
        $stmt->execute();

        // Close the statement
        $stmt->close();
    }

    public function updateCategory($categoryId, $code, $name, $parentId) {
        // Perform any necessary validation or data sanitization

        // Prepare the SQL statement
        $sql = "UPDATE categories SET code = ?, name = ?, parent_id = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssii", $code, $name, $parentId, $categoryId);

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
        $this->addCategory($category['code'], $category['name'], $category['parent_id']);

        // Close the statement and result set
        $stmt->close();
        $result->close();
    }
}
?>
