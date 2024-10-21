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
        $formData['categoryId'] = $_POST['id'];
        if (!preg_match("/^[a-zA-Z]+$/", $_POST['category'])) {
            $errorArray['categoryError'] = "Only alphabets are allowed..!";
        }
    }

    if (!empty($errorArray)) {

        $_SESSION['errors'] = $errorArray;
        $_SESSION['formData'] = $formData;
        header("Location:edit.php");
        exit();
    } else {
        var_dump($_POST['submit']);
        try {
            // Create an instance of the class category
            $category = new Category($conn);

            // Add category using the class method
            $categoryUpdateMessage = $category->updateCategory($_POST['id'], $_POST['category']);

            // Execute the query
            if ($categoryUpdateMessage) {
                header("Location:index.php?message=" . $categoryUpdateMessage);
            } else {
                throw new Exception("Updation failed..!");
            }
        } catch (PDOException $e) {
            echo "Something went wrong: " . $e->getMessage();
        }
    }
}
