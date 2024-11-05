<?php require APPROOT . '/views/includes/header.php'; ?>

<h1>Product Listing</h1>
<a href="<?php echo URLROOT ?>/productController/add"><button style="margin-bottom: 10px;">Add Product</button></a>
<a href="<?php echo URLROOT ?>"><button style="margin-bottom: 10px;">Home</button></a>
<?php echo flashMessage('successMessage'); ?>
<?php echo flashErrorMessage('errorMessage'); ?>
<table style="width:100%; text-align:center;">
    <thead>
        <tr>
            <th>Id</th>
            <th>Product Name</th>
            <th>Brand Name</th>
            <th>Original Price</th>
            <th>Selling Price</th>
            <th>Product Type</th>
            <th>Category</th>
            <th>Stock</th>
            <th>Operations</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Loop through the products array and display each product
        foreach ($data['products'] as $product) : ?>
            <tr>
                <td><?php echo $product->id ?></td>
                <td><?php echo $product->name ?></td>
                <td><?php echo $product->brand ?></td>
                <td>Rs <?php echo $product->original_price ?></td>
                <td>Rs <?php echo $product->selling_price ?></td>
                <td> <?php echo $product->type ?> </td>
                <td><?php echo $product->category_name; ?> </td>
                <td><?php echo $product->stock; ?> </td>
                <td>
                    <a href='<?php echo URLROOT ?>/productController/show/<?php echo $product->id ?>'><button>View</button></a>
                    <?php if ($_SESSION['sessionData']['role'] == 'admin') : ?>
                        <a href='<?php echo URLROOT ?>/productController/edit/<?php echo $product->id ?>'><button>Edit</button></a>

                        <!-- Form for delete operation using POST method -->
                        <form action="<?php echo URLROOT ?>/productController/delete/<?php echo $product->id ?>" method="POST" style="display:inline;">
                            <button type="submit" onclick="return confirm('Are you sure you want to delete this product?');">Delete</button>
                        </form>
                    <?php else: ?>
                        <!-- Form for delete operation using POST method -->
                        <form action="<?php echo URLROOT; ?>/userController/addToWishlist/<?php echo $product->id; ?>" method="POST" style="display:inline;">
                            <button type="submit">Add To Wishlist</button>
                        </form>
                        <!-- Form for delete operation using POST method -->
                        <form action="<?php echo URLROOT; ?>/cartController/addToCart/<?php echo $product->id; ?>" method="POST" style="display:inline;">
                            <button type="submit">Add To Cart</button>
                        </form>
                    <?php endif; ?>

                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require APPROOT . '/views/includes/footer.php'; ?>