<?php require APPROOT . '/views/user/user-header.php'; ?>

<?php
flashMessage('successMessage');
flashErrorMessage('errorMessage');
?>

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

        <!-- Order Date Group -->
        <div class="order-date-group mb-4 p-3 border bg-light rounded">
            <h5>Order Date: <?= $orderDate; ?></h5>
            <p>
                <strong>Total Products:</strong> <?= $totalProducts; ?> |
                <strong>Order Status:</strong> <?= $orderStatus; ?> |
                <strong>Total Amount:</strong> ₹<?= number_format($totalAmount, 2); ?>
            </p>

            <!-- Orders Table -->
            <table class="table table-striped table-bordered dt-responsive nowrap text-center rounded custom-table">
                <thead class="bg-dark text-white">
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
    <p class="text-center">No orders found.</p>
<?php endif; ?>

<?php require APPROOT . '/views/user/user-footer.php'; ?>