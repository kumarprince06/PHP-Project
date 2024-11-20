<?php require APPROOT . '/views/includes/header.php'; ?>

<section class="vh-90 gradient-custom">
    <div class="container py-3 h-100">
        <div class="row d-flex justify-content-center align-items-center h-90">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-light text-white" style="border-radius: 1rem;">
                    <div class="card-body p-3 text-center">

                        <div class="mb-md-3 mt-md-2 pb-1">
                            <h2 class="fw-bold mb-2 text-uppercase text-success">Add Product</h2>
                            <p class="text-secondary mb-3">Please fill in the product details below:</p>

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
                                        name="images[]"
                                        id="images"
                                        multiple
                                        accept="image/*"
                                        class="form-control rounded"
                                        style="border: 1px solid <?php echo !empty($data['imagesError']) ? 'red' : '#ccc'; ?>;">
                                    <span class="text-danger fw-bold ms-2" style="font-size: 1rem;">*</span>
                                </div>
                                <span class="error text-danger" style="font-size: 0.9rem; display: block;"><?php echo $data['imagesError'] ?? ''; ?></span>

                                <button type="submit" class="btn btn-success mt-2" name="submit">Submit</button>
                                <button type="reset" class="btn btn-warning mt-2">Reset</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require APPROOT . '/views/includes/footer.php'; ?>