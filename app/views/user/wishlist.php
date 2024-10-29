<?php require APPROOT . '/views/includes/header.php'; ?>

<h1>My Wishlist</h1>
<a href="<?php echo URLROOT ?>/user/dashboard"><button style="margin-bottom: 10px;">Dashboard</button></a>
<a href="<?php echo URLROOT ?>"><button style="margin-bottom: 10px;">Home</button></a>
<?php echo flashMessage('wishlistMessage'); ?>
<table style="width:100%; text-align:center;">
    <thead>
        <tr>
            <th>Product Name</th>
            <th>Brand Name</th>
            <th>Original Price</th>
            <th>Selling Price</th>
            <th>Product Type</th>
            <th>Category</th>
            <th>Operations</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Loop through the products array and display each product
        foreach ($data['wishlist'] as $product) : ?>
            <tr>
                <td><?php echo $product->product_name; ?></td>
                <td><?php echo $product->brand; ?></td>
                <td>Rs <?php echo $product->original_price; ?></td>
                <td>Rs <?php echo $product->selling_price; ?></td>
                <td> <?php echo $product->product_type; ?> </td>
                <td><?php echo $product->category; ?></td>
                <td>
                    <?php if ($_SESSION['role'] == 'customer') : ?>
                        <a href='<?php echo URLROOT ?>/user/addToCart<?php echo $product->id ?>'><button>Add To Cart</button></a>

                        <!-- Form for delete operation using POST method -->
                        <form action="<?php echo URLROOT ?>/products/delete/<?php echo $product->id ?>" method="POST" style="display:inline;">
                            <button type="submit" onclick="return confirm('Are you sure you want to delete this product?');">Delete</button>
                        </form>
                    <?php else: ?>
                        <!-- Form for delete operation using POST method -->
                        <form action="<?php echo URLROOT; ?>/user/addToWishlist/<?php echo $product->id; ?>" method="POST" style="display:inline;">
                            <button type="submit">Add To Wishlist</button>
                        </form>
                    <?php endif; ?>

                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require APPROOT . '/views/includes/footer.php'; ?>