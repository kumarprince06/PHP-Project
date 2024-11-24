<?php require APPROOT . '/views/user/user-header.php'; ?>

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
            <h4>Order Date: <?= $orderDate; ?></h4>
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

<!-- My Orders Tab -->
<!-- <div class="tab-pane fade" id="my-orders" role="tabpanel" aria-labelledby="my-order">
    <table id="my-orders-table" class="table table-striped table-bordered dt-responsive nowrap">
        <thead>
            <tr>
                <th>Order #</th>
                <th>Date</th>
                <th>Status</th>
                <th>Total</th>
                <th class="action">Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>#12345</td>
                <td>Nov 15, 2024</td>
                <td>Shipped</td>
                <td>$150.00</td>
                <td class="action"><a href="#" class="view-order">View Order</a></td>
            </tr>
            <tr>
                <td>#12346</td>
                <td>Nov 14, 2024</td>
                <td>Completed</td>
                <td>$199.99</td>
                <td class="action"><a href="#" class="view-order">View Order</a></td>
            </tr>
            <tr>
                <td>#12347</td>
                <td>Nov 10, 2024</td>
                <td>Pending</td>
                <td>$80.00</td>
                <td class="action"><a href="#" class="view-order">View Order</a></td>
            </tr>
        </tbody>
    </table>
</div> -->

<?php require APPROOT . '/views/user/user-footer.php'; ?>