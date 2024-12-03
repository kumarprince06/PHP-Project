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
        $sql = "INSERT INTO products (name, brand, type, selling_price, original_price, category, stock, description) 
            VALUES (:name, :brand, :type, :selling_price, :original_price, :category, :stock, :description)";
        $this->db->query($sql);
        $this->db->bind(':name', $product->getName());
        $this->db->bind(':brand', $product->getBrand());
        $this->db->bind(':selling_price', $product->getSellingPrice());
        $this->db->bind(':original_price', $product->getOriginalPrice());
        $this->db->bind(':type', $product->getType());
        $this->db->bind(':category', $product->getCategory());
        $this->db->bind(':stock', $product->getStock());
        $this->db->bind(':description', $product->getDescription());
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

        $sql = "UPDATE products SET name=:name, brand=:brand, type=:type, selling_price=:selling_price, original_price=:original_price, category=:category, stock=:stock, description=:description WHERE id=:id";
        $this->db->query($sql);
        $this->db->bind(':name', $product->getName());
        $this->db->bind(':brand', $product->getBrand());
        $this->db->bind(':selling_price', $product->getSellingPrice());
        $this->db->bind(':original_price', $product->getOriginalPrice());
        $this->db->bind(':type', $product->getType());
        $this->db->bind(':category', $product->getCategory());
        $this->db->bind(':stock', $product->getStock());
        $this->db->bind(':description', $product->getDescription());
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
        $this->db->query("SELECT products.*, categories.name AS category_name, images.name AS image
                      FROM products
                      LEFT JOIN categories ON products.category = categories.id
                      LEFT JOIN images ON products.id = images.product_id
                      WHERE images.id = (
                          SELECT MIN(id) 
                          FROM images 
                          WHERE product_id = products.id
                      )");
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

    public function getTopSellingProduct()
    {
        $sql = "SELECT 
                    p.name AS product_name,
                    SUM(oi.quantity) AS total_quantity_ordered
                FROM 
                    order_items oi
                JOIN 
                    products p ON oi.product_id = p.id
                GROUP BY 
                    oi.product_id
                ORDER BY 
                    total_quantity_ordered DESC
                LIMIT 1";

        $this->db->query($sql);
        return $this->db->singleResult();
    }

    public function getLowAndOutOfStockCounts()
    {
        $sql = "SELECT 
                    'Low Stock' AS stock_status,
                    COUNT(*) AS product_count
                FROM 
                    products
                WHERE 
                    stock BETWEEN 1 AND 15

                UNION ALL

                SELECT 
                    'Out of Stock' AS stock_status,
                    COUNT(*) AS product_count
                FROM 
                    products
                WHERE 
                    stock = 0";

        $this->db->query($sql);
        return $this->db->resultSet();
    }

    public function searchProduct($searchQuery)
    {
        $sql = "SELECT 
                products.*,
                categories.name AS category_name,
                images.name AS image
            FROM                
                products
            LEFT JOIN               
                categories ON products.category = categories.id
            LEFT JOIN               
                images ON products.id = images.product_id
            WHERE 
                images.id = (
                    SELECT 
                        MIN(id) 
                    FROM 
                        images 
                        WHERE 
                            product_id = products.id
                )
            AND (
                products.name LIKE CONCAT('%', :searchQuery, '%') OR
                products.brand LIKE CONCAT('%', :searchQuery, '%') OR
                categories.name LIKE CONCAT('%', :searchQuery, '%')
            )";

        // Prepare the query
        $this->db->query($sql);

        // Bind the parameter
        $this->db->bind(':searchQuery', $searchQuery);

        // Execute and fetch the results
        return $this->db->resultSet();
    }
}
