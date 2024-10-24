<?php

class Product
{
    private $db;

    public function __construct()
    {
        // Instantiate Database
        $this->db = new Database;
    }

    // Get All Products
    public function getAllProducts()
    {
        $this->db->query('SELECT * FROM products');
        return $this->db->resultSet(); // Return Product Result

    }

    // Add Products
    public function addProduct($data)
    {
        $this->db->query('INSERT INTO products (product_name, brand, original_price, selling_price) VALUES (:productName, :productBrand, :originalPrice, :sellingPrice)');
        $this->db->bind(':productName', $data['productName']);
        $this->db->bind(':productBrand', $data['productBrand']);
        $this->db->bind(':originalPrice', $data['originalPrice']);
        $this->db->bind(':sellingPrice', $data['sellingPrice']);

        return $this->db->executePrepareStmt() ? $this->db->lastInsertId() : false;
    }

    // View Products
    public function getProductById($id)
    {
        $this->db->query('SELECT * FROM products WHERE id=:id');
        $this->db->bind(':id', $id);

        $product = $this->db->singleResult();

        return $product;
    }

    // Update Product
    public function updateProduct($data)
    {
        $this->db->query('UPDATE products SET product_name=:productName , brand=:productBrand, original_price=:originalPrice, selling_price=:sellingPrice WHERE id=:id');
        $this->db->bind(':productName', $data['productName']);
        $this->db->bind(':productBrand', $data['productBrand']);
        $this->db->bind(':originalPrice', $data['originalPrice']);
        $this->db->bind(':sellingPrice', $data['sellingPrice']);
        $this->db->bind(':id', $data['id']);

        return $this->db->executePrepareStmt() ? true : false;
    }

    // Delete Product
    public function deletePostById($id)
    {
        $this->db->query('DELETE FROM products WHERE id = :id');

        $this->db->bind(":id", $id);

        return $this->db->executePrepareStmt() ? true : false;
    }
}
