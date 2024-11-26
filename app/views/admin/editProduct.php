<?php require APPROOT . '/views/admin/header.php'; ?>
<main id="main">
    <section class="inventory-page mb-4">
        <div class="container-fluid">
            <div class="row g-3 justify-content-between mb-3">
                <div class="col-md-4">
                    <h5>Edit Product</h5>
                </div>
            </div>

            <!-- Edit Product Form -->
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <form action="<?php echo URLROOT ?>/productController/update" method="post" enctype="multipart/form-data" novalidate class="text-secondary fw-bolder fs-2">
                        <!-- Product Id  -->
                        <input type="number" hidden name="id" value="<?php echo $data['id'] ?>">
                        <!-- Product Name -->
                        <div class="mb-3 row align-items-center">
                            <label for="name" class="col-sm-3 col-form-label">Product Name <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input
                                    type="text"
                                    name="name"
                                    value="<?php echo $data['name']; ?>"
                                    id="name"
                                    placeholder="Enter product name"
                                    class="form-control rounded"
                                    style="border: 1px solid <?php echo !empty($data['nameError']) ? 'red' : '#ccc'; ?>;">
                                <span class="text-danger fw-bold mt-1" style="font-size: 0.9rem;"><?php echo $data['nameError']; ?></span>
                            </div>
                        </div>

                        <!-- Brand Name -->
                        <div class="mb-3 row align-items-center">
                            <label for="brand" class="col-sm-3 col-form-label">Brand Name <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input
                                    type="text"
                                    name="brand"
                                    value="<?php echo $data['brand']; ?>"
                                    id="brand"
                                    placeholder="Enter brand name"
                                    class="form-control rounded"
                                    style="border: 1px solid <?php echo !empty($data['brandError']) ? 'red' : '#ccc'; ?>;">
                                <span class="text-danger fw-bold mt-1" style="font-size: 0.9rem;"><?php echo $data['brandError']; ?></span>
                            </div>
                        </div>

                        <!-- Stock -->
                        <div class="mb-3 row align-items-center">
                            <label for="stock" class="col-sm-3 col-form-label">Stock <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input
                                    type="number"
                                    name="stock"
                                    value="<?php echo $data['stock']; ?>"
                                    id="stock"
                                    placeholder="Enter stock"
                                    class="form-control rounded"
                                    style="border: 1px solid <?php echo !empty($data['stockError']) ? 'red' : '#ccc'; ?>;">
                                <span class="text-danger fw-bold mt-1" style="font-size: 0.9rem;"><?php echo $data['stockError']; ?></span>
                            </div>
                        </div>

                        <!-- Base Price -->
                        <div class="mb-3 row align-items-center">
                            <label for="oPrice" class="col-sm-3 col-form-label">Base Price <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input
                                    type="number"
                                    name="originalPrice"
                                    value="<?php echo $data['originalPrice']; ?>"
                                    id="oPrice"
                                    placeholder="Enter base price"
                                    class="form-control rounded"
                                    style="border: 1px solid <?php echo !empty($data['originalPriceError']) ? 'red' : '#ccc'; ?>;">
                                <span class="text-danger fw-bold mt-1" style="font-size: 0.9rem;"><?php echo $data['originalPriceError']; ?></span>
                            </div>
                        </div>

                        <!-- Sale Price -->
                        <div class="mb-3 row align-items-center">
                            <label for="sPrice" class="col-sm-3 col-form-label">Sale Price <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input
                                    type="number"
                                    name="sellingPrice"
                                    value="<?php echo $data['sellingPrice']; ?>"
                                    id="sPrice"
                                    placeholder="Enter sale price"
                                    class="form-control rounded"
                                    style="border: 1px solid <?php echo !empty($data['sellingPriceError']) ? 'red' : '#ccc'; ?>;">
                                <span class="text-danger fw-bold mt-1" style="font-size: 0.9rem;"><?php echo $data['sellingPriceError']; ?></span>
                            </div>
                        </div>

                        <!-- Product Type -->
                        <div class="mb-3 row align-items-center">
                            <label for="type" class="col-sm-3 col-form-label">Product Type <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select name="type" id="type" class="form-select rounded">
                                    <option value="">Select Type</option>
                                    <option value="Physical" <?php echo $data['type'] == 'Physical' ? 'selected' : ''; ?>>Physical</option>
                                    <option value="Digital" <?php echo $data['type'] == 'Digital' ? 'selected' : ''; ?>>Digital</option>
                                </select>
                                <span class="text-danger fw-bold mt-1" style="font-size: 0.9rem;"><?php echo $data['typeError'] ?? ''; ?></span>
                            </div>
                        </div>

                        <!-- Category Selection -->
                        <div class="mb-3 row align-items-center">
                            <label for="category" class="col-sm-3 col-form-label">Category <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select name="category" id="category" class="form-select rounded" style="border-color: <?php echo !empty($data['categoryError']) ? 'red' : 'initial'; ?>;">
                                    <option value="">Select Category</option>
                                    <?php foreach ($data['categoryList'] as $category): ?>
                                        <option value="<?php echo $category->id; ?>" <?php echo $data['category'] == $category->id ? 'selected' : ''; ?>>
                                            <?php echo $category->name; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <span class="text-danger fw-bold mt-1" style="font-size: 0.9rem;"><?php echo $data['categoryError'] ?? ''; ?></span>
                            </div>
                        </div>

                        <!-- Image View -->
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Existing Images</label>
                            <div class="col-sm-9">
                                <div class="row g-1">
                                    <?php foreach ($data['productImage'] as $image): ?>

                                        <div class="col-4 col-md-3 col-lg-2 position-relative">
                                            <div class="border rounded overflow-hidden bg-primary w-100 h-100">
                                                <img
                                                    src="<?php echo URLROOT; ?>/public/images/Products/<?php echo $image->name ?>"
                                                    alt="Product Image"
                                                    class="img-fluid"
                                                    style="object-fit: cover; width: 100%; height: 100%;">
                                            </div>
                                            <!-- Delete Button -->
                                            <form id="deleteForm<?php echo $image->id; ?>" action="<?php echo URLROOT; ?>/productController/deleteImage/<?php echo $image->id; ?>" method="POST">
                                                <input type="number" hidden name="productId" value="<?php echo $image->product_id; ?>">
                                                <input type="text" hidden name="image" value="<?php echo $image->name; ?>">
                                                <button
                                                    type="submit"
                                                    class="btn btn-danger btn-sm position-absolute top-0 end-0"
                                                    onclick="return confirm('Are you sure you want to delete this image?')"
                                                    style="border-radius: 50%; z-index: 1;">
                                                    &times;
                                                </button>
                                            </form>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>

                        <!-- Image Upload -->
                        <div class="mb-3 row align-items-center">
                            <label for="images" class="col-sm-3 col-form-label">Product Images <span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <input
                                    type="file"
                                    name="images[]"
                                    id="images"
                                    multiple
                                    accept="image/*"
                                    class="form-control rounded"
                                    style="border: 1px solid <?php echo !empty($data['imageError']) ? 'red' : '#ccc'; ?>;">
                                <span class="text-danger fw-bold mt-1" style="font-size: 0.9rem;"><?php echo $data['imageError'] ?? ''; ?></span>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-success mt-2" name="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</main>

<?php require APPROOT . '/views/admin/footer.php'; ?>