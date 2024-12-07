<!-- Admin Dashboard -->

<?php require APPROOT . '/views/admin/header.php'; ?>
<!-- main -->
<main id="main">
    <div class="container-fluid table-index">
        <div class="row g-3 justify-content-between mb-3">
            <div class="col-md-4">
                <h5>Dashboard</h5>
            </div>
        </div>

        <?php flashMessage('successMessage'); ?>
        <!-- Overview Section -->
        <section class="dash-overview mb-4">
            <div class="row g-4">
                <!-- Total Users -->
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <a href="#" class="card bg-success text-white text-center p-3">
                        <h4>Total Users</h4>
                        <p><?php echo $data['userCount'] ?></p>
                    </a>
                </div>
                <!-- Total Products -->
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <a href="#" class="card bg-warning text-white text-center p-3">
                        <h4>Total Products</h4>
                        <p><?php echo $data['productCount'] ?></p>
                    </a>
                </div>
                <!-- Total Revenue -->
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <a href="#" class="card bg-info text-white text-center p-3">
                        <h4>Total Revenue (<?php echo date('Y'); ?>)</h4>
                        <p>
                            <?php
                            if (isset($data['yearly']) && is_array($data['yearly']) && !empty($data['yearly'])) {
                                // Get the last element of the array
                                $latestRevenue = end($data['yearly']);
                                // Ensure the revenue property exists in the last element
                                if (isset($latestRevenue->revenue)) {
                                    echo '₹' . number_format($latestRevenue->revenue, 2);
                                } else {
                                    echo '₹0.00'; // Fallback if revenue isn't set
                                }
                            } else {
                                echo '₹0.00'; // Fallback for empty or invalid array
                            }
                            ?>
                        </p>

                    </a>
                </div>
            </div>
        </section>

        <!-- Chart Section -->
        <section class="revenue-charts mb-4">
            <div class="row g-4">
                <!-- Monthly Revenue Chart -->
                <div class="col-md-6">
                    <div class="card shadow-sm">
                        <div class="card-header bg-dark text-white">
                            <h6 class="mb-0">Monthly Revenue (<?php echo date('Y');  ?>)</h6>
                        </div>
                        <div class="card-body">
                            <canvas id="monthlyRevenueChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Yearly Revenue Chart -->
                <div class="col-md-6">
                    <div class="card shadow-sm">
                        <div class="card-header bg-dark text-white">
                            <h6 class="mb-0">Yearly Revenue (Last 5 Years) </h6>
                        </div>
                        <div class="card-body">
                            <canvas id="yearlyRevenueChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Recent Orders Section -->
        <section class="recent-orders mb-4">
            <div class="row g-3">
                <div class="col-md-12">
                    <div class="card shadow-sm">
                        <div class="card-header bg-dark text-white">
                            <h6 class="mb-0">Recent Orders</h6>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped rounded table-hover text-center">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Customer Name</th>
                                        <th>Amount</th>
                                        <th>Quantity</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (isset($data['OrderDetail']) && is_array($data['OrderDetail'])):
                                        $recentOrders = array_slice($data['OrderDetail'], 0, 5); // Limit to 5 orders
                                        foreach ($recentOrders as $index => $order):
                                            $statusClass = match (trim($order->status)) {
                                                'Placed' => 'btn-warning',
                                                'Dispatched' => 'btn-info',
                                                'Shipped' => 'btn-primary',
                                                'Out for delivery' => 'btn-success',
                                                'Cancelled' => 'btn-danger',
                                                'Delivered' => 'btn-secondary',
                                                default => 'btn-light',
                                            };
                                    ?>
                                            <tr>
                                                <td><?= $index + 1 ?></td>
                                                <td><?= $order->customer_name ?></td>
                                                <td>₹<?= number_format($order->order_total, 2) ?></td>
                                                <td><?= $order->total_quantity ?></td>
                                                <td>
                                                    <span class="btn btn-sm <?= $statusClass ?> rounded text-white"><?= ucfirst(trim($order->status)) ?></span>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center justify-content-center">
                                                        <!-- View Order Button -->
                                                        <button class="btn btn-sm btn-warning view-order me-2"
                                                            data-order-id="<?= $order->order_id ?>"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#orderModal"
                                                            aria-label="View details for order <?= $order->order_id ?>">
                                                            <i class="fa fa-eye"></i>
                                                        </button>
                                                        <!-- Update Order Form -->
                                                        <form action="<?= URLROOT ?>/adminController/update_order_status" method="POST" class="d-flex align-items-center">
                                                            <input type="hidden" name="order_id" value="<?= $order->order_id ?>">
                                                            <input type="hidden" name="email" value="<?= $order->customer_email ?>">
                                                            <select name="status" class="form-select form-select-sm me-2" aria-label="Update status for order <?= $order->order_id ?>">
                                                                <option value="Placed" <?= trim($order->status) == 'Placed' ? 'selected' : '' ?>>Placed</option>
                                                                <option value="Dispatched" <?= trim($order->status) == 'Dispatched' ? 'selected' : '' ?>>Dispatched</option>
                                                                <option value="Shipped" <?= trim($order->status) == 'Shipped' ? 'selected' : '' ?>>Shipped</option>
                                                                <option value="Out for delivery" <?= trim($order->status) == 'Out for delivery' ? 'selected' : '' ?>>Out for delivery</option>
                                                                <option value="Cancelled" <?= trim($order->status) == 'Cancelled' ? 'selected' : '' ?>>Cancelled</option>
                                                                <option value="Delivered" <?= trim($order->status) == 'Delivered' ? 'selected' : '' ?>>Delivered</option>
                                                            </select>
                                                            <button type="submit" class="btn btn-sm btn-primary">Update</button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="6" class="text-center">No recent orders found</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <!-- Performance Chart -->
        <section class="performance-chart">
            <div class="row g-3">
                <div class="col-md-12">
                    <div class="card shadow-sm">
                        <div class="card-header bg-dark text-white">
                            <h6 class="mb-0">Sales Performance (<?php echo date('Y'); ?>)</h6>
                        </div>
                        <div class="card-body">
                            <canvas id="salesChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Product Detail Modal -->
    <div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg mt-5">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="orderModalLabel">Order Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
<!-- main ends -->
<?php require APPROOT . '/views/admin/footer.php'; ?>