<?php
session_start();
$formData = array('name' => '', 'brand' => '', 'oPrice' => '', 'sPrice' => '');
$errors = array();

// Check if there are errors in the session
if (isset($_SESSION['errors'])) {
    $errors = $_SESSION['errors'];

    // Retrieve form data if available
    $formData = $_SESSION['formData'] ?? $formData;

    // Clear session errors after displaying
    unset($_SESSION['errors']);
    unset($_SESSION['formData']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <style>
        .error {
            color: red;
        }
    </style>
</head>

<body>
    <h1 style="text-align: center;">Add Product</h1>
    <p style="color: red;">* required fields</p>
    <form action="create.php" method="post">
        <div class="addproduct" style="margin-bottom: 5px;">
            <label for="name">Product Name:</label>
            <input type="text" name="name" value="<?php echo htmlspecialchars($formData['name']); ?>" id="name">
            <span class="error">* <?php echo $errors['nameError'] ?? ""; ?></span>
        </div>

        <div class="addproduct" style="margin-bottom: 5px;">
            <label for="brand">Brand Name:</label>
            <input type="text" name="brand" value="<?php echo htmlspecialchars($formData['brand']); ?>" id="brand">
            <span class="error">* <?php echo $errors['brandError'] ?? ""; ?></span>
        </div>

        <div class="addproduct" style="margin-bottom: 5px;">
            <label for="oPrice">Original Price:</label>
            <input type="number" name="oPrice" value="<?php echo htmlspecialchars($formData['oPrice']); ?>" id="oPrice">
            <span class="error">* <?php echo $errors['oPriceError'] ?? ""; ?></span>
        </div>

        <div class="addproduct" style="margin-bottom: 5px;">
            <label for="sPrice">Selling Price:</label>
            <input type="number" name="sPrice" value="<?php echo htmlspecialchars($formData['sPrice']); ?>" id="sPrice">
            <span class="error">* <?php echo $errors['sPriceError'] ?? ""; ?></span>
        </div>

        <button type="submit" name="submit">Submit</button>
        <button type="reset">Reset</button>
    </form>
</body>

</html>