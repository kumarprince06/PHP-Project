<?php

session_start();
require_once "../controller/dbcon.php";

$formData = array('category' => '');
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
    if (empty($formData['category'])) {
        // Prepare and execute the query to fetch product details
        $query = $conn->prepare("SELECT * FROM categories WHERE categoryId = :id");
        $query->bindParam(':id', $_GET['id']);
        $query->execute();
        $category = $query->fetch(PDO::FETCH_ASSOC);

        // Populate formData from the database if no form data in session
        if ($category) {
            $formData['category'] = $category['categoryName'];
            $formData['categoryId'] = $category['categoryId'];
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Category</title>
    <style>
        .error {
            color: red;
        }
    </style>
</head>

<body>
    <h1>Update Category</h1>
    <p style="color: red;">* required fields</p>

    <form action="../controller/category/updateCategoryController.php" method="post">
        <div class="addcategory" style="margin-bottom: 5px;">
            <label for="category">Product Category:</label>
            <input type="number" hidden name="id" value="<?php echo htmlspecialchars($formData['categoryId']); ?>">
            <input type="text" name="category" value="<?php echo htmlspecialchars($formData['category']); ?>" id="category">
            <span class="error">* <?php echo $errors['categoryError'] ?? ""; ?></span>
        </div>
        <button type="submit" name="submit">Update Category</button>
    </form>
</body>

</html>