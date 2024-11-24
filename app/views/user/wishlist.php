<?php require APPROOT . '/views/user/user-header.php'; ?>

<!-- My Wishlist Tab -->
<!-- <div class="tab-pane fade" id="wishlist" role="tabpanel" aria-labelledby="wishlist-link">
    <div class="wishlist-content">
        <table id="wishlist-table" class="table table-striped table-bordered dt-responsive nowrap">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th class="action">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Product 1</td>
                    <td>$50.00</td>
                    <td class="action">
                        <a href="#" class="add-to-cart">Add to Cart</a> |
                        <a href="#" class="remove-from-wishlist">Remove</a>
                    </td>
                </tr>
                <tr>
                    <td>Product 2</td>
                    <td>$30.00</td>
                    <td class="action">
                        <a href="#" class="add-to-cart">Add to Cart</a> |
                        <a href="#" class="remove-from-wishlist">Remove</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div> -->

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

<?php require APPROOT . '/views/user/user-footer.php'; ?>