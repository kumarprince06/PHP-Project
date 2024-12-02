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
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Customer Name</th>
                                        <th>Product</th>
                                        <th>Quantity</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // var_dump($data['OrderDetail']);
                                    // Limit orders to 5
                                    if (isset($data['OrderDetail']) && is_array($data['OrderDetail'])):
                                        $recentOrders = array_slice($data['OrderDetail'], 0, 5); // Get only the first 5
                                        foreach ($recentOrders as $index => $order): ?>
                                            <tr>
                                                <td><?= $index + 1 ?></td>
                                                <td><?= $order->user_name ?></td>
                                                <td>₹<?= number_format($order->total, 2) ?></td>
                                                <td>
                                                    <span class="badge bg-success"><?= $order->order_status ?></span>
                                                </td>
                                                <td>
                                                    <button class="btn btn-sm btn-info view-order"
                                                        data-order="<?= htmlspecialchars(json_encode($order)) ?>"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#orderModal">
                                                        View
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="5" class="text-center">No recent orders found</td>
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
</main>
<!-- main ends -->
<?php require APPROOT . '/views/admin/footer.php'; ?>