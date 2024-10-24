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

        return $this->db->executePrepareStmt() ? true : false;
    }
}
