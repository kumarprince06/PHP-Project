<?php require APPROOT . '/views/includes/header.php'; ?>

<h1>Product Listing</h1>
<a href="<?php echo URLROOT ?>/productController/add"><button style="margin-bottom: 10px;">Add Product</button></a>
<a href="<?php echo URLROOT ?>"><button style="margin-bottom: 10px;">Home</button></a>
<?php echo flashMessage('successMessage'); ?>
<?php echo flashErrorMessage('errorMessage'); ?>
<table style="width:100%; text-align:center;">
    <thead>
        <tr>
            <th>Id</th>
            <th>Product Name</th>
            <th>Brand Name</th>
            <th>Original Price</th>
            <th>Selling Price</th>
            <th>Product Type</th>
            <th>Category</th>
            <th>Stock</th>
            <th>Operations</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Loop through the products array and display each product
        foreach ($data['products'] as $product) : ?>
            <tr>
                <td><?php echo $product->id ?></td>
                <td><?php echo $product->name ?></td>
                <td><?php echo $product->brand ?></td>
                <td>Rs <?php echo $product->original_price ?></td>
                <td>Rs <?php echo $product->selling_price ?></td>
                <td> <?php echo $product->type ?> </td>
                <td><?php echo $product->category_name; ?> </td>
                <td><?php echo $product->stock; ?> </td>
                <td>
                    <a href='<?php echo URLROOT ?>/productController/show/<?php echo $product->id ?>'><button>View</button></a>
                    <?php if ($_SESSION['sessionData']['role'] == 'admin') : ?>
                        <a href='<?php echo URLROOT ?>/productController/edit/<?php echo $product->id ?>'><button>Edit</button></a>

                        <!-- Form for delete operation using POST method -->
                        <form action="<?php echo URLROOT ?>/productController/delete/<?php echo $product->id ?>" method="POST" style="display:inline;">
                            <button type="submit" onclick="return confirm('Are you sure you want to delete this product?');">Delete</button>
                        </form>
                    <?php else: ?>
                        <!-- Form for delete operation using POST method -->
                        <form action="<?php echo URLROOT; ?>/userController/addToWishlist/<?php echo $product->id; ?>" method="POST" style="display:inline;">
                            <button type="submit">Add To Wishlist</button>
                        </form>
                        <!-- Form for delete operation using POST method -->
                        <form action="<?php echo URLROOT; ?>/cartController/addToCart/<?php echo $product->id; ?>" method="POST" style="display:inline;">
                            <button type="submit">Add To Cart</button>
                        </form>
                    <?php endif; ?>

                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>


<!-- Start Content -->
<div class="container py-5">
    <div class="row">

        <div class="col-lg-3">
            <h1 class="h2 pb-4">Categories</h1>
            <ul class="list-unstyled templatemo-accordion">
                <!-- Electronics Category -->
                <li class="pb-3">
                    <a class="collapsed d-flex justify-content-between h3 text-decoration-none" href="#">
                        Electronics
                        <i class="fa fa-fw fa-chevron-circle-down mt-1"></i>
                    </a>
                    <ul class="collapse show list-unstyled pl-3">
                        <li><a class="text-decoration-none" href="#">Smartphones</a></li>
                        <li><a class="text-decoration-none" href="#">Laptops</a></li>
                        <li><a class="text-decoration-none" href="#">Tablets</a></li>
                        <li><a class="text-decoration-none" href="#">Smartwatches</a></li>
                    </ul>
                </li>

                <!-- Brands Category -->
                <li class="pb-3">
                    <a class="collapsed d-flex justify-content-between h3 text-decoration-none" href="#">
                        Brands
                        <i class="pull-right fa fa-fw fa-chevron-circle-down mt-1"></i>
                    </a>
                    <ul id="collapseTwo" class="collapse list-unstyled pl-3">
                        <li><a class="text-decoration-none" href="#">Apple</a></li>
                        <li><a class="text-decoration-none" href="#">Samsung</a></li>
                        <li><a class="text-decoration-none" href="#">Sony</a></li>
                        <li><a class="text-decoration-none" href="#">Huawei</a></li>
                    </ul>
                </li>

                <!-- Accessories Category -->
                <li class="pb-3">
                    <a class="collapsed d-flex justify-content-between h3 text-decoration-none" href="#">
                        Accessories
                        <i class="pull-right fa fa-fw fa-chevron-circle-down mt-1"></i>
                    </a>
                    <ul id="collapseThree" class="collapse list-unstyled pl-3">
                        <li><a class="text-decoration-none" href="#">Headphones</a></li>
                        <li><a class="text-decoration-none" href="#">Chargers</a></li>
                        <li><a class="text-decoration-none" href="#">Power Banks</a></li>
                        <li><a class="text-decoration-none" href="#">Phone Cases</a></li>
                    </ul>
                </li>

                <!-- New Arrivals Category -->
                <li class="pb-3">
                    <a class="collapsed d-flex justify-content-between h3 text-decoration-none" href="#">
                        New Arrivals
                        <i class="pull-right fa fa-fw fa-chevron-circle-down mt-1"></i>
                    </a>
                    <ul id="collapseFour" class="collapse list-unstyled pl-3">
                        <li><a class="text-decoration-none" href="#">New Smartphones</a></li>
                        <li><a class="text-decoration-none" href="#">New Laptops</a></li>
                        <li><a class="text-decoration-none" href="#">New Smartwatches</a></li>
                    </ul>
                </li>

                <!-- Sale Category -->
                <li class="pb-3">
                    <a class="collapsed d-flex justify-content-between h3 text-decoration-none" href="#">
                        Sale
                        <i class="pull-right fa fa-fw fa-chevron-circle-down mt-1"></i>
                    </a>
                    <ul id="collapseFive" class="collapse list-unstyled pl-3">
                        <li><a class="text-decoration-none" href="#">Smartphones</a></li>
                        <li><a class="text-decoration-none" href="#">Laptops</a></li>
                        <li><a class="text-decoration-none" href="#">Accessories</a></li>
                    </ul>
                </li>
            </ul>
        </div>


        <div class="col-lg-9">
            <div class="row">
                <div class="col-md-6">
                    <ul class="list-inline shop-top-menu pb-3 pt-1">
                        <li class="list-inline-item">
                            <a class="h3 text-dark text-decoration-none mr-3" href="#">All</a>
                        </li>
                        <li class="list-inline-item">
                            <a class="h3 text-dark text-decoration-none mr-3" href="#">Men's</a>
                        </li>
                        <li class="list-inline-item">
                            <a class="h3 text-dark text-decoration-none" href="#">Women's</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-6 pb-4">
                    <div class="d-flex">
                        <select class="form-control">
                            <option>Featured</option>
                            <option>A to Z</option>
                            <option>Item</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <?php  // Loop through the products array and display each product
                foreach ($data['products'] as $product) : ?>
                    <div class="col-md-4">
                        <div class="card mb-4 product-wap rounded-0">
                            <div class="card rounded-0">
                                <img class="card-img rounded-0 img-fluid" src="<?php echo URLROOT; ?>/public/images/samsung.png" alt="Product Image">
                                <div class="card-img-overlay rounded-0 product-overlay d-flex align-items-center justify-content-center">
                                    <ul class="list-unstyled">
                                        <li><a class="btn btn-success text-white" href="shop-single.html"><i class="far fa-heart"></i></a></li>
                                        <li><a class="btn btn-success text-white mt-2" href="<?php echo URLROOT ?>/productController/show/<?php echo $product->id ?>"><i class="far fa-eye"></i></a></li>
                                        <li><a class="btn btn-success text-white mt-2" href="shop-single.html"><i class="fas fa-cart-plus"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body">
                                <a href="shop-single.html" class="h3 text-decoration-none"><?php echo $product->name ?></a>
                                <ul class="w-100 list-unstyled d-flex justify-content-between mb-0">
                                    <li>64GB / 128GB / 256GB</li>
                                    <li class="pt-2">
                                        <span class="product-color-dot color-dot-black float-left rounded-circle ml-1"></span>
                                        <span class="product-color-dot color-dot-blue float-left rounded-circle ml-1"></span>
                                        <span class="product-color-dot color-dot-red float-left rounded-circle ml-1"></span>
                                    </li>
                                </ul>
                                <ul class="list-unstyled d-flex justify-content-center mb-1">
                                    <li>
                                        <i class="text-warning fa fa-star"></i>
                                        <i class="text-warning fa fa-star"></i>
                                        <i class="text-warning fa fa-star"></i>
                                        <i class="text-muted fa fa-star"></i>
                                        <i class="text-muted fa fa-star"></i>
                                    </li>
                                </ul>

                                <!-- Price Details -->
                                <div class="d-flex justify-content-between">
                                    <span class="text-muted"><del>₹<?php echo $product->original_price; ?></del></span>
                                    <span class="text-success h4">₹<?php echo $product->selling_price; ?></span>
                                </div>

                                <!-- Discount and Stock Info -->
                                <div class="d-flex justify-content-between mt-2">
                                    <!-- Discount with red background -->
                                    <span class="badge bg-danger text-white">Discount: 17%</span>

                                    <!-- Stock with green background -->
                                    <span class="badge bg-success text-white"><?php echo $product->stock; ?></span>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php endforeach ?>
            </div>

            <div div="row">
                <ul class="pagination pagination-lg justify-content-end">
                    <li class="page-item disabled">
                        <a class="page-link active rounded-0 mr-3 shadow-sm border-top-0 border-left-0" href="#" tabindex="-1">1</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link rounded-0 mr-3 shadow-sm border-top-0 border-left-0 text-dark" href="#">2</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link rounded-0 shadow-sm border-top-0 border-left-0 text-dark" href="#">3</a>
                    </li>
                </ul>
            </div>
        </div>

    </div>
</div>
<!-- End Content -->
<!-- Start Brands -->
<section class="bg-light py-5">
    <div class="container my-4">
        <div class="row text-center py-3">
            <div class="col-lg-6 m-auto">
                <h1 class="h1">Our Brands</h1>
                <p>
                    At <strong>Smart Shop</strong>, we partner with the most trusted and popular brands
                    to ensure you get top-quality products. Here are some of the brands we proudly offer:
                </p>
            </div>
            <div class="col-lg-9 m-auto tempaltemo-carousel">
                <div class="row d-flex flex-row">
                    <!--Controls-->
                    <div class="col-1 align-self-center">
                        <a class="h1" href="#templatemo-slide-brand" role="button" data-bs-slide="prev">
                            <i class="text-dark fas fa-chevron-left"></i>
                        </a>
                    </div>
                    <!--End Controls-->

                    <!--Carousel Wrapper-->
                    <div class="col">
                        <div class="carousel slide carousel-multi-item pt-2 pt-md-0" id="templatemo-slide-brand" data-bs-ride="carousel">
                            <!--Slides-->
                            <div class="carousel-inner product-links-wap" role="listbox">

                                <!--First slide-->
                                <div class="carousel-item active">
                                    <div class="row">
                                        <div class="col-3 p-md-5">
                                            <a href="#"><img class=" brand-img " src="<?php echo URLROOT; ?>/public/images/samsung.png" alt="Samsung Logo"></a>
                                        </div>
                                        <div class="col-3 p-md-5">
                                            <a href="#"><img class=" brand-img " width="20%" src="<?php echo URLROOT; ?>/public/images/motorola.png" alt="Motorola Logo"></a>
                                        </div>
                                        <div class="col-3 p-md-5">
                                            <a href="#"><img class=" brand-img " width="20%" src="<?php echo URLROOT; ?>/public/images/redmi.png" alt="Redmi Logo"></a>
                                        </div>
                                        <div class="col-3 p-md-5">
                                            <a href="#"><img class=" brand-img " width="20%" src="<?php echo URLROOT; ?>/public/images/realme.png" alt="Realme Logo"></a>
                                        </div>
                                    </div>
                                </div>
                                <!--End First slide-->

                                <!--Second slide-->
                                <div class="carousel-item">
                                    <div class="row">
                                        <div class="col-3 p-md-5">
                                            <a href="#"><img class=" brand-img " width="20%" src="<?php echo URLROOT; ?>/public/images/apple.png" alt="Apple Logo"></a>
                                        </div>
                                        <div class="col-3 p-md-5">
                                            <a href="#"><img class=" brand-img" width="20%" src="<?php echo URLROOT; ?>/public/images/hp.png" alt="HP Logo"></a>
                                        </div>
                                        <div class="col-3 p-md-5">
                                            <a href="#"><img class=" brand-img " width="20%" src="<?php echo URLROOT; ?>/public/images/dell.png" alt="Dell Logo"></a>
                                        </div>
                                        <div class="col-3 p-md-5">
                                            <a href="#"><img class=" brand-img " width="20%" src="<?php echo URLROOT; ?>/public/images/lenovo.png" alt="Lenovo Logo"></a>
                                        </div>
                                    </div>
                                </div>
                                <!--End Second slide-->
                            </div>
                            <!--End Slides-->
                        </div>
                    </div>
                    <!--End Carousel Wrapper-->

                    <!--Controls-->
                    <div class="col-1 align-self-center">
                        <a class="h1" href="#templatemo-slide-brand" role="button" data-bs-slide="next">
                            <i class="text-dark fas fa-chevron-right"></i>
                        </a>
                    </div>
                    <!--End Controls-->
                </div>
            </div>
        </div>
    </div>
</section>

<!--End Brands-->

<?php require APPROOT . '/views/includes/footer.php'; ?>