<?php

class CategoryRepository
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllCategories()
    {
        try {
            $this->db->query('SELECT * FROM categories');
            return $this->db->resultSet();
        } catch (PDOException $e) {
            error_log('Database Error: ' . $e->getMessage());
            return false;
        }
    }

    public function getCategoryById($id)
    {
        try {
            $this->db->query('SELECT * FROM categories WHERE categoryId = :id');
            $this->db->bind(':id', $id);
            return $this->db->singleResult();
        } catch (PDOException $e) {
            error_log('Database Error: ' . $e->getMessage());
            return false;
        }
    }

    public function addCategory(Category $category)
    {
        try {
            $this->db->query('INSERT INTO categories (categoryName) VALUES (:categoryName)');
            $this->db->bind(':categoryName', $category->getCategoryName());

            if ($this->db->execute()) {
                return $this->db->lastInsertId();
            }
            return false;
        } catch (PDOException $e) {
            error_log('Database Error: ' . $e->getMessage());
            return false;
        }
    }

    public function updateCategory(Category $category)
    {
        try {
            $this->db->query('UPDATE categories SET categoryName = :categoryName WHERE categoryId = :id');
            $this->db->bind(':categoryName', htmlspecialchars($category->getCategoryName()));
            $this->db->bind(':id', $category->getId());

            return $this->db->execute();
        } catch (PDOException $e) {
            error_log('Database Error: ' . $e->getMessage());
            return false;
        }
    }

    public function deleteCategoryById($id)
    {
        try {
            $this->db->query('DELETE FROM categories WHERE categoryId = :id');
            $this->db->bind(':id', $id);
            return $this->db->execute();
        } catch (PDOException $e) {
            error_log('Database Error: ' . $e->getMessage());
            return false;
        }
    }
}
