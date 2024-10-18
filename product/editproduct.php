<?php
session_start();
require_once "../controller/dbcon.php";

$formData = array('name' => '', 'brand' => '', 'oPrice' => '', 'sPrice' => '');
$errors = array();

// Check if there are errors in the session
if (isset($_SESSION['errors'])) {
    $errors = $_SESSION['errors'];
    $formData = $_SESSION['formData'] ?? $formData;
    unset($_SESSION['errors'], $_SESSION['formData']);
}

// Check if the product ID is set in the URL
if (isset($_GET['id'])) {

    // Only fetch product data from the database if there is no form data in the session
    if (empty($formData['name']) && empty($formData['brand']) && empty($formData['oPrice']) && empty($formData['sPrice'])) {
        // Prepare and execute the query to fetch product details
        $query = $conn->prepare("SELECT * FROM products WHERE id = :id");
        $query->bindParam(':id', $_GET['id']);
        $query->execute();
        $product = $query->fetch(PDO::FETCH_ASSOC);

        // Populate formData from the database if no form data in session
        if ($product) {
            $formData['name'] = $product['product_name'];
            $formData['brand'] = $product['brand'];
            $formData['oPrice'] = $product['original_price'];
            $formData['sPrice'] = $product['selling_price'];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
</head>

<body>
    <h1 style="text-align: center;">Update Product</h1>
    <p style="color: red;">* Required fields</p>

    <form action="../controller/product/updateProduct_controller.php" method="post">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($product_id); ?>">

        <div class="form-group" style="margin-bottom: 10px;">
            <label for="name">Product Name:</label>
            <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($formData['name']); ?>">
            <span style="color: red;">* <?php echo $errors['nameError'] ?? ""; ?></span>
        </div>

        <div class="form-group" style="margin-bottom: 10px;">
            <label for="brand">Brand Name:</label>
            <input type="text" name="brand" id="brand" value="<?php echo htmlspecialchars($formData['brand']); ?>">
            <span style="color: red;">* <?php echo $errors['brandError'] ?? ""; ?></span>
        </div>

        <div class="form-group" style="margin-bottom: 10px;">
            <label for="oPrice">Original Price:</label>
            <input type="number" name="oPrice" id="oPrice" value="<?php echo htmlspecialchars($formData['oPrice']); ?>">
            <span style="color: red;">* <?php echo $errors['oPriceError'] ?? ""; ?></span>
        </div>

        <div class="form-group" style="margin-bottom: 10px;">
            <label for="sPrice">Selling Price:</label>
            <input type="number" name="sPrice" id="sPrice" value="<?php echo htmlspecialchars($formData['sPrice']); ?>">
            <span style="color: red;">* <?php echo $errors['sPriceError'] ?? ""; ?></span>
        </div>

        <button type="submit" name="submit">Update</button>
        <button type="reset">Reset</button>
    </form>
</body>

</html>