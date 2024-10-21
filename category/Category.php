<?php

class Category
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function addCategory($categoryName)
    {
        try {
            // Prepare and execute the SQL query
            $query = $this->conn->prepare("INSERT INTO categories (categoryName) VALUES (:product_category)");

            // Bind parameters to the query
            $query->bindParam(':product_category', $categoryName);

            if ($query->execute()) {
                return $this->conn->lastInsertId();
            }
        } catch (PDOException $e) {
            throw new Exception("Category adding failed: " . $e->getMessage());
        }
    }

    public function updateCategory($categoryId, $categoryName)
    {
        try {
            // Prepare and execute the SQL query
            $query = $this->conn->prepare("UPDATE categories SET categoryName=:categoryName WHERE categoryId=:categoryId");

            // Bind parameters to the query
            // Bind parameters to the query
            $query->bindParam(':categoryName', $categoryName);
            $query->bindParam(":categoryId", $categoryId, PDO::PARAM_INT);

            if ($query->execute()) {
                return "Product updated successfully..!";
            }
        } catch (PDOException $e) {
            throw new Exception("Category updating failed: " . $e->getMessage());
        }
    }

    public function deleteCategory($categoryId)
    {
        try {
            $delete_query = $this->conn->prepare("DELETE FROM categories WHERE categoryId = :id");
            $delete_query->bindParam(':id', $categoryId);
            if ($delete_query->execute()) {
                return "Category deleted successfully.!";
            }
        } catch (PDOException $e) {
            throw new Exception("Category deleting failed: " . $e->getMessage());
        }
    }

    public function viewCategory($categoryId)
    {
        try {
            $query = $this->conn->prepare("SELECT * FROM categories WHERE categoryId = :id");
            $query->bindParam(':id', $categoryId);
            if ($query->execute()) {
                return
                    $query->fetch(PDO::FETCH_ASSOC);
            }
        } catch (PDOException $e) {
            throw new Exception("Category deleting failed: " . $e->getMessage());
        }
    }
}
