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
        $formData['name'] = $_POST['name'];
    }

    // Validate the brand name
    if (empty($_POST['brand'])) {
        $errorArray['brandError'] = "Brand name is required!";
    } else {
        $formData['brand'] = $_POST['brand'];
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
            // Prepare and execute the SQL query
            $query = $conn->prepare("INSERT INTO products (product_name, brand, original_price, selling_price)
                                      VALUES (:product_name, :brand, :original_price, :selling_price)");

            // Bind parameters to the query
            $query->bindParam(':product_name', $_POST['name']);
            $query->bindParam(':brand', $_POST['brand']);
            $query->bindParam(':original_price', $_POST['oPrice']);
            $query->bindParam(':selling_price', $_POST['sPrice']);

            // Execute the query
            $query->execute();
            // Redirect to view.php with the last inserted ID
            header("Location:view.php?message=Product added successfully!&id=" . $conn->lastInsertId());;
        } catch (PDOException $e) {
            echo "Something went wrong: " . $e->getMessage();
        }
    }
}
