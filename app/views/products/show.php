<?php require APPROOT . '/views/includes/header.php'; ?>

<?php flashMessage('successMessage'); ?>

<!-- Display product details -->
<div class="bg-light">
    <div class="container pb-5">
        <div class="row">
            <!-- Product Image Section -->
            <div class="col-lg-5 mt-5">
                <div class="card mb-3">
                    <!-- Main Product Image -->
                    <img class="card-img img-fluid" src="<?php echo URLROOT; ?>/public/images/products/<?php echo $data['images'][0]->name; ?>" alt="<?php echo htmlspecialchars($data['product']->name); ?>" id="product-detail">
                </div>

                
                <!-- Image Carousel -->
                <div class="row">
                    <div class="col-1 align-self-center">
                        <a href="#multi-item-example" role="button" data-bs-slide="prev">
                            <i class="text-dark fas fa-chevron-left"></i>
                            <span class="sr-only">Previous</span>
                        </a>
                    </div>
                    <div id="multi-item-example" class="col-10 carousel slide carousel-multi-item" data-bs-ride="carousel">
                        <div class="carousel-inner product-links-wap" role="listbox">
                            <!-- Check if images are available -->
                            <?php if (!empty($data['images'])): ?>
                                <?php foreach (array_chunk($data['images'], 3) as $index => $imageChunk): ?>
                                    <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                                        <div class="row">
                                            <?php foreach ($imageChunk as $image): ?>
                                                <div class="col-4">
                                                    <a href="#">
                                                        <img class="card-img img-fluid bg-white rounded" src="<?php echo URLROOT; ?>/public/images/products/<?php echo $image->name; ?>" alt="Product Image">
                                                    </a>
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <!-- Fallback if no images -->
                                <div class="carousel-item active">
                                    <div class="row">
                                        <div class="col-12">
                                            <a href="#">
                                                <img class="card-img img-fluid" src="<?php echo URLROOT; ?>/public/images/products/default.jpg" alt="Default Product Image">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-1 align-self-center">
                        <a href="#multi-item-example" role="button" data-bs-slide="next">
                            <i class="text-dark fas fa-chevron-right"></i>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- End Product Image Section -->

            <!-- Product Info Section -->
            <div class="col-lg-7 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h1 class="h2 fw-bold"><?php echo $data['product']->name; ?></h1>
                        <p class="h3 py-1">₹<?php echo number_format($data['product']->selling_price, 2); ?></p>
                        <p class="py-2 m-0">
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-warning"></i>
                            <i class="fa fa-star text-secondary"></i>
                            <span class="list-inline-item text-dark">Rating 4.8 | 36 Comments</span>
                        </p>
                        <ul class="list-inline mb-0">
                            <li class="list-inline-item">
                                <h6>Brand:</h6>
                            </li>
                            <li class="list-inline-item">
                                <p class="text-muted"><strong><?php echo $data['product']->brand; ?></strong></p>
                            </li>
                        </ul>

                        <h6>Description:</h6>
                        <p><?php echo $data['product']->description ?? 'No description available'; ?></p>
                        <ul class="list-inline mb-0">
                            <li class="list-inline-item">
                                <h6>Category:</h6>
                            </li>
                            <li class="list-inline-item">
                                <p class="text-muted"><strong><?php echo $data['product']->category_name ?? 'No category assigned'; ?></strong></p>
                            </li>
                        </ul>

                        <h6>Specifications:</h6>
                        <ul class="list-unstyled pb-2">
                            <li><strong>Type:</strong> <?php echo $data['product']->type; ?></li>
                            <li><strong>Stock:</strong> <?php echo $data['product']->stock; ?></li>
                            <li><strong>Original Price:</strong> <span class="text-muted text-decoration-line-through">₹<?php echo number_format($data['product']->original_price, 2); ?></span></li>
                        </ul>

                        <!-- Conditional Buttons Based on Stock -->
                        <?php if ($data['product']->stock > 0): ?>
                            <form action="<?php echo URLROOT; ?>/cart/add/<?php echo $data['product']->id; ?>" method="POST">
                                <div class="row pb-3">
                                    <div class="col d-grid">
                                        <button type="submit" class="btn btn-success btn-lg" name="submit" value="buy">Buy</button>
                                    </div>
                                    <div class="col d-grid">
                                        <button type="submit" class="btn btn-success btn-lg" name="submit" value="addtocart">Add To Cart</button>
                                    </div>
                                </div>
                            </form>
                        <?php else: ?>
                            <div class="alert alert-danger text-center" role="alert">
                                This product is currently out of stock.
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <!-- End Product Info Section -->
        </div>
    </div>
</div>

<?php require APPROOT . '/views/includes/footer.php'; ?>