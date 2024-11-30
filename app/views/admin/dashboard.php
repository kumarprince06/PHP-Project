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
                    <a href="#" class="card bg-primary text-white text-center p-3">
                        <h4>Total Products</h4>
                        <p><?php echo $data['productCount'] ?></p>
                    </a>
                </div>
                <!-- Total Revenue -->
                <div class="col-lg-4 col-md-4 col-sm-4">
                    <a href="#" class="card bg-info text-white text-center p-3">
                        <h4>Total Revenue</h4>
                        <p>
                            <?php

                            if (isset($data['yearly'][0]) && is_array($data['yearly'])) {
                                echo '₹' . number_format($data['yearly'][0]->revenue, 2);
                            } else {
                                echo '₹0.00';
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
                                    <tr>
                                        <td>1</td>
                                        <td>John Doe</td>
                                        <td>Amazon Echo</td>
                                        <td>2</td>
                                        <td><span class="badge bg-success">Delivered</span></td>
                                        <td><a href="#" class="btn btn-sm btn-info">View</a></td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Jane Smith</td>
                                        <td>AMD Processor</td>
                                        <td>1</td>
                                        <td><span class="badge bg-warning">Pending</span></td>
                                        <td><a href="#" class="btn btn-sm btn-info">View</a></td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Chris Lee</td>
                                        <td>Alexa Device</td>
                                        <td>4</td>
                                        <td><span class="badge bg-danger">Cancelled</span></td>
                                        <td><a href="#" class="btn btn-sm btn-info">View</a></td>
                                    </tr>
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
                            <h6 class="mb-0">Sales Performance</h6>
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