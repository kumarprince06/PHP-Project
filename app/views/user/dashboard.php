<!-- <div style="text-align: center;">
    <h1>Welcome to Smart Shop</h1>
    <h3>Dashboard</h3>
    <div>
        <a href="<?php echo URLROOT; ?>"><button>Home</button></a>
        <a href="<?php echo URLROOT; ?>/userController/showWishlist"><button>Wishlist</button></a>
        <a href="<?php echo URLROOT; ?>/userController/myCart"><button>My Cart</button></a>
        <a href="<?php echo URLROOT; ?>/userController/order"><button>My Order</button></a>

    </div>
</div> -->


<?php require APPROOT . '/views/user/user-header.php'; ?>

<!-- Dashboard Tab -->
<div class="tab-pane fade show active" id="dashboard" role="tabpanel" aria-labelledby="dashboard-link">
    <div class="my-account-dashboard">
        <div class="row">
            <!-- Your Orders Card -->
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body text-center">
                        <a href="<?php echo URLROOT ?>/userController/order" class="text-decoration-none text-dark"><img src="https://res.cloudinary.com/templategalaxy/image/upload/v1631257421/codepen-my-account/images/orders_n2aopq.png" alt="Orders">
                            <h2>Your Orders</h2>
                            <p>View your past orders and track the status of current ones.</p>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Your Addresses Card -->
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body text-center">
                        <a><img src="https://res.cloudinary.com/templategalaxy/image/upload/v1631257421/codepen-my-account/images/notebook_psrhv5.png" alt="Addresses"></a>
                        <h2>Your Addresses</h2>
                        <p>Manage and update your shipping addresses.</p>
                    </div>
                </div>
            </div>

            <!-- Account Details Card -->
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body text-center">
                        <a><img src="https://res.cloudinary.com/templategalaxy/image/upload/v1631257421/codepen-my-account/images/login_aq9v9z.png" alt="Account Details"></a>
                        <h2>Account Details</h2>
                        <p>Edit your personal details and communication preferences.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Address Form Tab -->
<!-- <div class="tab-pane fade" id="address" role="tabpanel" aria-labelledby="my-address">
    <form class="tg-form">
        <div class="form-group">
            <label for="inputAddress">Shipping Address</label>
            <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
        </div>
        <div class="form-group">
            <label for="inputAddress2">Address 2</label>
            <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputCity">City</label>
                <input type="text" class="form-control" id="inputCity">
            </div>
            <div class="form-group col-md-4">
                <label for="inputState">State</label>
                <select id="inputState" class="form-control">
                    <option selected>Choose...</option>
                    <option>...</option>
                </select>
            </div>
            <div class="form-group col-md-2">
                <label for="inputZip">Zip Code</label>
                <input type="text" class="form-control" id="inputZip">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Update Address</button>
    </form>
</div> -->




<?php require APPROOT . '/views/user/user-footer.php'; ?>