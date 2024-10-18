<?php

require_once "../controller/dbcon.php";

// Prepare statement to get all the products
$query = $conn->prepare("SELECT * FROM categories");
$query->execute();

// Fetch all products as an associative array
$categories = $query->fetchAll(PDO::FETCH_ASSOC);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category List</title>
    <style>
        table,
        th,
        td {
            border: 1px solid black;
        }
    </style>
</head>

<body>
    <h1>Category List</h1>
    <a href="addCategory.php"><button style="margin-bottom: 10px;">Add Category</button></a>
    <a href="../index.php"><button style="margin-bottom: 10px;">View Product</button></a>
    <table style="width:100%; text-align:center;">
        <thead>
            <tr>
                <th>Id</th>
                <th>Category Name</th>
                <th>Operations</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Loop through the products array and display each product
            foreach ($categories as $category) {
                echo "<tr>
                            <td>{$category['categoryId']}</td>
                            <td>{$category['categoryName']}</td>
                            <td>
                                <a href='updateCategory.php?id={$category['categoryId']}'><button>Edit</button></a>
                                <a href='../controller/category/deleteCategoryController.php?id={$category['categoryId']}' onclick='return confirm(\"Are you sure you want to delete this product?\");'><button>Delete</button></a>
                            </td>
                        </tr>";
            }
            ?>
        </tbody>
    </table>

    <?php
    if (isset($_GET['message'])) {
        echo "<div style='color:green; margin-top:30px; font-size:20px; font-weight: bold;'>" . $_GET['message'] . "</div>";
    }
    ?>

</body>

</html>