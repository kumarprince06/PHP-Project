<?php

class Product
{
    private $db;
    // Form Data
    private $id;
    private $productName;
    private $productType;
    private $productBrand;
    private $productSellingPrice;
    private $productOriginalPrice;

    public function __construct()
    {
        // Instantiate Database
        $this->db = new Database;
    }

    // Getters Setters for Id
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    // Getter Setters for product name
    public function getProductName()
    {
        return $this->productName;
    }

    public function setProductName($productName)
    {
        $this->productName = $productName;
    }

    // Getter Setters for product brand
    public function getProductBrand()
    {
        return $this->productBrand;
    }

    public function setProductBrand($productBrand)
    {
        $this->productBrand = $productBrand;
    }

    // Getter Setters for product Type
    public function getProductType()
    {
        return $this->productType;
    }

    public function setProductType($productType)
    {
        $this->productType = $productType;
    }

    // Getter Setters for product Original Price
    public function getProductOriginalPrice()
    {
        return $this->productOriginalPrice;
    }

    public function setProductOriginalPrice($productOriginalPrice)
    {
        $this->productOriginalPrice = $productOriginalPrice;
    }

    // Getter Setters for product Selling Price
    public function getProductSellingPrice()
    {
        return $this->productSellingPrice;
    }

    public function setProductSellingPrice($productSellingPrice)
    {
        $this->productSellingPrice = $productSellingPrice;
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
        $this->db->query('INSERT INTO products (product_name, brand, original_price, selling_price, product_type) VALUES (:productName, :productBrand, :originalPrice, :sellingPrice, :productType)');
        $this->db->bind(':productName', $data['productName']);
        $this->db->bind(':productBrand', $data['productBrand']);
        $this->db->bind(':originalPrice', $data['originalPrice']);
        $this->db->bind(':sellingPrice', $data['sellingPrice']);
        $this->db->bind(':productType', $data['productType']);

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
        $this->db->query('UPDATE products SET product_name=:productName , brand=:productBrand, original_price=:originalPrice, selling_price=:sellingPrice, product_type=:productType WHERE id=:id');
        $this->db->bind(':productName', $data['productName']);
        $this->db->bind(':productBrand', $data['productBrand']);
        $this->db->bind(':originalPrice', $data['originalPrice']);
        $this->db->bind(':sellingPrice', $data['sellingPrice']);
        $this->db->bind(':productType', $data['productType']);
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
