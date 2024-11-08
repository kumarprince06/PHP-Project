<?php require APPROOT . '/views/includes/header.php'; ?>
<h1><?= $data['title']; ?></h1>
<a href="<?php echo URLROOT ?>/userController/dashboard"><button type="button" style="margin: 5px;">Back To Dashboard</button></a>
<?php if (!empty($data['orderItems'])) : ?>
    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Order Date</th>
                <th>Total</th>
                <th>Status</th>
                <th>Product ID</th>
                <th>Category ID</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['orderItems'] as $item) : ?>
                <tr>
                    <td><?= $item->order_id; ?></td>
                    <td><?= $item->order_date; ?></td>
                    <td><?= $item->order_total; ?></td>
                    <td><?= $item->order_status; ?></td>
                    <td><?= $item->product_id; ?></td>
                    <td><?= $item->category_id; ?></td>
                    <td><?= $item->quantity; ?></td>
                    <td><?= $item->item_price; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else : ?>
    <p>No orders found.</p>
<?php endif; ?>

<?php require APPROOT . '/views/includes/footer.php'; ?>