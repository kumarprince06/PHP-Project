<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet" crossorigin="anonymous">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap" rel="stylesheet">
    <!-- External CSS -->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/templatemo.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/admin-dashboard.css">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">

</head>

<body class="bg-light">
    <!-- Header -->
    <?php
    // Get the current URL path
    $currentPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    // Extract the last segment (e.g., 'dashboard')
    $activeTab = basename($currentPath);
    ?>
    <header id="header" class="header fixed-top d-flex align-items-center bg-dark text-white">
        <div class="d-flex align-items-center justify-content-between">
            <a href="<?php echo URLROOT; ?>/adminController/dashboard" class="logo d-flex align-items-center"> Admin Dashboard
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div>
        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">
                <li class="nav-item dropdown pe-3">
                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <img src="<?php echo URLROOT; ?>/public/images/profile.jpg" alt="admin profile" class="rounded-circle">
                        <span class="d-none d-md-block dropdown-toggle ps-2 text-white"><?php echo $_SESSION['sessionData']['userName'] ?></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6><?php echo $_SESSION['sessionData']['userName'] ?></h6>
                            <span><?php echo ucwords($_SESSION['sessionData']['role']); ?></span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="<?php echo URLROOT ?>/adminController/profile">
                                <i class="bi bi-person"></i>
                                <span>Profile</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="<?php echo URLROOT ?>/pageController/logout">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </header>
    <!-- End Header -->
    <!-- Sidebar -->
    <aside id="sidebar" class="sidebar bg-dark text-white">
        <ul class="sidebar-nav" id="sidebar-nav">
            <li class="nav-item">
                <a href="<?php echo URLROOT; ?>/adminController/dashboard" class="nav-link <?php echo ($activeTab === 'dashboard') ? 'active text-light' : ''; ?>">
                    <i class=" bi bi-house-door-fill"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo URLROOT; ?>/adminController/inventory" class="nav-link <?php echo $activeTab === 'inventory' ? 'active text-white' : ''; ?>">
                    <i class="bi bi-box-seam"></i>
                    <span>Inventory</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo URLROOT; ?>/categoryController/category" class="nav-link <?php echo $activeTab === 'category' ? 'active text-white' : ''; ?>">
                    <i class="fa fa-list-alt" aria-hidden="true"></i>
                    <span>Category</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo URLROOT; ?>/adminController/order_management" class="nav-link <?php echo $activeTab == 'order_management' ? 'active text-white' : ''; ?>">
                    <i class="bi bi-cart-fill"></i>
                    <span>Orders</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?php echo URLROOT; ?>/adminController/profile" class="nav-link <?php echo $activeTab == 'profile' ? 'active text-white' : ''; ?>">
                    <i class="bi bi-person-circle"></i>
                    <span>Profile</span>
                </a>
            </li>
        </ul>
    </aside>
    <!-- End Sidebar -->