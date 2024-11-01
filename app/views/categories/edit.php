<?php require APPROOT . '/views/includes/header.php'; ?>
<a href="<?php echo URLROOT ?>/categoryController/index"><button type="button">Back</button></a>
<h1>Add Category</h1>
<p style="color: red;">* required fields</p>
<form action="<?php echo URLROOT; ?>/categoryController/edit/<?php echo $data['id']; ?>" method="post" novalidate>
    <div class="addcategory" style="margin-bottom: 5px;">
        <label for="name">Category Name:</label>
        <input
            type="text"
            name="categoryName"
            value="<?php echo $data['categoryName']; ?>"
            id="categoryName"
            style="border: 1px solid <?php echo !empty($data['categoryNameError']) ? 'red' : '#ccc'; ?>;">
        <span class="error" style="color: red;">* <?php echo $data['categoryNameError']; ?></span>
    </div>

    <button type="submit" name="submit">Submit</button>
    <button type="reset">Reset</button>
</form>

<?php require APPROOT . '/views/includes/footer.php'; ?>