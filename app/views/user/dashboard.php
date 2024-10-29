<?php require APPROOT . '/views/includes/header.php'; ?>
<div style="text-align: center;">
    <h1>Welcome to Smart Shop</h1>
    <h3>Dashboard</h3>
    <div>
        <a href="<?php echo URLROOT; ?>"><button>Home</button></a>
        <a href="<?php echo URLROOT; ?>/user/showWishlist"><button>Wishlist</button></a>
        <a href="<?php echo URLROOT; ?>/user/cart"><button>My Cart</button></a>
        <a href="<?php echo URLROOT; ?>/user/order"><button>My Order</button></a>

    </div>
</div>

<?php require APPROOT . '/views/includes/footer.php'; ?>