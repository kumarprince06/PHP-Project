<?php require APPROOT . '/views/includes/header.php'; ?>

<h1>Category List</h1>
<?php flashMessage('successMessage'); ?>
<a href="<?php echo URLROOT; ?>/categoryController/add"><button style="margin-bottom: 10px;">Add Category</button></a>
<a href="<?php echo URLROOT; ?>"><button style="margin-bottom: 10px;">Home</button></a>
<table style="width:100%; text-align:center;">
    <thead>
        <tr>
            <th>Id</th>
            <th>Category Name</th>
            <th>Operations</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Loop through the products array and display each product
        foreach ($data['category'] as $category) : ?>

            <tr>
                <td><?php echo  $category->id; ?></td>
                <td><?php echo $category->name; ?></td>
                <td>
                    <a href='<?php echo URLROOT; ?>/categoryController/show/<?php echo $category->id; ?>'><button>View</button></a>
                    <?php if ($_SESSION['sessionData']['role'] === 'admin') : ?>
                        <a href='<?php echo URLROOT; ?>/categoryController/edit/<?php echo $category->id; ?>'><button>Edit</button></a>
                        <!-- Form for delete operation using POST method -->
                        <form action="<?php echo URLROOT ?>/categoryController/delete/<?php echo $category->id ?>" method="POST" style="display:inline;">
                            <button type="submit" onclick="return confirm('Are you sure you want to delete this product?');">Delete</button>
                        </form>
                    <?php endif; ?>
                </td>
            </tr>

        <?php endforeach; ?>
    </tbody>
</table>

<?php require APPROOT . '/views/includes/footer.php'; ?>