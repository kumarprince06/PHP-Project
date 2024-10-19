<?php
session_start();
require_once "../database/db.php";

// Check if the form is submitted
if (isset($_POST['submit'])) {

    // Initialize error and form data arrays
    $errorArray = array();
    $formData = array();

    // Validate the product name
    if (empty($_POST['name'])) {
        $errorArray['nameError'] = "Product name is required!";
    } else {
        $formData['name'] = htmlspecialchars($_POST['name']);
    }

    // Validate the brand name
    if (empty($_POST['brand'])) {
        $errorArray['brandError'] = "Brand name is required!";
    } else {
        $formData['brand'] = htmlspecialchars($_POST['brand']);
    }

    // Validate the original price
    if (empty($_POST['oPrice'])) {
        $errorArray['oPriceError'] = "Original price is required!";
    } else {
        $formData['oPrice'] = $_POST['oPrice'];
        if (!preg_match("/^[0-9]+(\.[0-9]{1,2})?$/", $_POST['oPrice'])) {  // Allow decimals
            $errorArray['oPriceError'] = "Enter a valid price (numbers only)!";
        }
    }

    // Validate the selling price
    if (empty($_POST['sPrice'])) {
        $errorArray['sPriceError'] = "Selling price is required!";
    } else {
        $formData['sPrice'] = $_POST['sPrice'];
        if (!preg_match("/^[0-9]+(\.[0-9]{1,2})?$/", $_POST['sPrice'])) {  // Allow decimals
            $errorArray['sPriceError'] = "Enter a valid price (numbers only)!";
        }
    }

    // If there are validation errors, store them in the session and redirect back to the form
    if (!empty($errorArray)) {
        $formData['id'] = $_POST['id'];
        $_SESSION['errors'] = $errorArray;
        $_SESSION['formData'] = $formData;
        header("Location: edit.php?id=" . $_POST['id']);  // Redirect back to form with product ID
        exit();
    } else {
        try {

            // Prepare the SQL query to update the product
            $update_query = $conn->prepare(
                "UPDATE products SET product_name = :product_name, brand = :brand,
                original_price = :original_price, selling_price = :selling_price WHERE id = :id"
            );

            // Bind the form values to the placeholders in the query
            $update_query->bindParam(':product_name', $_POST['name'], PDO::PARAM_STR);
            $update_query->bindParam(':brand', $_POST['brand'], PDO::PARAM_STR);
            $update_query->bindParam(':original_price', $_POST['oPrice'], PDO::PARAM_INT);  // Binding as integer
            $update_query->bindParam(':selling_price', $_POST['sPrice'], PDO::PARAM_INT);  // Binding as integer
            $update_query->bindParam(':id', $_POST['id'], PDO::PARAM_INT);
            // Execute the query
            $update_query->execute();
            // Redirect with a success message
            header("location:index.php?message=Product updated successfully!");
            exit();
        } catch (PDOException $e) {
            // Handle PDO exceptions
            echo "Something went wrong: " . $e->getMessage();
        }
    }
}
