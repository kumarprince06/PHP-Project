<?php
session_start();
$formData = array('category' => '');
$errors = array();

if ($_SESSION['errors']) {
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
    <title>Add Category</title>
    <style>
        .error {
            color: red;
        }
    </style>
</head>

<body>
    <h1>Add Category</h1>
    <p style="color: red;">* required fields</p>

    <form action="../controller/category/addCategoryController.php" method="post">
        <div class="addcategory" style="margin-bottom: 5px;">
            <label for="category">Product Category:</label>
            <input type="text" name="category" value="<?php echo htmlspecialchars($formData['category']); ?>" id="category">
            <span class="error">* <?php echo $errors['categoryError'] ?? ""; ?></span>
        </div>
        <button type="submit" name="submit">Add Category</button>
    </form>
</body>

</html>