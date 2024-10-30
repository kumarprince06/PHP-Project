<?php require APPROOT . '/views/includes/header.php'; ?>

<h1>My Cart</h1>
<?php echo flashMessage('cart_success'); ?>
<?php echo flashErrorMessage('cart_error'); ?>

<a href="<?php echo URLROOT; ?>"><button>Home</button></a>
<a href="<?php echo URLROOT; ?>/user/dashboard"><button>Dashboard</button></a>

<?php if (empty($data['cartItems'])): ?>
    <!-- Display message and button when cart is empty -->
    <p>Your cart is currently empty.</p>
    <a href="<?php echo URLROOT; ?>/products/list">
        <button>Explore Products</button>
    </a>
<?php else: ?>
    <!-- Display cart items if cart is not empty -->
    <table style="width:100%; text-align:center; margin-top:5px;">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Brand</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Operation</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $totalAmount = 0; // Initialize total amount variable
            foreach ($data['cartItems'] as $item):
                $totalAmount += $item->total_price; // Calculate total amount
            ?>
                <tr>
                    <td><?php echo htmlspecialchars($item->product_name); ?></td>
                    <td><?php echo htmlspecialchars($item->brand); ?></td>
                    <td>Rs <?php echo htmlspecialchars($item->selling_price); ?></td>
                    <td>
                        <!-- Decrease Quantity Button -->
                        <form action="<?php echo URLROOT ?>/carts/decrease/<?php echo $item->cartId ?>" method="POST" style="display:inline;">
                            <button type="submit">-</button>
                        </form>
                        <?php echo htmlspecialchars($item->quantity); ?>
                        <!-- Increase Quantity Button -->
                        <form action="<?php echo URLROOT ?>/carts/increase/<?php echo $item->cartId ?>" method="POST" style="display:inline;">
                            <button type="submit">+</button>
                        </form>
                    </td>
                    <td>Rs <?php echo htmlspecialchars($item->total_price); ?></td>
                    <td><!-- Decrease Quantity Button -->
                        <form action="<?php echo URLROOT ?>/carts/delete/<?php echo $item->cartId ?>" method="POST" style="display:inline;">
                            <button type="submit">Remove</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h3>Total Amount: Rs <?php echo $totalAmount; ?></h3>

    <!-- Checkout Button -->
    <a href="<?php echo URLROOT; ?>/orders/checkout" style="text-decoration: none;">
        <button style="margin-top: 10px;">Checkout</button>
    </a>
<?php endif; ?>

<?php require APPROOT . '/views/includes/footer.php'; ?>