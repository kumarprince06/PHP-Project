<?php require APPROOT . '/views/includes/header.php'; ?>

<?php
// Get the current URL path
$currentPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Extract the last segment (e.g., 'dashboard')
$activeTab = basename($currentPath);

// Debugging: Print the active tab
// echo $activeTab; // Outputs: dashboard
?>

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
                            <h3 class="user-name">Hello, <?php echo $_SESSION['sessionData']['userName'] ?>! Welcome back to Smart Shop</h3>
                        </div>

                        <!-- Profile Image Column -->
                        <div class="col-md-4 profile text-center position-relative">
                            <img src="https://res.cloudinary.com/templategalaxy/image/upload/v1631257421/codepen-my-account/images/profile_pdpo9w.png" alt="Yash" class="rounded-circle" style="width: 130px; box-shadow: 0px 0px 15px -10px #000;">
                            <!-- Edit Button -->
                            <button class="btn btn-light btn-sm edit-btn rounded-circle" data-toggle="modal" data-target="#editProfileImageModal"
                                style="position: absolute; top: 20px; right: 53%; transform: translateX(-50%);">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                        </div>
                    </div>
                    <!-- Row End -->

                    <!-- Navbar Start -->
                    <div class="nav-area">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link rounded-top <?php echo ($activeTab === 'dashboard') ? 'show active' : ''; ?>" href="<?php echo URLROOT ?>/userController/dashboard">
                                    <i class="fas fa-tachometer-alt"></i>
                                    <span class="nav-text">Dashboard</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link rounded-top <?php echo ($activeTab === 'showWishlist') ? 'show active' : ''; ?>" id="wishlist-link" data-toggle="tab" href="<?php echo URLROOT ?>/userController/showWishlist" role="tab" aria-controls="wishlist" aria-selected="false">
                                    <i class="fas fa-heart"></i>
                                    <span class="nav-text">My Wishlists</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link rounded-top <?php echo ($activeTab === 'order') ? 'show active' : ''; ?>" id="my-order" data-toggle="tab" href="<?php echo URLROOT ?>/userController/order" role="tab" aria-controls="my-orders" aria-selected="false">
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