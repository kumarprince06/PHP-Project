<h1 style="text-align: center;">Order Management</h1>

<!-- Include Header -->
<?php require APPROOT . '/views/admin/header.php'; ?>

<!-- Main Content -->
<main id="main" class="main-content">
    <!-- Order Management Section -->
    <div class="container-fluid">
        <h4 class=" mb-3 fs-1 text-center">Order Overview</h4>

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
                            echo '<td>₹' . number_format($order->order_total, 2) . '</td>';

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
                                     <div class="d-flex align-items-center justify-content-center">
                                        <!-- View Order Button -->
                                        <button class="btn btn-sm btn-warning view-order me-2"
                                            data-order-id="' . $order->order_id . '"
                                            data-bs-toggle="modal"
                                            data-bs-target="#orderModal"
                                            aria-label="View details for order ' . $order->order_id . '">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                        <!-- Update Order Form -->
                                        <form action="' . URLROOT . '/adminController/update_order_status" method="POST" class="d-flex align-items-center">
                                            <input type="hidden" name="order_id" value="' . $order->order_id . '">
                                            <input type="hidden" name="email" value="' . $order->customer_email . '">
                                            <select name="status" class="form-select form-select-sm " aria-label="Update status for order ' . $order->order_id . '">
                                                <option value="Placed" ' . (trim($order->status) == 'Placed' ? 'selected' : '') . '>Placed</option>
                                                <option value="Dispatched" ' . (trim($order->status) == 'Dispatched' ? 'selected' : '') . '>Dispatched</option>
                                                <option value="Shipped" ' . (trim($order->status) == 'Shipped' ? 'selected' : '') . '>Shipped</option>
                                                <option value="Out for delivery" ' . (trim($order->status) == 'Out for delivery' ? 'selected' : '') . '>Out for delivery</option>
                                                <option value="Cancelled" ' . (trim($order->status) == 'Cancelled' ? 'selected' : '') . '>Cancelled</option>
                                                <option value="Delivered" ' . (trim($order->status) == 'Delivered' ? 'selected' : '') . '>Delivered</option>
                                            </select>
                                            <button type="submit" class="btn btn-sm btn-primary">Update</button>
                                        </form>
                                    </div>
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
    <!-- Product Detail Modal -->
    <div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg mt-5">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title" id="orderModalLabel">Order Details</h5>
                    <button type="button" class="btn-close text-light" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Table for product details -->
                    <div class="table-responsive">
                        <table class="table table-striped text-center">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Total Price</th>
                                    <th>Image</th>
                                </tr>
                            </thead>
                            <tbody id="productDetailsTable">
                                <!-- Dynamically populated -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    <?php echo URLROOT; ?>
</script>

<!-- Include Footer -->
<?php require APPROOT . '/views/admin/footer.php'; ?>