<?php

require_once "../database/db.php";

if (isset($_GET['id'])) {

    try {
        // Prepare statement to get product details by id
        $query = $conn->prepare("SELECT * FROM categories WHERE categoryId = :id");
        $query->bindParam(":id", $_GET['id']);
        $query->execute();

        // Fetch product as an associative array
        $category = $query->fetch(PDO::FETCH_ASSOC);

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
            <p><strong>Category Name:</strong> <?php echo htmlspecialchars($category['categoryName']); ?></p>
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