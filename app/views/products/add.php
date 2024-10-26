<?php require APPROOT . '/views/includes/header.php'; ?>
<a href="<?php echo URLROOT ?>/products/index"><button type="button">Back</button></a>
<h1>Add Product</h1>
<p style="color: red;">* required fields</p>

<form action="<?php echo URLROOT ?>/products/add" method="post" novalidate>

    <!-- Product Name -->
    <div class="addproduct" style="margin-bottom: 5px;">
        <label for="name">Product Name:</label>
        <input
            type="text"
            name="productName"
            value="<?php echo htmlspecialchars($data['productName'], ENT_QUOTES, 'UTF-8'); ?>"
            id="name"
            style="border: 1px solid <?php echo !empty($data['productNameError']) ? 'red' : '#ccc'; ?>;">
        <span class="error" style="color: red;">* <?php echo $data['productNameError']; ?></span>
    </div>

    <!-- Brand Name -->
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

    <!-- Original Price -->
    <div class="addproduct" style="margin-bottom: 5px;">
        <label for="oPrice">Original Price:</label>
        <input
            type="number"
            name="originalPrice"
            value="<?php echo htmlspecialchars($data['originalPrice'], ENT_QUOTES, 'UTF-8'); ?>"
            id="oPrice"
            style="border: 1px solid <?php echo !empty($data['originalPriceError']) ? 'red' : '#ccc'; ?>;">
        <span class="error" style="color: red;">* <?php echo $data['originalPriceError']; ?></span>
    </div>

    <!-- Selling Price -->
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
            <option value="Physical" <?php echo $data['productType'] == 'physical' ? 'selected' : ''; ?>>Physical</option>
            <option value="Digital" <?php echo $data['productType'] == 'digital' ? 'selected' : ''; ?>>Digital</option>
        </select>
        <span class="error" style="color: red;">* <?php echo $data['productTypeError'] ?? ''; ?></span>
    </div>

    <button type="submit" name="submit">Submit</button>
    <button type="reset">Reset</button>
</form>

<?php require APPROOT . '/views/includes/footer.php'; ?>