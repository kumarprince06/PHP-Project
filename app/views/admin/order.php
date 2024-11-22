<h1 style="text-align: center;">Order Management</h1>

<!-- Include Header -->
<?php require APPROOT . '/views/admin/header.php'; ?>

<!-- Main Content -->
<main id="main" class="main-content">
    <!-- Order Management Section -->
    <div class="container-fluid">
        <h4 class=" mb-3">Order Overview</h4>

        <!-- Order Table -->
        <div class="table-responsive">
            <table id="orderTable" class="table table-bordered text-center table-striped table-hover">
                <thead class="bg-dark text-white">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Order Date</th>
                        <th>Total Amount</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Check if there are orders to display
                    if (isset($data['orders']) && count($data['orders']) > 0) {
                        foreach ($data['orders'] as $order) {
                            echo '<tr>';
                            echo '<td>' . $order->order_id . '</td>';
                            echo '<td>' . $order->customer_name . '</td>';
                            echo '<td>' . $order->customer_email . '</td>';
                            echo '<td>' . date('d-m-Y', strtotime($order->order_date)) . '</td>';
                            echo '<td>₹' . number_format($order->total, 2) . '</td>';

                            // Set the background color of the button based on status
                            $statusClass = '';
                            switch ($order->status) {
                                case 'Placed':
                                    $statusClass = 'btn-warning';
                                    break;
                                case 'Dispatched':
                                    $statusClass = 'btn-info';
                                    break;
                                case 'Shipped':
                                    $statusClass = 'btn-primary';
                                    break;
                                case 'Out for delivery':
                                    $statusClass = 'btn-success';
                                    break;
                                case 'Cancelled':
                                    $statusClass = 'btn-danger';
                                    break;
                                case 'Delivered':
                                    $statusClass = 'btn-secondary';
                                    break;
                                default:
                                    $statusClass = 'btn-light';
                            }

                            // Order status with button style
                            echo '<td><button class="btn ' . $statusClass . ' btn-sm" disabled>' . ucfirst($order->status) . '</button></td>';

                            // Actions column
                            echo '<td>
                                <form action="' . URLROOT . '/adminController/update_order_status" method="POST">
                                    <input type="hidden" name="order_id" value="' . $order->order_id . '">
                                    <input type="hidden" name="email" value="' . $order->customer_email . '">
                                    <select name="status" class="form-select form-select-sm d-inline-block w-50">
                                        <option value="Placed" ' . ($order->status == 'Placed' ? 'selected' : '') . '>Placed</option>
                                        <option value="Dispatched" ' . ($order->status == 'Dispatched' ? 'selected' : '') . '>Dispatched</option>
                                        <option value="Shipped" ' . ($order->status == 'Shipped' ? 'selected' : '') . '>Shipped</option>
                                        <option value="Out for delivery" ' . ($order->status == 'Out for delivery' ? 'selected' : '') . '>Out for delivery</option>
                                        <option value="Cancelled" ' . ($order->status == 'Cancelled' ? 'selected' : '') . '>Cancelled</option>
                                        <option value="Delivered" ' . ($order->status == 'Delivered' ? 'selected' : '') . '>Delivered</option>
                                    </select>
                                    <button type="submit" class="btn btn-sm btn-primary mt-1">Update</button>
                                </form>
                              </td>';
                            echo '</tr>';
                        }
                    } else {
                        echo '<tr><td colspan="7" class="text-center">No orders found.</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<!-- Include Footer -->
<?php require APPROOT . '/views/admin/footer.php'; ?>