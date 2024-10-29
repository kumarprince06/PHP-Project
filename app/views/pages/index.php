<?php require APPROOT . '/views/includes/header.php'; ?>
<div style="text-align: center;">
    <h1>Welcome to Smart Shop</h1>
    <?php flashMessage('message'); ?>
    <?php if ($_SESSION['user_id']) : ?>
        <a href="<?php echo URLROOT ?>/products/index"><button>Product</button></a>
        <a href="<?php echo URLROOT ?>/categories"><button>Category</button></a>
        <a href="<?php echo URLROOT; ?>/user/dashboard"><button>Dashboard</button></a>
        <a href="<?php echo URLROOT ?>/pages/logout"><button>Logout</button></a>
    <?php else: ?>
        <a href="<?php echo URLROOT ?>/pages/login"><button>Login</button></a>
        <a href="<?php echo URLROOT ?>/pages/register"><button>Register</button></a>
    <?php endif; ?>
</div>

<?php require APPROOT . '/views/includes/footer.php'; ?>