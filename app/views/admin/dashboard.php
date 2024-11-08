<?php require APPROOT . '/views/includes/header.php'; ?>
<!-- Header Section -->
<h1 style="text-align: center;">Admin Dashboard</h1>
<div style="text-align: center;">
    <a href="<?php echo URLROOT ?>/pages/index"><button type="button">Home</button></a>
    <a href="<?php echo URLROOT ?>/adminController/revenue_overview"><button type="button">Revenue Overview</button></a>
    <a href="<?php echo URLROOT ?>/adminController/order_management"><button type="button">Order Management</button></a>
</div>

<!-- Revenue Overview Section -->
<section id="revenue" style="text-align: center; margin-top: 30px;">
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
                    // Check if there's revenue data for today
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
                    // Check if there's revenue data for the current month
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
                    <?php
                    // Check if there's revenue data for the current year
                    if (isset($data['yearly'][0]) && $data['yearly'][0]->year === $currentYear) {
                        echo '₹' . number_format($data['yearly'][0]->yearly_revenue, 2);
                    } else {
                        echo '₹0.00';
                    }
                    ?>
                </td>
            </tr>
        </tbody>
    </table>
</section>



<!-- Order Overview Section -->
<section id="orders" style="margin-top: 30px;">
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
                <!-- Today's Total Order -->
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

                <!-- Current Month Total Order -->
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

                <!-- Current Year Total Order -->
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
</section>

<?php require APPROOT . '/views/includes/footer.php'; ?>