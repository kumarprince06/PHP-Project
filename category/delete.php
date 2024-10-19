<?php
require_once "../database/db.php";


try {
    // Check if the id is set in the URL
    if (isset($_GET['id'])) {
        // Prepare statement to delete the product
        $delete_query = $conn->prepare("DELETE FROM categories WHERE categoryId = :id");
        $delete_query->bindParam(':id', $_GET['id']);

        if ($delete_query->execute()) {
            header("Location:index.php?message=Category deleted successfully!");
            exit();
        } else {
            throw new Exception("Error deleting product!");
        }
    } else {
        throw new Exception("Invalid request!");
        exit();
    }
} catch (PDOException $e) {
    // Throw exception 
    echo "Error: " . $e->getMessage();
}
