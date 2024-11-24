<?php require APPROOT . '/views/user/user-header.php'; ?>
<?php echo flashMessage('successMessage'); ?>
<?php echo flashErrorMessage('errorMessage'); ?>

<?php if (empty($data['wishlist'])): ?>
    <!-- Message and button when wishlist is empty -->
    <div class="text-center py-2 border rounded bg-light">
        <p>Your wishlist is currently empty. Discover something interesting!</p>
        <a href="<?php echo URLROOT; ?>/productController/index">
            <button class="btn btn-primary">Explore Products</button>
        </a>
    </div>
<?php else: ?>
    <!-- Wishlist items table -->
    <table class="w-100 text-center table-responsive">
        <thead class="bg-dark text-light">
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
                            <button class="btn btn-success" type="submit">Add To Cart</button>
                        </form>

                        <!-- Remove from Wishlist Form -->
                        <form action="<?php echo URLROOT ?>/userController/delete/<?php echo $product->id ?>" method="POST" style="display:inline;">
                            <button class="btn btn-danger" type="submit" onclick="return confirm('Are you sure you want to delete this product?');"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<?php require APPROOT . '/views/user/user-footer.php'; ?>