<?php
session_start();
require_once "../database/db.php";
require_once "Category.php";

if (isset($_POST['submit'])) {

    // Initialize error and form data arrays
    $errorArray = array();
    $formData = array();

    // Validate the category
    if (empty($_POST['category'])) {
        $errorArray['categoryError'] = "Category is required..!";
    } else {
        $formData['category'] = $_POST['category'];
        if (!preg_match("/^[a-zA-Z]+$/", $_POST['category'])) {
            $errorArray['categoryError'] = "Only alphabets are allowed..!";
        }
    }

    if (!empty($errorArray)) {
        $_SESSION['errors'] = $errorArray;
        $_SESSION['formData'] = $formData;
        header("Location:add.php");
        exit();
    } else {

        try {
            // Create an instance of the category class
            $category = new Category($conn);
            // Add category using the class method
            $categoryId = $category->addCategory($_POST['category']);
            if ($categoryId) {
                // Redirect to view.php with the last inserted ID
                header("Location:view.php?message=Category added successfully!&id=" . $categoryId);
                exit();
            }
        } catch (PDOException $e) {
            echo "Something went wrong: " . $e->getMessage();
        }
    }
}
