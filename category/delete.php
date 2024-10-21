<?php
require_once "../database/db.php";
require_once "Category.php";

try {
    // Check if the id is set in the URL
    if (isset($_GET['id'])) {
        // Craete an instance of the Category class
        $category = new Category($conn);

        // Delete category using the category class function
        $categoryDeleteMessage = $category->deleteCategory($_GET['id']);

        if ($categoryDeleteMessage) {
            header("Location:index.php?message=" . $categoryDeleteMessage);
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
