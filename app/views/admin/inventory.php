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
            <!-- Button to Open Modal -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <input type="text" class="form-control" placeholder="Search by Product Name, SKU, or ID">
                </div>
                <div class="col-md-6 text-end">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addProductModal">
                        Add New Product
                    </button>
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
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</main>

<!-- Add New Product Modal -->
<div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProductModalLabel">Add New Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Add Product Form -->
                <form action="<?php echo URLROOT ?>/productController/create" method="post" enctype="multipart/form-data" novalidate class="text-secondary fw-bolder fs-2">
                    <!-- Product Name -->
                    <div class="addproduct mb-3 d-flex align-items-center">
                        <input
                            type="text"
                            name="name"
                            value="<?php echo $data['name']; ?>"
                            id="name"
                            placeholder="Enter product name"
                            class="form-control rounded"
                            style="border: 1px solid <?php echo !empty($data['nameError']) ? 'red' : '#ccc'; ?>;">
                        <span class="text-danger fw-bold ms-2" style="font-size: 1rem;">*</span>
                    </div>
                    <span class="error text-danger" style="font-size: 0.9rem; display: block;"><?php echo $data['nameError']; ?></span>

                    <!-- Brand Name -->
                    <div class="addproduct mb-3 d-flex align-items-center">
                        <input
                            type="text"
                            name="brand"
                            value="<?php echo $data['brand']; ?>"
                            id="brand"
                            placeholder="Enter brand name"
                            class="form-control rounded"
                            style="border: 1px solid <?php echo !empty($data['brandError']) ? 'red' : '#ccc'; ?>;">
                        <span class="text-danger fw-bold ms-2" style="font-size: 1rem;">*</span>
                    </div>
                    <span class="error text-danger" style="font-size: 0.9rem; display: block;"><?php echo $data['brandError']; ?></span>

                    <!-- Stock -->
                    <div class="addproduct mb-3 d-flex align-items-center">
                        <input
                            type="number"
                            name="stock"
                            value="<?php echo $data['stock']; ?>"
                            id="stock"
                            placeholder="Enter stock"
                            class="form-control rounded"
                            style="border: 1px solid <?php echo !empty($data['stockError']) ? 'red' : '#ccc'; ?>;">
                        <span class="text-danger fw-bold ms-2" style="font-size: 1rem;">*</span>
                    </div>
                    <span class="error text-danger" style="font-size: 0.9rem; display: block;"><?php echo $data['stockError']; ?></span>

                    <!-- Base Price -->
                    <div class="addproduct mb-3 d-flex align-items-center">
                        <input
                            type="number"
                            name="originalPrice"
                            value="<?php echo $data['originalPrice']; ?>"
                            id="oPrice"
                            placeholder="Enter base price"
                            class="form-control rounded"
                            style="border: 1px solid <?php echo !empty($data['originalPriceError']) ? 'red' : '#ccc'; ?>;">
                        <span class="text-danger fw-bold ms-2" style="font-size: 1rem;">*</span>
                    </div>
                    <span class="error text-danger" style="font-size: 0.9rem; display: block;"><?php echo $data['originalPriceError']; ?></span>

                    <!-- Sale Price -->
                    <div class="addproduct mb-3 d-flex align-items-center">
                        <input
                            type="number"
                            name="sellingPrice"
                            value="<?php echo $data['sellingPrice']; ?>"
                            id="sPrice"
                            placeholder="Enter sale price"
                            class="form-control rounded"
                            style="border: 1px solid <?php echo !empty($data['sellingPriceError']) ? 'red' : '#ccc'; ?>;">
                        <span class="text-danger fw-bold ms-2" style="font-size: 1rem;">*</span>
                    </div>
                    <span class="error text-danger" style="font-size: 0.9rem; display: block;"><?php echo $data['sellingPriceError']; ?></span>

                    <!-- Product Type -->
                    <div class="addproduct mb-3 d-flex align-items-center">
                        <select name="type" id="type" class="form-control rounded" required style="border-color: <?php echo !empty($data['typeError']) ? 'red' : 'initial'; ?>;">
                            <option value="">Select Type</option>
                            <option value="Physical" <?php echo $data['type'] == 'Physical' ? 'selected' : ''; ?>>Physical</option>
                            <option value="Digital" <?php echo $data['type'] == 'Digital' ? 'selected' : ''; ?>>Digital</option>
                        </select>
                        <span class="text-danger fw-bold ms-2" style="font-size: 1rem;">*</span>
                    </div>
                    <span class="error text-danger" style="font-size: 0.9rem; display: block;"><?php echo $data['typeError'] ?? ''; ?></span>

                    <!-- Category Selection -->
                    <div class="addproduct mb-3 d-flex align-items-center">
                        <select name="category" id="category" class="form-control rounded" required style="border-color: <?php echo !empty($data['categoryError']) ? 'red' : 'initial'; ?>;">
                            <option value="">Select Category</option>
                            <?php foreach ($data['category'] as $category): ?>
                                <option value="<?php echo $category->id; ?>" <?php echo $data['category'] == $category->id ? 'selected' : ''; ?>>
                                    <?php echo $category->name; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <span class="text-danger fw-bold ms-2" style="font-size: 1rem;">*</span>
                    </div>
                    <span class="error text-danger" style="font-size: 0.9rem; display: block;"><?php echo $data['categoryError'] ?? ''; ?></span>

                    <!-- Image Upload -->
                    <div class="addproduct mb-3 d-flex align-items-center">
                        <input
                            type="file"
                            name="images"
                            id="images"
                            accept="image/*"
                            class="form-control rounded"
                            style="border: 1px solid <?php echo !empty($data['imageError']) ? 'red' : '#ccc'; ?>;">
                        <span class="text-danger fw-bold ms-2" style="font-size: 1rem;">*</span>
                    </div>
                    <span class="error text-danger" style="font-size: 0.9rem; display: block;">
                        <?php echo $data['imageError'] ?? ''; ?>
                    </span>

                    <span class="error text-danger" style="font-size: 0.9rem; display: block;"><?php echo $data['imagesError'] ?? ''; ?></span>

                    <button type="submit" class="btn btn-success mt-2" name="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Open the modal automatically if there are errors
    <?php if (!empty($data['nameError']) || !empty($data['brandError']) || !empty($data['stockError']) || !empty($data['originalPriceError']) || !empty($data['sellingPriceError']) || !empty($data['typeError']) || !empty($data['categoryError']) || !empty($data['imageError'])): ?>
        var myModal = new bootstrap.Modal(document.getElementById('addProductModal'));
        myModal.show();
    <?php endif; ?>
</script>

<?php require APPROOT . '/views/admin/footer.php'; ?>