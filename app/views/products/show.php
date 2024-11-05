<?php require APPROOT . '/views/includes/header.php'; ?>

<h1>Product Details</h1>

<?php flashMessage('successMessage'); ?>

<!-- Display product details -->
<div>
    <h2><?php echo $data['product']->product_name; ?></h2>
    <p><strong>Brand:</strong> <?php echo $data['product']->brand; ?></p>
    <p><strong>Original Price:</strong> ₹<?php echo $data['product']->original_price; ?></p>
    <p><strong>Selling Price:</strong> ₹<?php echo $data['product']->selling_price; ?></p>
    <p><strong>Product Type:</strong> <?php echo $data['product']->type; ?></p>
    <p><strong>Stock:</strong> <?php echo $data['product']->stock; ?></p>
    <p><strong>Category:</strong>
        <?php
        // Check if categoryName is null or empty
        if (empty($data['product']->category_name)) {
            echo "No category assigned"; // Default message when no category is available
        } else {
            echo $data['product']->category_name; // Display category name
        }
        ?>
    </p>
</div>
<a href="<?php echo URLROOT; ?>/productController/index"><button>Go back</button></a>

<?php require APPROOT . '/views/includes/footer.php'; ?>