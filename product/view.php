<?php

require_once "../database/db.php";

if (isset($_GET['id'])) {

    try {
        // Prepare statement to get product details by id
        $query = $conn->prepare("SELECT * FROM products WHERE id = :id");
        $query->bindParam(":id", $_GET['id']);
        $query->execute();

        // Fetch product as an associative array
        $product = $query->fetch(PDO::FETCH_ASSOC);

        if (!$product) {
            throw new Exception("Product not found!");
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
        <h1>Product Details</h1>

        <!-- Display product details -->
        <div>
            <h2><?php echo htmlspecialchars($product['product_name']); ?></h2>
            <p><strong>Brand:</strong> <?php echo htmlspecialchars($product['brand']); ?></p>
            <p><strong>Original Price:</strong> ₹<?php echo htmlspecialchars($product['original_price']); ?></p>
            <p><strong>Selling Price:</strong> ₹<?php echo htmlspecialchars($product['selling_price']); ?></p>
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