<?php require APPROOT . '/views/includes/header.php'; ?>

<h1>My Wishlist</h1>
<a href="<?php echo URLROOT ?>/userController/dashboard"><button style="margin-bottom: 10px;">Dashboard</button></a>
<a href="<?php echo URLROOT ?>"><button style="margin-bottom: 10px;">Home</button></a>
<?php echo flashMessage('successMessage'); ?>
<?php echo flashErrorMessage('errorMessage'); ?>

<?php if (empty($data['wishlist'])): ?>
    <!-- Message and button when wishlist is empty -->
    <p>Your wishlist is currently empty. Discover something interesting!</p>
    <a href="<?php echo URLROOT; ?>/productController/index">
        <button>Explore Products</button>
    </a>
<?php else: ?>
    <!-- Wishlist items table -->
    <table style="width:100%; text-align:center;">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Brand</th>
                <th>Original Price</th>
                <th>Selling Price</th>
                <th>Type</th>
                <th>Category</th>
                <th>Operations</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['wishlist'] as $product): ?>
                <tr>
                    <td><?php echo $product->name; ?></td>
                    <td><?php echo $product->brand; ?></td>
                    <td>Rs <?php echo $product->original_price; ?></td>
                    <td>Rs <?php echo $product->selling_price; ?></td>
                    <td><?php echo $product->type; ?></td>
                    <td><?php echo $product->category_name; ?></td>
                    <td>
                        <!-- Add to Cart Form -->
                        <form action="<?php echo URLROOT ?>/cartController/addWishlistProductToCart/<?php echo $product->id ?>" method="POST" style="display:inline;">
                            <button type="submit">Add To Cart</button>
                        </form>

                        <!-- Remove from Wishlist Form -->
                        <form action="<?php echo URLROOT ?>/userController/delete/<?php echo $product->id ?>" method="POST" style="display:inline;">
                            <button type="submit" onclick="return confirm('Are you sure you want to delete this product?');">Remove</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<?php require APPROOT . '/views/includes/footer.php'; ?>