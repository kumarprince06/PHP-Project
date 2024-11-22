<?php //require APPROOT . '/views/includes/header.php';
?>
<!-- Header Section -->
<!-- <h1 style="text-align: center;">Admin Dashboard</h1>
<div style="text-align: center;">
    <a href="<?php echo URLROOT ?>/pages/index"><button type="button">Home</button></a>
    <a href="<?php echo URLROOT ?>/adminController/revenue_overview"><button type="button">Revenue Overview</button></a>
    <a href="<?php echo URLROOT ?>/adminController/order_management"><button type="button">Order Management</button></a>
</div> -->

<!-- Revenue Overview Section -->
<!-- <section id="revenue" style="text-align: center; margin-top: 30px;">
    <h2>Revenue Overview</h2>
    <table style="width: 80%; margin: 0 auto; border-collapse: collapse;">
        <thead>
            <tr>
                <th style="border: 1px solid #ddd; padding: 10px;">Today's Revenue</th>
                <th style="border: 1px solid #ddd; padding: 10px;">Current Month Revenue</th>
                <th style="border: 1px solid #ddd; padding: 10px;">Current Year Revenue</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="border: 1px solid #ddd; padding: 10px;">
                    <?php
                    $today = date('Y-m-d');
                    if (isset($data['daily'][0]) && $data['daily'][0]->order_date === $today) {
                        echo '₹' . number_format($data['daily'][0]->daily_revenue, 2);
                    } else {
                        echo '₹0.00';
                    }
                    ?>
                </td>
                <td style="border: 1px solid #ddd; padding: 10px;">
                    <?php
                    $currentYear = (int) date('Y');
                    $currentMonth = (int) date('m');
                    if (isset($data['monthly'][0]) && $data['monthly'][0]->year === $currentYear && $data['monthly'][0]->month === $currentMonth) {
                        echo '₹' . number_format($data['monthly'][0]->monthly_revenue, 2);
                    } else {
                        echo '₹0.00';
                    }
                    ?>
                </td>
                <td style="border: 1px solid #ddd; padding: 10px;">
                    
                </td>
            </tr>
        </tbody>
    </table>
</section> -->

<!-- Order Overview Section -->
<!-- <section id="orders" style="margin-top: 30px;">
    <h2 style="text-align: center;">Order Overview</h2>
    <table style="width: 80%; margin: 0 auto; border-collapse: collapse; text-align: center;">
        <thead>
            <tr>
                <th style="border: 1px solid #ddd; padding: 10px;">Today's Total Order</th>
                <th style="border: 1px solid #ddd; padding: 10px;">Current Month Total Order</th>
                <th style="border: 1px solid #ddd; padding: 10px;">Current Year Total Order</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                 Today's Total Order
                <td style="border: 1px solid #ddd; padding: 10px;">
                    <?php
                    $today = date('Y-m-d');
                    if (isset($data['dailyOrder'][0]) && $data['dailyOrder'][0]->order_date === $today) {
                        echo number_format($data['dailyOrder'][0]->daily_order_count);
                    } else {
                        echo '0';
                    }
                    ?>
                </td>

                 Current Month Total Order 
                <td style="border: 1px solid #ddd; padding: 10px;">
                    <?php
                    $currentYear = (int) date('Y');
                    $currentMonth = (int) date('m');
                    if (
                        isset($data['monthlyOrder'][0]) &&
                        $data['monthlyOrder'][0]->year === $currentYear &&
                        $data['monthlyOrder'][0]->month === $currentMonth
                    ) {
                        echo number_format($data['monthlyOrder'][0]->monthly_order_count);
                    } else {
                        echo '0';
                    }
                    ?>
                </td>

                Current Year Total Order 
                <td style="border: 1px solid #ddd; padding: 10px;">
                    <?php
                    if (
                        isset($data['yearlyOrder'][0]) &&
                        $data['yearlyOrder'][0]->year === $currentYear
                    ) {
                        echo number_format($data['yearlyOrder'][0]->yearly_order_count);
                    } else {
                        echo '0';
                    }
                    ?>
                </td>
            </tr>
        </tbody>
    </table>
</section> -->

<!-- Admin Dashboard -->



<?php //require APPROOT . '/views/includes/footer.php'; 
?>


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
                <div class="col-lg-3 col-md-3 col-sm-4">
                    <a href="#" class="card bg-success text-white text-center p-3">
                        <h4>Total Users</h4>
                        <p><?php echo $data['userCount'] ?></p>
                    </a>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-4">
                    <a href="#" class="card bg-primary text-white text-center p-3">
                        <h4>Total Products</h4>
                        <p><?php echo $data['productCount'] ?></p>
                    </a>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-4">
                    <a href="#" class="card bg-warning text-white text-center p-3">
                        <h4>Total Profits</h4>
                        <p><?php

                            if (isset($data['yearly'][0]) && $data['yearly'][0]->year === $currentYear) {
                                echo '₹' . number_format($data['yearly'][0]->yearly_revenue, 2);
                            } else {
                                echo '₹0.00';
                            }
                            ?></p>
                    </a>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-4">
                    <a href="#" class="card bg-info text-white text-center p-3">
                        <h4>Total Revenue</h4>
                        <p>
                            <?php

                            if (isset($data['yearly'][0]) && $data['yearly'][0]->year === $currentYear) {
                                echo '₹' . number_format($data['yearly'][0]->yearly_revenue, 2);
                            } else {
                                echo '₹0.00';
                            }
                            ?>
                        </p>
                    </a>
                </div>
            </div>
        </section>
        <section class="revenue-charts mb-4">
            <div class="row g-4">
                <!-- Daily Revenue Chart -->
                <div class="col-md-4">
                    <div class="card shadow-sm">
                        <div class="card-header bg-dark text-white">
                            <h6 class="mb-0">Today's Revenue</h6>
                        </div>
                        <div class="card-body">
                            <canvas id="dailyRevenueChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Monthly Revenue Chart -->
                <div class="col-md-4">
                    <div class="card shadow-sm">
                        <div class="card-header bg-dark text-white">
                            <h6 class="mb-0">Monthly Revenue</h6>
                        </div>
                        <div class="card-body">
                            <canvas id="monthlyRevenueChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Yearly Revenue Chart -->
                <div class="col-md-4">
                    <div class="card shadow-sm">
                        <div class="card-header bg-dark text-white">
                            <h6 class="mb-0">Yearly Revenue</h6>
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

        <!-- User Activity Section -->
        <section class="user-activity mb-4">
            <div class="row g-3">
                <div class="col-md-12">
                    <div class="card shadow-sm">
                        <div class="card-header bg-dark text-white">
                            <h6 class="mb-0">Recent User Activity</h6>
                        </div>
                        <div class="card-body">
                            <ul class="list-group">
                                <li class="list-group-item">John Doe logged in at 9:00 AM</li>
                                <li class="list-group-item">Jane Smith placed an order for AMD Processor</li>
                                <li class="list-group-item">Chris Lee updated his profile</li>
                                <li class="list-group-item">Alice Brown added a new address</li>
                            </ul>
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