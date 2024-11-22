<?php require APPROOT . '/views/admin/header.php'; ?>
<main id="main">
    <section class="inventory-revenue-charts mb-4">

        <div class="container-fluid inventory-page">
            <div class="row g-3 justify-content-between mb-3">
                <div class="col-md-4">
                    <h5>Inventory</h5>
                </div>
            </div>
            <div class="row mb-4">
                <div class="col-md-3">
                    <div class="card text-center bg-primary text-white">
                        <div class="card-body">
                            <h6>Total Products</h6>
                            <h3>1,250</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center bg-secondary text-white">
                        <div class="card-body">
                            <h6>Low Stock</h6>
                            <h3>120</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center bg-danger text-white">
                        <div class="card-body">
                            <h6>Out of Stock</h6>
                            <h3>50</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center bg-success text-white">
                        <div class="card-body">
                            <h6>Top-Selling Product</h6>
                            <h3>Smartphone</h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Search & Filters -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <input type="text" class="form-control" placeholder="Search by Product Name, SKU, or ID">
                </div>
                <div class="col-md-6 text-end">
                    <button class="btn btn-success">Add New Product</button>
                </div>
            </div>

            <!-- Product Table -->
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Product Name</th>
                                <th>Category</th>
                                <th>Stock</th>
                                <th>Price</th>
                                <th>Brand</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php if (isset($data['products']) && count($data['products']) > 0): ?>
                                <?php foreach ($data['products'] as $product): ?>
                                    <tr>
                                        <td><?php echo $product->id; ?></td>
                                        <td><?php echo $product->name; ?></td>
                                        <td><?php echo $product->category_name; ?></td>
                                        <td><?php echo $product->stock; ?></td>
                                        <td>₹<?php echo number_format($product->selling_price, 2); ?></td>
                                        <td><?php echo $product->brand; ?></td>
                                        <td>
                                            <button class="btn btn-sm btn-info">Edit</button>
                                            <button class="btn btn-sm btn-danger">Delete</button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center">No products found.</td>
                                </tr>
                            <?php endif; ?>


                            <!-- More rows -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </section>
</main>
<?php require APPROOT . '/views/admin/footer.php'; ?>