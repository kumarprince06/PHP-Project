<?php

// Load config file
require_once '../app/config/config.php';

// Load Url Helper file
require_once '../app/helpers/urlHelper.php';

// Load Session Helper file
require_once '../app/helpers/sessionHelper.php';

// Load User Session Helper file
require_once '../app/helpers/createUserSessionHelper.php';

// Load Product Service
require_once '../app/services/ProductService.php';

// Autoload Core libraries
spl_autoload_register(function ($className) {
    require_once 'libraries/' . $className . '.php';
});

// Load Stripe autoload file
require '../vendor/autoload.php';

// Load Model
require_once '../app/models/Category.php';
require_once '../app/models/Product.php';
require_once '../app/models/PhysicalProduct.php';
require_once '../app/models/DigitalProduct.php';
require_once '../app/models/Wishlist.php';
require_once '../app/models/Cart.php';
require_once '../app/models/Order.php';
require_once '../app/models/OrderItem.php';
require_once '../app/models/Transaction.php';
require_once '../app/models/User.php';

// Load Services
require_once '../app/services/CategoryService.php';
require_once '../app/services/ProductService.php';
require_once '../app/services/WishlistService.php';
require_once '../app/services/CartService.php';
require_once '../app/services/OrderService.php';
require_once '../app/services/PaymentService.php';
require_once '../app/services/StripeService.php';
require_once '../app/services/TransactionsService.php';
require_once '../app/services/MailService.php';
require_once '../app/services/UserService.php';

// Load Repository
require_once '../app/repositories/CategoryRepository.php';
require_once '../app/repositories/ProductRepository.php';
require_once '../app/repositories/WishlistRepositiory.php';
require_once '../app/repositories/CartRepository.php';
require_once '../app/repositories/OrderRepository.php';
require_once '../app/repositories/TransactionRepository.php';
require_once '../app/repositories/UserRepository.php';
