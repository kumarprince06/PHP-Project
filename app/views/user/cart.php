<?php require APPROOT . '/views/includes/header.php'; ?>

<?php echo flashMessage('successMessage'); ?>
<?php echo flashErrorMessage('errorMessage'); ?>

<div class="container py-3">
    <h3 class="text-dark">My Cart</h3>
    <?php if (empty($data['cartItems'])): ?>
        <div class="text-center py-5">
            <img
                class="img-fluid w-25"
                src="<?php echo URLROOT; ?>/public/images/cart.png"
                alt="empty cart logo">
            <p class="text-dark fw-bold fw-5">Your cart is currently empty. Start shopping now!</p>
            <a href="<?php echo URLROOT; ?>/productController/index">
                <button class="btn btn-primary">See What’s Trending</button>
            </a>
        </div>
    <?php else: ?>
        <?php
        $subtotal = 0;
        $deliveryCharge = 0;
        ?>
        <div class="row">
            <!-- Cart Items -->
            <div class="col-lg-8">
                <?php foreach ($data['cartItems'] as $item): ?>
                    <?php $subtotal += $item->selling_price * $item->quantity; ?>
                    <hr />
                    <div class="cart-item py-2">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="d-flex">
                                    <img class="cart-image" src="<?php echo $item->image; ?>" alt="<?php echo $item->name; ?>" />
                                    <div class="mx-3">
                                        <h5><?php echo $item->name; ?></h5>
                                        <p>Brand: <?php echo $item->brand; ?></p>
                                        <h5>₹ <?php echo $item->selling_price; ?></h5>
                                        <small class="badge bg-success">In Stock</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 d-flex justify-content-between ">
                                <div>
                                    <form action="<?php echo URLROOT ?>/cartController/decreaseCartItemQuantity/<?php echo $item->productId ?>" method="POST" style="display:inline;">
                                        <button type="submit" class="btn btn-outline-secondary  btn-sm"><i class="fa-solid fa-minus"></i></button>
                                    </form>
                                    <span><?php echo $item->quantity; ?></span>
                                    <form action="<?php echo URLROOT ?>/cartController/increaseCartItemQuantity/<?php echo $item->productId ?>" method="POST" style="display:inline;">
                                        <button type="submit" class="btn btn-outline-secondary btn-sm"><i class="fa-solid fa-plus"></i></button>
                                    </form>
                                </div>
                                <form action="<?php echo URLROOT ?>/cartController/delete/<?php echo $item->productId ?>" method="POST">
                                    <button type="submit" class="btn btn-danger btn-sm" aria-label="Remove"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                <hr>
            </div>

            <!-- Order Summary -->
            <div class="col-lg-4">
                <?php if ($subtotal < 500) {
                    $deliveryCharge = 99;
                } ?>
                <div class="bg-light rounded-3 p-4 sticky-top">
                    <h6 class="mb-4">Order Summary</h6>
                    <div class="d-flex justify-content-between">
                        <span>Subtotal</span>
                        <span><strong>₹ <?php echo $subtotal; ?></strong></span>
                    </div>
                    <hr />
                    <div class="d-flex justify-content-between">
                        <span>Delivery Charge</span>
                        <span><strong>₹ <?php echo $deliveryCharge; ?></strong></span>
                    </div>
                    <hr />
                    <div class="d-flex justify-content-between">
                        <span>Total</span>
                        <span><strong>₹ <?php echo $subtotal + $deliveryCharge; ?></strong></span>
                    </div>
                    <form action="<?php echo URLROOT ?>/checkoutController/start" method="POST">
                        <button class="btn btn-success w-100 mt-4">Checkout</button>
                    </form>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<?php require APPROOT . '/views/includes/footer.php'; ?>