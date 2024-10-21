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
        $formData['name'] = $_POST['name'];
    }

    // Validate the brand name
    if (empty($_POST['brand'])) {
        $errorArray['brandError'] = "Brand name is required!";
    } else {
        $formData['brand'] = $_POST['brand'];
        if (!preg_match("/^[a-zA-Z]+$/", $_POST['brand'])) {
            $errorArray['brandError'] = "Only alphabets are allowed!";
        }
    }

    // Validate the original price
    if (empty($_POST['oPrice'])) {
        $errorArray['oPriceError'] = "Product original price is required!";
    } else {
        $formData['oPrice'] = $_POST['oPrice'];
        if (!preg_match("/^[0-9]+$/", $_POST['oPrice'])) {
            $errorArray['oPriceError'] = "Only numbers are allowed!";
        }
    }

    // Validate the selling price
    if (empty($_POST['sPrice'])) {
        $errorArray['sPriceError'] = "Product selling price is required!";
    } else {
        $formData['sPrice'] = $_POST['sPrice'];
        if (!preg_match("/^[0-9]+$/", $_POST['sPrice'])) {
            $errorArray['sPriceError'] = "Only numbers are allowed!";
        }
    }

    // If there are validation errors, store them in the session and redirect back to the form
    if (!empty($errorArray)) {
        $_SESSION['errors'] = $errorArray;
        $_SESSION['formData'] = $formData;
        header("Location:add.php");
        exit();
    } else {
        try {
            // Create an instance of the Product class
            $product = new Product($conn);

            // Add product using the class method
            $productId = $product->addProduct($_POST['name'], $_POST['brand'], $_POST['oPrice'], $_POST['sPrice']);

            // Redirect to view.php with the last inserted ID
            header("Location:view.php?message=Product added successfully!&id=" . $conn->lastInsertId());;
        } catch (PDOException $e) {
            echo "Something went wrong: " . $e->getMessage();
        }
    }
}
