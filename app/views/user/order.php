<?php require APPROOT . '/views/includes/header.php'; ?>
<h1><?= $data['title']; ?></h1>
<a href="<?php echo URLROOT ?>/userController/dashboard">
    <button type="button" style="margin: 5px;">Back To Dashboard</button>
</a>
<?php flashMessage('successMessage'); ?>
<?php flashErrorMessage('errorMessage') ?>
<?php if (!empty($data['orderItems'])) : ?>
    <?php
    // Group order items by order date
    $ordersByDate = [];
    foreach ($data['orderItems'] as $item) {
        $date = date('Y-m-d', strtotime($item->order_date));
        $ordersByDate[$date][] = $item;
    }
    ?>

    <?php foreach ($ordersByDate as $orderDate => $items) : ?>
        <?php
        // Calculate total products and total amount for each order date
        $totalProducts = count($items);
        $totalAmount = array_sum(array_map(function ($item) {
            return $item->item_price * $item->quantity;
        }, $items));
        $orderStatus = $items[0]->order_status; // Assuming all items have the same order status
        ?>

        <div class="order-date-group" style="margin-bottom: 20px; padding: 10px; border: 1px solid #ccc;">
            <h2>Order Date: <?= $orderDate; ?></h2>
            <p><strong>Total Products:</strong> <?= $totalProducts; ?> |
                <strong>Order Status:</strong> <?= $orderStatus; ?> |
                <strong>Total Amount:</strong> ₹<?= number_format($totalAmount, 2); ?>
            </p>

            <table>
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Brand</th>
                        <th>Quantity</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($items as $item) : ?>
                        <tr>
                            <td><?= $item->product_name; ?></td>
                            <td><?= $item->product_brand; ?></td>
                            <td><?= $item->quantity; ?></td>
                            <td>₹<?= number_format($item->item_price, 2); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endforeach; ?>

<?php else : ?>
    <p>No orders found.</p>
<?php endif; ?>

<?php require APPROOT . '/views/includes/footer.php'; ?>