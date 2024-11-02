<?php require APPROOT . '/views/includes/header.php'; ?>
<a href="<?php echo URLROOT ?>/productController/index"><button type="button">Back</button></a>
<h1>Add Product</h1>
<p style="color: red;">* required fields</p>

<form action="<?php echo URLROOT ?>/productController/create" method="post" novalidate>

    <!-- Product Name -->
    <div class="addproduct" style="margin-bottom: 5px;">
        <label for="name">Product Name:</label>
        <input
            type="text"
            name="name"
            value="<?php echo $data['name']; ?>"
            id="name"
            style="border: 1px solid <?php echo !empty($data['nameError']) ? 'red' : '#ccc'; ?>;">
        <span class="error" style="color: red;">* <?php echo $data['nameError']; ?></span>
    </div>

    <!-- Brand Name -->
    <div class="addproduct" style="margin-bottom: 5px;">
        <label for="brand">Brand Name:</label>
        <input
            type="text"
            name="brand"
            value="<?php echo $data['brand']; ?>"
            id="brand"
            style="border: 1px solid <?php echo !empty($data['brandError']) ? 'red' : '#ccc'; ?>;">
        <span class="error" style="color: red;">* <?php echo $data['brandError']; ?></span>
    </div>

    <!-- Original Price -->
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

    <!-- Selling Price -->
    <div class="addproduct" style="margin-bottom: 5px;">
        <label for="sPrice">Selling Price:</label>
        <input
            type="number"
            name="sellingPrice"
            value="<?php echo $data['sellingPrice']; ?>"
            id="sPrice"
            style="border: 1px solid <?php echo !empty($data['sellingPriceError']) ? 'red' : '#ccc'; ?>;">
        <span class="error" style="color: red;">* <?php echo $data['sellingPriceError']; ?></span>
    </div>

    <!-- Product Type -->
    <div class="addproduct" style="margin-bottom: 5px;">
        <label for="productType">Product Type:</label>
        <select name="type" id="type" required style="border-color: <?php echo !empty($data['typeError']) ? 'red' : 'initial'; ?>;">
            <option value="">Select Type</option>
            <option value="Physical" <?php echo $data['type'] == 'Physical' ? 'selected' : ''; ?>>Physical</option>
            <option value="Digital" <?php echo $data['type'] == 'Digital' ? 'selected' : ''; ?>>Digital</option>
        </select>
        <span class="error" style="color: red;">* <?php echo $data['typeError'] ?? ''; ?></span>
    </div>

    <!-- Category Selection -->
    <div class="addproduct" style="margin-bottom: 5px;">
        <label for="category">Category:</label>
        <select name="category" id="category" required style="border-color: <?php echo !empty($data['categoryError']) ? 'red' : 'initial'; ?>;">
            <option value="">Select Category</option>
            <?php foreach ($data['category'] as $category): ?>
                <option value="<?php echo $category->id; ?>" <?php echo $data['category'] == $category->id ? 'selected' : ''; ?>>
                    <?php echo $category->name; ?>
                </option>
            <?php endforeach; ?>
        </select>
        <span class="error" style="color: red;">* <?php echo $data['categoryError'] ?? ''; ?></span>
    </div>




    <button type="submit" name="submit">Submit</button>
    <button type="reset">Reset</button>
</form>

<?php require APPROOT . '/views/includes/footer.php'; ?>