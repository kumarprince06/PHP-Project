<?php require APPROOT . '/views/includes/header.php'; ?>
<!-- Header Section -->
<h1 style="text-align: center;">Admin Dashboard</h1>
<a href="<?php echo URLROOT ?>/pages/index"><button type="button">Home</button></a>
<div style="text-align: center;">

    <a href="<?php echo URLROOT ?>/adminController/revenue_overview"><button type="button">Revenue Overview</button></a>
    <a href="<?php echo URLROOT ?>/adminController/order_management"><button type="button">Order Management</button></a>
    <a href="<?php echo URLROOT ?>/adminController/user_management"><button type="button">User Management</button></a>
</div>

<!-- Revenue Overview Section -->
<!-- Revenue Overview Section -->
<section id="revenue" style="text-align: center;">
    <h2>Revenue Overview</h2>
    <table border="1" cellpadding="5" cellspacing="0" align="center">
        <tr>
            <td>
                <h3>Today's Revenue</h3>
                <?php
                // If the daily resultset contains data, display the most recent day's revenue
                if (count($data['daily']) > 0) {
                    echo '₹' . number_format($data['daily'][0]->daily_revenue, 2);
                } else {
                    echo '₹0.00';
                }
                ?>
            </td>
            <td>
                <h3>Current Month Revenue</h3>
                <?php
                // If the monthly resultset contains data, display the most recent month's revenue
                if (count($data['monthly']) > 0) {
                    echo '₹' . number_format($data['monthly'][0]->monthly_revenue, 2);
                } else {
                    echo '₹0.00';
                }
                ?>
            </td>
            <td>
                <h3>Current Year Revenue</h3>
                <?php
                // If the yearly resultset contains data, display the most recent year's revenue
                if (count($data['yearly']) > 0) {
                    echo '₹' . number_format($data['yearly'][0]->yearly_revenue, 2);
                } else {
                    echo '₹0.00';
                }
                ?>
            </td>
        </tr>
    </table>
</section>



<!-- Order Management Section -->
<section id="orders">
    <h2>Order Management</h2>
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>User</th>
                <th>Status</th>
                <th>Total</th>
                <th>Change Status</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1001</td>
                <td>John Doe</td>
                <td>Placed</td>
                <td>₹1500.00</td>
                <td>
                    <select>
                        <option value="Placed">Placed</option>
                        <option value="Delivered">Delivered</option>
                        <option value="Dispatched">Dispatched</option>
                        <option value="Out for delivery">Out for delivery</option>
                        <option value="Cancelled">Cancelled</option>
                    </select>
                    <button>Update Status</button>
                </td>
            </tr>
            <!-- More orders can be listed here -->
        </tbody>
    </table>
</section>

<!-- User Management Section -->
<section id="users">
    <h2>User Management</h2>
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>User ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>John Doe</td>
                <td>john.doe@example.com</td>
                <td>Customer</td>
                <td><button>Change Role</button></td>
            </tr>
            <!-- More users can be listed here -->
        </tbody>
    </table>
</section>

<!-- Inventory Management Section -->
<section id="inventory">
    <h2>Inventory Management</h2>
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Stock</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>101</td>
                <td>Product 1</td>
                <td>50</td>
                <td>₹500.00</td>
                <td><button>Edit</button> <button>Delete</button></td>
            </tr>
            <!-- More products can be listed here -->
        </tbody>
    </table>
</section>

<?php require APPROOT . '/views/includes/footer.php'; ?>