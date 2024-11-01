<?php require APPROOT . '/views/includes/header.php'; ?>

<h1>Product Details</h1>

<?php flashMessage('productMessage'); ?>

<!-- Display product details -->
<div>
    <h2><?php echo $data['product']->product_name; ?></h2>
    <p><strong>Brand:</strong> <?php echo $data['product']->brand; ?></p>
    <p><strong>Original Price:</strong> ₹<?php echo $data['product']->original_price; ?></p>
    <p><strong>Selling Price:</strong> ₹<?php echo $data['product']->selling_price; ?></p>
    <p><strong>Product Type:</strong> <?php echo $data['product']->product_type; ?></p>

    <p><strong>Category:</strong>
        <?php
        // Check if categoryName is null or empty
        if (empty($data['product']->categoryName)) {
            echo "No category assigned"; // Default message when no category is available
        } else {
            echo $data['product']->categoryName; // Display category name
        }
        ?>
    </p>
</div>
<a href="<?php echo URLROOT; ?>/productController/index"><button>Go back</button></a>

<?php require APPROOT . '/views/includes/footer.php'; ?>