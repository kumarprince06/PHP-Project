<?php require APPROOT . '/views/includes/header.php'; ?>
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


<section class="tg-may-account-wrapp tg py-2">
    <div class="tg-account">
        <!-- Account Banner Start -->
        <div class="account-banner">
            <div class="inner-banner">
                <div class="container">
                    <!-- Row Start -->
                    <div class="row">
                        <!-- Account Info Column -->
                        <div class="col-md-8 detail">
                            <h1 class="page-title">My Account</h1>
                            <h3 class="user-name">Hello, Yash! Welcome back to Smart Shop</h3>
                        </div>

                        <!-- Profile Image Column -->
                        <div class="col-md-4 profile text-center">
                            <img src="https://res.cloudinary.com/templategalaxy/image/upload/v1631257421/codepen-my-account/images/profile_pdpo9w.png" alt="Yash" class="rounded-circle" style="width: 130px; box-shadow: 0px 0px 15px -10px #000;">
                        </div>
                    </div>
                    <!-- Row End -->

                    <!-- Navbar Start -->
                    <div class="nav-area">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="dashboard-link" data-toggle="tab" href="#dashboard" role="tab" aria-controls="dashboard" aria-selected="true">
                                    <i class="fas fa-tachometer-alt"></i>
                                    <span class="nav-text">Dashboard</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link rounded-top" id="my-order" data-toggle="tab" href="#my-orders" role="tab" aria-controls="my-orders" aria-selected="false">
                                    <i class="fas fa-file-invoice"></i>
                                    <span class="nav-text">My Orders</span>
                                </a>
                            </li>
                            <li class="nav-item rounded-top">
                                <a class="nav-link" id="my-address" data-toggle="tab" href="#address" role="tab" aria-controls="address" aria-selected="false">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <span class="nav-text">My Addresses</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link rounded-top" id="account-detail" data-toggle="tab" href="#account-details" role="tab" aria-controls="account-details" aria-selected="false">
                                    <i class="fas fa-user-alt"></i>
                                    <span class="nav-text">Account Details</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link rounded-top" id="logout" data-toggle="tab" href="#logout" role="tab" aria-controls="logout" aria-selected="false">
                                    <i class="fas fa-sign-out-alt"></i>
                                    <span class="nav-text">Logout</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- Navbar End -->
                </div>
            </div>
        </div>
        <!-- Account Banner End -->

        <!-- Tabs Content Start -->
        <div class="tabs tg-tabs-content-wrapp">
            <div class="container">
                <div class="tab-content" id="myTabContent">
                    <!-- Dashboard Tab -->
                    <div class="tab-pane fade show active" id="dashboard" role="tabpanel" aria-labelledby="dashboard-link">
                        <div class="my-account-dashboard">
                            <div class="row">
                                <!-- Your Orders Card -->
                                <div class="col-md-4 mb-3">
                                    <div class="card">
                                        <div class="card-body text-center">
                                            <a><img src="https://res.cloudinary.com/templategalaxy/image/upload/v1631257421/codepen-my-account/images/orders_n2aopq.png" alt="Orders"></a>
                                            <h2>Your Orders</h2>
                                            <p>View your past orders and track the status of current ones.</p>
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

                    <!-- My Orders Tab -->
                    <div class="tab-pane fade" id="my-orders" role="tabpanel" aria-labelledby="my-order">
                        <table id="my-orders-table" class="table table-striped table-bordered dt-responsive nowrap">
                            <thead>
                                <tr>
                                    <th>Order #</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Total</th>
                                    <th class="action">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>#12345</td>
                                    <td>Nov 15, 2024</td>
                                    <td>Shipped</td>
                                    <td>$150.00</td>
                                    <td class="action"><a href="#" class="view-order">View Order</a></td>
                                </tr>
                                <tr>
                                    <td>#12346</td>
                                    <td>Nov 14, 2024</td>
                                    <td>Completed</td>
                                    <td>$199.99</td>
                                    <td class="action"><a href="#" class="view-order">View Order</a></td>
                                </tr>
                                <tr>
                                    <td>#12347</td>
                                    <td>Nov 10, 2024</td>
                                    <td>Pending</td>
                                    <td>$80.00</td>
                                    <td class="action"><a href="#" class="view-order">View Order</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <!-- Address Form Tab -->
                    <div class="tab-pane fade" id="address" role="tabpanel" aria-labelledby="my-address">
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
                    </div>

                    <!-- Account Details Form Tab -->
                    <div class="tab-pane fade" id="account-details" role="tabpanel" aria-labelledby="account-detail">
                        <form class="tg-form">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="inputfname">First Name</label>
                                    <input type="text" class="form-control" id="inputfname" placeholder="First Name">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="inputlname">Last Name</label>
                                    <input type="text" class="form-control" id="inputlname" placeholder="Last Name">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="inputdname">Display Name</label>
                                    <input type="text" class="form-control" id="inputdname" placeholder="Display Name">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="inputEmail4">Email</label>
                                    <input type="email" class="form-control" id="inputEmail4" placeholder="Email">
                                </div>
                                <div class="form-group col-md-12">
                                    <label for="inputdob">Birthdate</label>
                                    <input type="text" class="form-control" id="inputdob" placeholder="MM/DD/YYYY">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Update Details</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Tabs Content End -->
    </div>
</section>



<?php require APPROOT . '/views/includes/footer.php'; ?>