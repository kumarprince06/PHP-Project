<?php require APPROOT . '/views/includes/header.php'; ?>
<h1 style="text-align: center;">Order Management</h1>
<!-- Navigation Buttons -->
<div style="text-align: center; margin-top: 20px;">
    <a href="<?php echo URLROOT ?>/adminController/dashboard"><button type="button">Back To Dashboard</button></a>
    <a href="<?php echo URLROOT ?>/pages/index"><button type="button">Home</button></a>
</div>

<!-- Order Management Section -->
<section id="order-management" style="margin-top: 30px; text-align: center;">
    <h2>Order Overview</h2>
    <table style="width: 80%; margin: 0 auto; border-collapse: collapse;">
        <thead>
            <tr>
                <th style="border: 1px solid #ddd; padding: 10px;">Order ID</th>
                <th style="border: 1px solid #ddd; padding: 10px;">Customer Email</th>
                <th style="border: 1px solid #ddd; padding: 10px;">Order Date</th>
                <th style="border: 1px solid #ddd; padding: 10px;">Total Amount</th>
                <th style="border: 1px solid #ddd; padding: 10px;">Status</th>
                <th style="border: 1px solid #ddd; padding: 10px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Check if there are orders to display
            if (isset($data['orders']) && count($data['orders']) > 0) {
                foreach ($data['orders'] as $order) {
                    echo '<tr>';
                    echo '<td style="border: 1px solid #ddd; padding: 10px;">' . $order->order_id . '</td>';
                    echo '<td style="border: 1px solid #ddd; padding: 10px;">' . $order->customer_email . '</td>';
                    echo '<td style="border: 1px solid #ddd; padding: 10px;">' . date('d-m-Y', strtotime($order->order_date)) . '</td>';
                    echo '<td style="border: 1px solid #ddd; padding: 10px;">₹' . number_format($order->total, 2) . '</td>';

                    // Display order status and dropdown to change it
                    echo '<td style="border: 1px solid #ddd; padding: 10px;">' . ucfirst($order->status) . '</td>';
                    echo '<td style="border: 1px solid #ddd; padding: 10px;">
                            <form action="' . URLROOT . '/adminController/update_order_status" method="POST">
                                <input type="hidden" name="order_id" value="' . $order->order_id . '">
                                <select name="status" style="padding: 5px;">
                                    <option value="Placed" ' . ($order->status == 'Placed' ? 'selected' : '') . '>Placed</option>
                                    <option value="Dispatched" ' . ($order->status == 'Dispatched' ? 'selected' : '') . '>Dispatched</option>
                                    <option value="Shipped" ' . ($order->status == 'Shipped' ? 'selected' : '') . '>Shipped</option>
                                    <option value="Out for delivery" ' . ($order->status == 'Out for delivery' ? 'selected' : '') . '>Out for delivery</option>
                                    <option value="Cancelled" ' . ($order->status == 'Cancelled' ? 'selected' : '') . '>Cancelled</option>
                                    <option value="Delivered" ' . ($order->status == 'Delivered' ? 'selected' : '') . '>Delivered</option>
                                </select>
                                <button type="submit" style="padding: 5px 10px; margin-top: 5px;">Update</button>
                            </form>
                          </td>';
                    echo '</tr>';
                }
            } else {
                echo '<tr><td colspan="6" style="text-align: center; padding: 10px;">No orders found.</td></tr>';
            }
            ?>
        </tbody>
    </table>
</section>

<?php require APPROOT . '/views/includes/footer.php'; ?>