<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITENAME; ?></title>
    <!-- Bootstrap CSS CDN-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- External CSS -->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/style.css">

    <script src="https://js.stripe.com/v3/"></script>
    <style>
        table,
        th,
        tr,
        td {
            border: 1px solid black;
        }
    </style>
</head>

<body>

    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <!-- Brand Name on the Left -->
            <a class="navbar-brand fw-bolder fs-4" href="<?php echo URLROOT; ?>">Smart Shop</a>

            <!-- Toggler for Mobile View -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Centered Navbar Links -->
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0 fw-bold">
                    <li class="nav-item">
                        <a class="nav-link <?php echo $_SERVER['REQUEST_URI'] === '/shop/' ? 'active' : ''; ?>" aria-current="page" href="<?php echo URLROOT; ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $_SERVER['REQUEST_URI'] === '/shop/productController/' ? 'active' : ''; ?>" href="<?php echo URLROOT; ?>/productController/">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="<?php echo URLROOT; ?>/productController/">Contact</a>
                    </li>
                </ul>

                <!-- Profile Section on the Right -->
                <ul class="navbar-nav mr-2">
                    <?php if (isset($_SESSION['sessionData']['userId'])): ?>
                        <!-- Cart -->
                        <li class="nav-item">
                            <a class="nav-link p-0 mt-1" href="<?php echo URLROOT; ?>/userController/myCart">
                                <img src="https://static.vecteezy.com/system/resources/previews/019/787/018/non_2x/shopping-cart-icon-shopping-basket-on-transparent-background-free-png.png"
                                    alt="Cart" class="rounded-circle" style="width: 30px; height: 30px; object-fit: cover;">
                                <?php
                                // Number of items in the cart
                                $nummberOfItemsIncart = 0;
                                ?>
                                <!-- Badge showing number of items in cart -->
                                <span class="badge bg-danger position-absolute top-15 start-250 translate-middle p-2 mt-1 rounded-pill">
                                    <?php echo $nummberOfItemsIncart; ?>
                                </span>
                            </a>
                        </li>

                        <!-- Profile Dropdown -->
                        <li class="nav-item dropdown ms-3"> <!-- Add ms-3 here for margin start -->
                            <a class="nav-link p-0" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <!-- Profile Image -->
                                <img src="https://png.pngtree.com/png-clipart/20230927/original/pngtree-man-avatar-image-for-profile-png-image_13001882.png"
                                    alt="Profile" class="rounded-circle" style="width: 40px; height: 40px; object-fit: cover;">
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end bg-light" aria-labelledby="profileDropdown">
                                <li><a class="dropdown-item" href="<?php echo URLROOT; ?>/userController/dashboard">Dashboard</a></li>
                                <li><a class="dropdown-item" href="<?php echo URLROOT; ?>/userController/myCart">My Cart</a></li>
                                <li><a class="dropdown-item" href="<?php echo URLROOT; ?>/userController/Order">My Orders</a></li>
                                <li><a class="dropdown-item" href="<?php echo URLROOT; ?>/userController/showWishlist">Wishlist</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="<?php echo URLROOT; ?>/pageController/logout">Logout</a></li>
                            </ul>
                        </li>

                    <?php else: ?>
                        <li class="nav-item ">
                            <a class="nav-link text-light bg-dark rounded" aria-current="page" href="<?php echo URLROOT; ?>/pageController/login">Login</a>
                        </li>
                    <?php endif ?>
                </ul>

            </div>
        </div>
    </nav>


    <?php echo URLROOT ?>
    <br>
    <?php echo $_SERVER['REQUEST_URI']; ?>