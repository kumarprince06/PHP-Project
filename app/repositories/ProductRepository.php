<?php
class ProductRepository
{
    private $db;

    public function __construct()
    {
        $this->db = new Database(); // Assuming you have a Database class for DB connections
    }

    public function addProduct(Product $product)
    {
        $sql = "INSERT INTO products (name, brand, type, selling_price, original_price, category, stock) 
            VALUES (:name, :brand, :type, :selling_price, :original_price, :category, :stock)";
        $this->db->query($sql);
        $this->db->bind(':name', $product->getName());
        $this->db->bind(':brand', $product->getBrand());
        $this->db->bind(':selling_price', $product->getSellingPrice());
        $this->db->bind(':original_price', $product->getOriginalPrice());
        $this->db->bind(':type', $product->getType());
        $this->db->bind(':category', $product->getCategory());
        $this->db->bind(':stock', $product->getStock());
        // $this->db->bind(':image', $product->getImage());
        // Execute the query
        if ($this->db->execute()) {
            // Return the last inserted ID
            return $this->db->lastInsertId();
        } else {
            return false; // Return false if execution failed
        }
    }

    public function updateProduct(Product $product)
    {

        $sql = "UPDATE products SET name=:name, brand=:brand, type=:type, selling_price=:selling_price, original_price=:original_price, category=:category, stock=:stock, image=:image WHERE id=:id";
        $this->db->query($sql);
        $this->db->bind(':name', $product->getName());
        $this->db->bind(':brand', $product->getBrand());
        $this->db->bind(':selling_price', $product->getSellingPrice());
        $this->db->bind(':original_price', $product->getOriginalPrice());
        $this->db->bind(':type', $product->getType());
        $this->db->bind(':category', $product->getCategory());
        $this->db->bind(':stock', $product->getStock());
        // $this->db->bind(':image', $product->getImage());
        $this->db->bind(':id', $product->getId());

        // Execute the query
        return $this->db->execute();
    }

    public function deleteProduct($id)
    {
        $sql = "DELETE FROM products WHERE id = :id";
        $this->db->query($sql);
        $this->db->bind(':id', $id);

        return $this->db->execute();
    }

    public function getAllProducts()
    {
        $this->db->query("SELECT products.*, categories.name AS category_name
                      FROM products
                      LEFT JOIN categories ON products.category = categories.id");
        return $this->db->resultSet();
    }


    public function getProductById($id)
    {
        $this->db->query("SELECT products.*, categories.name AS category_name
                      FROM products
                      LEFT JOIN categories ON products.category = categories.id
                      WHERE products.id = :id");
        $this->db->bind(':id', $id);
        return $this->db->singleResult();
    }

    public function updateStock($productId, $quantity)
    {
        $query = "UPDATE products SET stock = stock - :quantity WHERE id = :product_id AND stock >= :quantity";
        $this->db->query($query);
        $this->db->bind(':product_id', $productId);
        $this->db->bind(':quantity', $quantity);

        if ($this->db->execute()) {
            return true;
        } else {
            error_log("Failed to decrease stock for Product ID: $productId");
            return false;
        }
    }

    public function getTotalProductCount()
    {
        // Query to count the total number of products
        $this->db->query('SELECT COUNT(*) as total FROM products');

        // Execute the query and fetch the result as a scalar value
        $productCount = $this->db->singleResult();

        // Ensure we're getting the scalar value from the returned object
        if (is_object($productCount)) {
            $productCount = $productCount->total;
        }

        return $productCount;
    }
}
