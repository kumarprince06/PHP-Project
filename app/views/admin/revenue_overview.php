<?php require APPROOT . '/views/includes/header.php'; ?>
<h1 style="text-align: center;">Revenue Overview</h1>
<a href="<?php echo URLROOT ?>/adminController/dashboard"><button type="button">Back To Dashboard</button></a>
<a href="<?php echo URLROOT ?>/pages/index"><button type="button">Home</button></a>
<!-- Daily Revenue Section -->
<section id="daily-revenue" style="margin-bottom: 40px;">
    <h2 style="text-align: center;">Daily Revenue</h2>
    <table border="1" cellpadding="5" cellspacing="0" align="center" style="width: 80%; margin: 0 auto; text-align: center;">
        <thead>
            <tr>
                <th>Date</th>
                <th>Revenue</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Check if daily revenue data exists
            if (count($data['daily']) > 0) {
                // Loop through each day and display revenue
                foreach ($data['daily'] as $daily) {
                    echo "<tr>";
                    echo "<td>" . date('Y-m-d', strtotime($daily->order_date)) . "</td>";
                    echo "<td>₹" . number_format($daily->daily_revenue, 2) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='2'>No data available for daily revenue.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</section>

<!-- Monthly Revenue Section -->
<section id="monthly-revenue" style="margin-bottom: 40px;">
    <h2 style="text-align: center;">Monthly Revenue</h2>
    <table border="1" cellpadding="5" cellspacing="0" align="center" style="width: 80%; margin: 0 auto; text-align: center;">
        <thead>
            <tr>
                <th>Year</th>
                <th>Month</th>
                <th>Revenue</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Check if monthly revenue data exists
            if (isset($data['monthly']) && count($data['monthly']) > 0) {
                // Loop through each month and display revenue
                foreach ($data['monthly'] as $monthly) {
                    echo "<tr>";
                    echo "<td>" . $monthly->year . "</td>";
                    echo "<td>" . date('F', mktime(0, 0, 0, $monthly->month, 10)) . "</td>";  // Display month name
                    echo "<td>₹" . number_format($monthly->monthly_revenue, 2) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No data available for monthly revenue.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</section>

<!-- Yearly Revenue Section -->
<section id="yearly-revenue">
    <h2 style="text-align: center;">Yearly Revenue</h2>
    <table border="1" cellpadding="5" cellspacing="0" align="center" style="width: 80%; margin: 0 auto; text-align: center;">
        <thead>
            <tr>
                <th>Year</th>
                <th>Revenue</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Check if yearly revenue data exists
            if (isset($data['yearly']) && count($data['yearly']) > 0) {
                // Loop through each year and display revenue
                foreach ($data['yearly'] as $yearly) {
                    echo "<tr>";
                    echo "<td>" . $yearly->year . "</td>";
                    echo "<td>₹" . number_format($yearly->yearly_revenue, 2) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='2'>No data available for yearly revenue.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</section>

<?php require APPROOT . '/views/includes/footer.php'; ?>