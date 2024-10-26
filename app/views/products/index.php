<?php require APPROOT . '/views/includes/header.php'; ?>

<h1>Product Listing</h1>
<a href="<?php echo URLROOT ?>/products/add"><button style="margin-bottom: 10px;">Add Product</button></a>
<a href="<?php echo URLROOT ?>"><button style="margin-bottom: 10px;">Home</button></a>
<?php echo flashMessage('productMessage'); ?>
<table style="width:100%; text-align:center;">
    <thead>
        <tr>
            <th>Id</th>
            <th>Product Name</th>
            <th>Brand Name</th>
            <th>Original Price</th>
            <th>Selling Price</th>
            <th>Product Type</th>
            <th>Operations</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Loop through the products array and display each product
        foreach ($data['products'] as $product) : ?>
            <tr>
                <td><?php echo $product->id ?></td>
                <td><?php echo $product->product_name ?></td>
                <td><?php echo $product->brand ?></td>
                <td>Rs <?php echo $product->original_price ?></td>
                <td>Rs <?php echo $product->selling_price ?></td>
                <td> <?php echo $product->product_type ?> </td>
                <td>
                    <a href='<?php echo URLROOT ?>/products/show/<?php echo $product->id ?>'><button>View</button></a>
                    <a href='<?php echo URLROOT ?>/products/edit/<?php echo $product->id ?>'><button>Edit</button></a>

                    <!-- Form for delete operation using POST method -->
                    <form action="<?php echo URLROOT ?>/products/delete/<?php echo $product->id ?>" method="POST" style="display:inline;">
                        <button type="submit" onclick="return confirm('Are you sure you want to delete this product?');">Delete</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require APPROOT . '/views/includes/footer.php'; ?>