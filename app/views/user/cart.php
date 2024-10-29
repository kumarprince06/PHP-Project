<?php require APPROOT . '/views/includes/header.php'; ?>

<h1>My Cart</h1>
<?php echo flashMessage('cart_success'); ?>
<?php echo flashErrorMessage('cart_error'); ?>

<a href="<?php echo URLROOT; ?>"><button>Home</button></a>
<a href="<?php echo URLROOT; ?>/user/dashboard"><button>Dashboard</button></a>

<table style="width:100%; text-align:center; margin-top:5px;">
    <thead>
        <tr>
            <th>Product Name</th>
            <th>Brand</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total Price</th>
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
                <td><?php echo htmlspecialchars($item->quantity); ?></td>
                <td>Rs <?php echo htmlspecialchars($item->total_price); ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<h3>Total Amount: Rs <?php echo $totalAmount; ?></h3>

<!-- Checkout Button -->
<a href="<?php echo URLROOT; ?>/orders/checkout" style="text-decoration: none;">
    <button style="margin-top: 10px;">Checkout</button>
</a>

<?php require APPROOT . '/views/includes/footer.php'; ?>