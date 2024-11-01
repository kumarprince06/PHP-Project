<?php require APPROOT . '/views/includes/header.php'; ?>
<div style="text-align: center;">
    <h1>Welcome to Smart Shop</h1>
    <?php flashMessage('message'); ?>

    <?php if (isLoggedIn()) : ?> <!-- Check if the user is logged in -->

        <a href="<?php echo URLROOT ?>/productController/index"><button>Product</button></a>

        <?php if ($_SESSION['sessionData']['role'] == 'admin') : ?> <!-- Admin role check -->

            <a href="<?php echo URLROOT ?>/categoryController"><button>Category</button></a>
            <a href="<?php echo URLROOT; ?>/admin/dashboard"><button>Dashboard</button></a>
        <?php elseif ($_SESSION['sessionData']['role'] == 'customer') : ?> <!-- Customer role check -->

            <a href="<?php echo URLROOT; ?>/userController/dashboard"><button>Dashboard</button></a>
        <?php endif; ?>

        <a href="<?php echo URLROOT ?>/pageController/logout"><button>Logout</button></a>
    <?php else : ?> <!-- User not logged in -->

        <a href="<?php echo URLROOT ?>/pageController/login"><button>Login</button></a>
        <a href="<?php echo URLROOT ?>/pageController/register"><button>Register</button></a>
    <?php endif; ?>
</div>

<?php require APPROOT . '/views/includes/footer.php'; ?>