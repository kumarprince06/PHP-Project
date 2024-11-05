<?php require APPROOT . '/views/includes/header.php'; ?>
<a href="<?php echo URLROOT ?>/products/index"><button type="button">Back</button></a>
<h1>Edit Product</h1>
<p style="color: red;">* required fields</p>
<form action="<?php echo URLROOT; ?>/productController/update" method="post" novalidate>
    <input type="number" name="id" value="<?php echo $data['id']; ?>" hidden>
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

    <!-- Stock -->
    <div class="addproduct" style="margin-bottom: 5px;">
        <label for="stock">Stock:</label>
        <input
            type="number"
            name="stock"
            value="<?php echo $data['stock']; ?>"
            id="stock"
            style="border: 1px solid <?php echo !empty($data['stockError']) ? 'red' : '#ccc'; ?>;">
        <span class="error" style="color: red;">* <?php echo $data['stockError']; ?></span>
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
            value="<?php echo $data['sellingPrice']; ?>"
            id="sPrice"
            style="border: 1px solid <?php echo !empty($data['sellingPriceError']) ? 'red' : '#ccc'; ?>;">
        <span class="error" style="color: red;">* <?php echo $data['sellingPriceError']; ?></span>
    </div>

    <!-- Product Type -->
    <div class="addproduct" style="margin-bottom: 5px;">
        <label for="type">Product Type:</label>
        <select name="productType" id="type">
            <option value="">Select Type</option>
            <option value="Physical" <?php echo $data['type'] == 'Physical' ? 'selected' : ''; ?>>Physical</option>
            <option value="Digital" <?php echo $data['type'] == 'Digital' ? 'selected' : ''; ?>>Digital</option>
        </select>
        <span class="error" style="color: red;">* <?php echo $data['typeError'] ?? ''; ?></span>
    </div>
    <!-- Category Selection -->
    <div class="addproduct" style="margin-bottom: 5px;">
        <label for="category">Category:</label>
        <select name="category" id="category">
            <option value="">Select Category</option>
            <?php foreach ($data['categoryList'] as $category): ?>
                <option value="<?php echo $category->id; ?>"
                    <?php echo ($category->id == $data['category']) ? 'selected' : ''; ?>>
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