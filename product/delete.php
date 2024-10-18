<?php
require_once "../database/db.php";

// Check if the id is set in the URL
if (isset($_GET['id'])) {

    echo "$product_id";
    // Prepare statement to delete the product
    $delete_query = $conn->prepare("DELETE FROM products WHERE id = :id");
    $delete_query->bindParam(':id', $_GET['id']);

    if ($delete_query->execute()) {
        header("Location:index.php?message=Product deleted successfully!");
        exit();
    } else {
        echo "Error deleting product!";
    }
} else {
    echo "Invalid request!";
    exit();
}
