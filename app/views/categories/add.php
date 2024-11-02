<?php require APPROOT . '/views/includes/header.php'; ?>
<a href="<?php echo URLROOT ?>/categoryController/index"><button type="button">Back</button></a>
<h1>Add Category</h1>
<p style="color: red;">* required fields</p>
<form action="<?php echo URLROOT; ?>/categoryController/create" method="post" novalidate>
    <div class="addcategory" style="margin-bottom: 5px;">
        <label for="name">Category Name:</label>
        <input
            type="text"
            name="name"
            value="<?php echo $data['name']; ?>"
            id="categoryName"
            style="border: 1px solid <?php echo !empty($data['nameError']) ? 'red' : '#ccc'; ?>;">
        <span class="error" style="color: red;">* <?php echo $data['nameError']; ?></span>
    </div>

    <button type="submit" name="submit">Submit</button>
    <button type="reset">Reset</button>
</form>

<?php require APPROOT . '/views/includes/footer.php'; ?>