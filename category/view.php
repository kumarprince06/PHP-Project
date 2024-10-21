<?php

require_once "../database/db.php";
require_once "Category.php";
if (isset($_GET['id'])) {

    try {
        // Create an instance of the Product class
        $category = new Category($conn);

        // Delete product using the class method
        $categories = $category->viewCategory($_GET['id']);

        if (!$categories) {
            throw new Exception("Product not found!");
            exit;
        }
        if (!$category) {
            throw new Exception("Category not found!");
            exit;
        }
    } catch (PDOException $th) {
        //throw Exception
        die("Error : " . $e->getMessage());
    }

?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Product Details</title>
    </head>

    <body>
        <h1>Category Details</h1>

        <!-- Display product details -->
        <div>
            <p><strong>Category Name:</strong> <?php echo htmlspecialchars($categories['categoryName']); ?></p>
        </div>
        <a href="index.php"><button>Go back</button></a>

        <?php
        if (isset($_GET['message'])) {
            echo "<div style='color:green; margin-top:30px; font-size:20px; font-weight: bold;'>" . $_GET['message'] . "</div>";
        }
        ?>
    </body>

    </html>

<?php
} else {
    echo "No category ID provided.";
}
?>