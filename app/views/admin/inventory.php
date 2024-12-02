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
                            <h3><?php echo $data['productCount'] ?></h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center bg-secondary text-white">
                        <div class="card-body">
                            <h6>Low Stock</h6>
                            <h3>
                                <?php
                                // Loop through stock counts and find "Low Stock"
                                foreach ($data['stockCount'] as $stock):
                                    if ($stock->stock_status == 'Low Stock'): // Only show low stock
                                        echo $stock->product_count;
                                    endif;
                                endforeach;
                                ?>
                            </h3>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card text-center bg-danger text-white">
                        <div class="card-body">
                            <h6>Out of Stock</h6>
                            <h3><?php
                                // Loop through stock counts and find "Low Stock"
                                foreach ($data['stockCount'] as $stock):
                                    if ($stock->stock_status == 'Out of Stock'): // Only show low stock
                                        echo $stock->product_count;
                                    endif;
                                endforeach;
                                ?></h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center bg-success text-white">
                        <div class="card-body">
                            <h6>Top-Selling Product</h6>
                            <h3><?php echo $data['topSellingProduct']->product_name; ?></h3>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Button to Open Modal -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <input type="text" class="form-control" placeholder="Search by Product Name, SKU, or ID">
                </div>
                <div class="col-md-6 text-end">
                    <a href="<?php echo URLROOT; ?>/adminController/addProduct"><button type="button" class="btn btn-success">
                            Add New Product
                        </button></a>
                </div>
            </div>

            <?php var_dump($data['stockCounts']->stock_status) ?>

            <!-- Product Table -->
            <div class="row">
                <div class="col-md-12">
                    <table class="table .table-responsive rounded-3 table-hover table-striped text-center table-bordered border-success">
                        <thead class="table-success">
                            <tr>
                                <th>#</th>
                                <th>Product Name</th>
                                <th>Category</th>
                                <th>Stock</th>
                                <th>Price</th>
                                <th>Brand</th>
                                <th>Image</th>
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
                                        <td><img src="<?php echo URLROOT ?>/public/images/products/<?php echo $product->image; ?>" alt="Product Image" width="60px"></td>

                                        <td>
                                            <button
                                                class="btn btn-sm btn-info view-product"
                                                data-product='<?php echo json_encode($product); ?>'
                                                data-bs-toggle="modal"
                                                data-bs-target="#productDetailModal">
                                                <i class="fa-solid fa-eye"></i>
                                            </button>

                                            <a href="<?php echo URLROOT ?>/adminController/editProduct/<?php echo $product->id ?>"><button class="btn btn-sm btn-info"><i class="fa-solid fa-pen-to-square"></i></button></a>
                                            <form action="<?php echo URLROOT ?>/productController/delete/<?php echo $product->id ?>" method="POST" style="display:inline;">
                                                <button class="btn btn-danger text-white btn-sm" type="submit" onclick="return confirm('Are you sure you want to delete this product?');"><i class="fa-solid fa-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center">No products found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <!-- Product Detail Modal -->
    <div class="modal fade" id="productDetailModal" tabindex="-1" aria-labelledby="productDetailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="productDetailModalLabel">Product Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-5">
                            <img id="productDetailImage" src="" alt="Product Image" class="img-fluid">
                        </div>
                        <div class="col-md-7">
                            <h5 id="productDetailName"></h5>
                            <p><strong>Category:</strong> <span id="productDetailCategory"></span></p>
                            <p><strong>Brand:</strong> <span id="productDetailBrand"></span></p>
                            <p><strong>Stock:</strong> <span id="productDetailStock"></span></p>
                            <p><strong>Price:</strong> ₹<span id="productDetailPrice"></span></p>
                            <p id="productDetailDescription"></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.view-product').forEach(button => {
            button.addEventListener('click', function() {
                // Parse product data from the data attribute
                const product = JSON.parse(this.getAttribute('data-product'));

                // Populate modal fields with product data
                document.getElementById('productDetailName').textContent = product.name;
                document.getElementById('productDetailCategory').textContent = product.category_name;
                document.getElementById('productDetailBrand').textContent = product.brand;
                document.getElementById('productDetailStock').textContent = product.stock;
                document.getElementById('productDetailPrice').textContent = parseFloat(product.selling_price).toFixed(2);
                document.getElementById('productDetailDescription').textContent = product.description;

                // Handle image
                const imagePath = `${window.location.origin}/public/images/products/${product.image}`;
                console.log('Product Image Path:', imagePath); // Log the image path
                document.getElementById('productDetailImage').src = imagePath;

                // Set the product image
                document.getElementById('productDetailImage').src = `${window.location.origin}/shop/public/images/products/${product.image}`;
            });
        });
    });
</script>

<?php require APPROOT . '/views/admin/footer.php'; ?>