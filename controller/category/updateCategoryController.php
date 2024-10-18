<?php
session_start();
require_once "../dbcon.php";
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
        header("Location:../../category/addCategory.php");
        exit();
    } else {

        try {
            // Prepare and execute the SQL query
            $query = $conn->prepare("UPDATE categories SET categoryName = :categoryName WHERE categoryID= :id");

            // Bind parameters to the query
            $query->bindParam(':categoryName', $_POST['category']);
            $query->bindParam(":id", $_POST['id']);

            // Execute the query
            if ($query->execute()) {
                header("Location:../../category/categoryList.php?message=Category updated successfully!");
            } else {
                throw new Exception("Insertion failed..!");
            }
        } catch (PDOException $e) {
            echo "Something went wrong: " . $e->getMessage();
        }
    }
}
