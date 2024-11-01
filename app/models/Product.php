<?php

class Product
{
    private $db;
    // Form Data
    private $id;
    private $name;
    private $type;
    private $brand;
    private $sellingPrice;
    private $originalPrice;
    private $category;

    public function __construct($data)
    {
        // Instantiate Database
        $this->db = new Database;
        $this->id = $data['id'] ?? '';
        $this->name = $data['name'] ?? '';
        $this->type = $data['type'] ?? '';
        $this->brand = $data['brand'] ?? '';
        $this->sellingPrice = $data['sellingPrice'] ?? '';
        $this->originalPrice = $data['originalPrice'] ?? '';
        $this->category = $data['category'] ?? '';
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
    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    // Getter Setters for product brand
    public function getBrand()
    {
        return $this->brand;
    }

    public function setBrand($brand)
    {
        $this->brand = $brand;
    }

    // Getter Setters for product Type
    public function getProductType()
    {
        return $this->type;
    }

    public function setProductType($type)
    {
        $this->type = $type;
    }

    // Getter Setters for product Original Price
    public function getOriginalPrice()
    {
        return $this->originalPrice;
    }

    public function setOriginalPrice($originalPrice)
    {
        $this->originalPrice = $originalPrice;
    }

    // Getter Setters for product Selling Price
    public function getSellingPrice()
    {
        return $this->sellingPrice;
    }

    public function setSellingPrice($sellingPrice)
    {
        $this->sellingPrice = $sellingPrice;
    }

    // Getter Setter for category
    public function setCategory($category)
    {
        $this->category = $category;
    }

    public function getCategory()
    {
        return $this->category;
    }

    // Get All Products
    public function getAllProducts()
    {
        $this->db->query('SELECT p.*, c.categoryName  FROM products p LEFT JOIN categories c ON p.categoryId = c.categoryId');
        return $this->db->resultSet();
    }


    // Add Products
    public function addProduct($data)
    {
        $this->db->query('INSERT INTO products (product_name, brand, original_price, selling_price, product_type, categoryId) VALUES (:productName, :productBrand, :originalPrice, :sellingPrice, :productType, :categoryId)');
        $this->db->bind(':productName', $data['productName']);
        $this->db->bind(':productBrand', $data['productBrand']);
        $this->db->bind(':originalPrice', $data['originalPrice']);
        $this->db->bind(':sellingPrice', $data['sellingPrice']);
        $this->db->bind(':productType', $data['productType']);
        $this->db->bind(':categoryId', $data['categoryId']);
        return $this->db->execute() ? $this->db->lastInsertId() : false;
    }

    // View Products
    public function getProductById($id)
    {
        // Join products with categories to get category information
        $this->db->query('SELECT products.*, categories.categoryName, categories.categoryId
                            FROM products
                            LEFT JOIN categories ON products.categoryId = categories.categoryId
                            WHERE products.id = :id
                        ');
        $this->db->bind(':id', $id);

        return $this->db->singleResult();
    }

    // Update Product
    public function updateProduct($data)
    {
        $this->db->query('UPDATE products SET product_name = :productName, brand = :productBrand, original_price = :originalPrice, selling_price = :sellingPrice, product_type = :productType, categoryId = :categoryId WHERE id = :id');

        $this->db->bind(':productName', $data['productName']);
        $this->db->bind(':productBrand', $data['productBrand']);
        $this->db->bind(':originalPrice', $data['originalPrice']);
        $this->db->bind(':sellingPrice', $data['sellingPrice']);
        $this->db->bind(':productType', $data['productType']);
        $this->db->bind(':categoryId', $data['categoryId']);  // Bind the category ID
        $this->db->bind(':id', $data['id']);

        return $this->db->execute();
    }


    // Delete Product
    public function deletePostById($id)
    {
        $this->db->query('DELETE FROM products WHERE id = :id');

        $this->db->bind(":id", $id);

        return $this->db->execute() ? true : false;
    }
}
