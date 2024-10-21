<?php

require_once "../database/db.php";
require_once "Product.php";

if (isset($_GET['id'])) {

    try {
        // Create an instance of the Product class
        $product = new Product($conn);

        // Delete product using the class method
        $products = $product->viewProductDetail($_GET['id']);

        if (!$products) {
            throw new Exception("Product not found!");
            exit;
        }
    } catch (PDOException $e) {
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
        <h1>Product Details</h1>

        <!-- Display product details -->
        <div>
            <h2><?php echo htmlspecialchars($products['product_name']); ?></h2>
            <p><strong>Brand:</strong> <?php echo htmlspecialchars($products['brand']); ?></p>
            <p><strong>Original Price:</strong> ₹<?php echo htmlspecialchars($products['original_price']); ?></p>
            <p><strong>Selling Price:</strong> ₹<?php echo htmlspecialchars($products['selling_price']); ?></p>
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
    echo "No product ID provided.";
}
?>