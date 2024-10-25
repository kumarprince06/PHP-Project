<?php

class Category
{

    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }

    // Get All Category
    public function getAllCategory()
    {
        try {
            $this->db->query('SELECT * FROM categories');
            $categoryResult = $this->db->resultSet();

            return $categoryResult;
        } catch (PDOException $e) {
            die('Error' . $e->getMessage());
        }
    }

    // Get Category By Id
    public function getCategoryById($id)
    {
        try {
            $this->db->query('SELECT * FROM categories WHERE categoryId=:id');
            $this->db->bind(':id', $id);
            $categoryResult = $this->db->singleResult();

            return $categoryResult;
        } catch (PDOException $e) {
            die('Error' . $e->getMessage());
        }
    }

    // Add Product
    public function addCategory($data)
    {
        try {
            $this->db->query('INSERT INTO categories (categoryName) VALUES (:categoryName)');
            $this->db->bind(':categoryName', $data['categoryName']);

            return $this->db->executePrepareStmt() ? $this->db->lastInsertId() : false;
        } catch (PDOException $e) {
            die('Error' . $e->getMessage());
        }
    }


    // Update Category
    public function updateCategory($data)
    {
        $this->db->query('UPDATE categories SET categoryName=:categoryName  WHERE categoryId=:id');
        $this->db->bind(':categoryName', $data['categoryName']);
        $this->db->bind(':id', $data['id']);

        return $this->db->executePrepareStmt() ? true : false;
    }

    // Delete Category
    public function deleteCategoryById($id)
    {
        $this->db->query('DELETE FROM categories WHERE categoryId = :id');

        $this->db->bind(":id", $id);

        return $this->db->executePrepareStmt() ? true : false;
    }
}
