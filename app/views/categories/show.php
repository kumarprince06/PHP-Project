<?php require APPROOT . '/views/includes/header.php'; ?>

<h1>Category Details</h1>

<!-- Display Flash Message -->
<?php flashMessage('categoryMessage'); ?>
<!-- Display product details -->
<div>
    <p><strong>Category Name:</strong> <?php echo $data['category']->categoryName; ?></p>
</div>
<a href="<?php echo URLROOT; ?>/categories"><button>Go back</button></a>


<?php require APPROOT . '/views/includes/footer.php'; ?>