<?php
session_start();
require_once "../database/db.php";
require_once "Product.php";

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
        if (!preg_match("/^[a-zA-Z]+$/", $_POST['brand'])) {
            $errorArray['brandError'] = "Only alphabets are allowed!";
        }
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

            // Create an instance of the Product class
            $product = new Product($conn);

            // Add product using the class method
            $productMessage = $product->updateProduct($_POST['id'], $_POST['name'], $_POST['brand'], $_POST['oPrice'], $_POST['sPrice']);

            // Redirect with a success message
            header("location:index.php?message=" . $productMessage);
            exit();
        } catch (PDOException $e) {
            // Handle PDO exceptions
            echo "Something went wrong: " . $e->getMessage();
        }
    }
}
