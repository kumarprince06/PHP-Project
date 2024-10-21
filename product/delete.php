<?php
require_once "../database/db.php";
require_once "Product.php";

try {
    // Check if the id is set in the URL
    if (isset($_GET['id'])) {
        // Create an instance of the Product class
        $product = new Product($conn);

        // Delete product using the class method
        $productMessage = $product->deleteProduct($_GET['id']);
        header("Location: index.php?message=" . $productMessage);
        exit();
    } else {
        throw new Exception("No product ID provided.");
    }
} catch (Exception $e) {
    // Handle the exception, log it or display an error message
    echo "Error: " . $e->getMessage();
}
