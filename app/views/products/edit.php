<?php require APPROOT . '/views/includes/header.php'; ?>
<a href="<?php echo URLROOT ?>/products/index"><button type="button">Back</button></a>
<h1>Edit Product</h1>
<p style="color: red;">* required fields</p>
<form action="<?php echo URLROOT; ?>/productController/edit/<?php echo $data['id']; ?>" method="post" novalidate>
    <div class="addproduct" style="margin-bottom: 5px;">
        <label for="name">Product Name:</label>
        <input
            type="text"
            name="productName"
            value="<?php echo $data['productName']; ?>"
            id="name"
            style="border: 1px solid <?php echo !empty($data['productNameError']) ? 'red' : '#ccc'; ?>;">
        <span class="error" style="color: red;">* <?php echo $data['productNameError']; ?></span>
    </div>

    <div class="addproduct" style="margin-bottom: 5px;">
        <label for="brand">Brand Name:</label>
        <input
            type="text"
            name="productBrand"
            value="<?php echo htmlspecialchars($data['productBrand'], ENT_QUOTES, 'UTF-8'); ?>"
            id="brand"
            style="border: 1px solid <?php echo !empty($data['productBrandError']) ? 'red' : '#ccc'; ?>;">
        <span class="error" style="color: red;">* <?php echo $data['productBrandError']; ?></span>
    </div>

    <div class="addproduct" style="margin-bottom: 5px;">
        <label for="oPrice">Original Price:</label>
        <input
            type="number"
            name="originalPrice"
            value="<?php echo $data['originalPrice']; ?>"
            id="oPrice"
            style="border: 1px solid <?php echo !empty($data['originalPriceError']) ? 'red' : '#ccc'; ?>;">
        <span class="error" style="color: red;">* <?php echo $data['originalPriceError']; ?></span>
    </div>

    <div class="addproduct" style="margin-bottom: 5px;">
        <label for="sPrice">Selling Price:</label>
        <input
            type="number"
            name="sellingPrice"
            value="<?php echo htmlspecialchars($data['sellingPrice'], ENT_QUOTES, 'UTF-8'); ?>"
            id="sPrice"
            style="border: 1px solid <?php echo !empty($data['sellingPriceError']) ? 'red' : '#ccc'; ?>;">
        <span class="error" style="color: red;">* <?php echo $data['sellingPriceError']; ?></span>
    </div>

    <!-- Product Type -->
    <div class="addproduct" style="margin-bottom: 5px;">
        <label for="productType">Product Type:</label>
        <select name="productType" id="productType" required>
            <option value="">Select Type</option>
            <option value="Physical" <?php echo $data['productType'] == 'Physical' ? 'selected' : ''; ?>>Physical</option>
            <option value="Digital" <?php echo $data['productType'] == 'Digital' ? 'selected' : ''; ?>>Digital</option>
        </select>
        <span class="error" style="color: red;">* <?php echo $data['productTypeError'] ?? ''; ?></span>
    </div>
    <!-- Category Selection -->
    <div class="addproduct" style="margin-bottom: 5px;">
        <label for="category">Category:</label>
        <select name="categoryId" id="category" required>
            <option value="">Select Category</option>
            <?php foreach ($data['category'] as $category): ?>
                <option value="<?php echo $category->categoryId; ?>"
                    <?php echo ($category->categoryId == $data['categoryId']) ? 'selected' : ''; ?>>
                    <?php echo $category->categoryName; ?>
                </option>
            <?php endforeach; ?>
        </select>
        <span class="error" style="color: red;">* <?php echo $data['categoryIdError'] ?? ''; ?></span>
    </div>


    <button type="submit" name="submit">Submit</button>
    <button type="reset">Reset</button>
</form>

<?php require APPROOT . '/views/includes/footer.php'; ?>