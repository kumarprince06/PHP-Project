<?php

class Product
{

    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function addProduct($name, $brand, $oPrice, $sPrice)
    {
        try {
            // Prepare and execute the SQL query
            $insertQuery = $this->conn->prepare("INSERT INTO products (product_name, brand, original_price, selling_price)
                                           VALUES (:product_name, :brand, :original_price, :selling_price)");

            // Bind parameters to the query
            $insertQuery->bindParam(':product_name', $name);
            $insertQuery->bindParam(':brand', $brand);
            $insertQuery->bindParam(':original_price', $oPrice);
            $insertQuery->bindParam(':selling_price', $sPrice);

            // Execute the query
            $insertQuery->execute();
            return $this->conn->lastInsertId(); // Return last inserted product ID
        } catch (PDOException $e) {
            throw new Exception("Error adding product: " . $e->getMessage());
        }
    }

    public function updateProduct($id, $name, $brand, $oPrice, $sPrice)
    {
        try {
            // Prepare the SQL query to update the product
            $update_query = $this->conn->prepare("UPDATE products SET product_name = :product_name, brand = :brand,
                                                original_price = :original_price, selling_price = :selling_price WHERE id = :id");

            // Bind the form values to the placeholders in the query
            $update_query->bindParam(':product_name', $_POST['name'], PDO::PARAM_STR);
            $update_query->bindParam(':brand', $_POST['brand'], PDO::PARAM_STR);
            $update_query->bindParam(':original_price', $_POST['oPrice'], PDO::PARAM_INT);  // Binding as integer
            $update_query->bindParam(':selling_price', $_POST['sPrice'], PDO::PARAM_INT);  // Binding as integer
            $update_query->bindParam(':id', $_POST['id'], PDO::PARAM_INT);
            // Execute the query
            if ($update_query->execute()) {
                return "Product updated successfully..!";
            }
        } catch (PDOException $e) {
            throw new Exception("Error updating product: " . $e->getMessage());
        }
    }

    public function deleteProduct($id)
    {
        try {
            // Prepare statement to delete the product
            $delete_query = $this->conn->prepare("DELETE FROM products WHERE id = :id");
            $delete_query->bindParam(':id', $_GET['id']);

            if ($delete_query->execute()) {
                # code...
                return "Product deleted successfully!";
            }
        } catch (PDOException $e) {
            throw new Exception("Error deleting product: " . $e->getMessage());
        }
    }

    public function viewProductDetail($id)
    {
        try {
            // Prepare statement to get product details by id
            $query = $this->conn->prepare("SELECT * FROM products WHERE id = :id");
            $query->bindParam(":id", $id);
            if ($query->execute()) {
                return
                    $query->fetch(PDO::FETCH_ASSOC);
            }
        } catch (PDOException $e) {
            throw new Exception("Error viewing product: " . $e->getMessage());
        }
    }
}
