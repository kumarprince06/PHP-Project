<?php

// App Root
define('APPROOT', dirname(dirname(__FILE__)));

// URL Root
define('URLROOT', 'http://localhost/shop');

// Site name
define('SITENAME', 'Shop');


// Database configuration

define('DB_HOST', 'localhost');
define('DB_NAME', 'crud');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '#M.S.Dhoni07@');

// APP Version
define('APPVERSION', '1.0.0');


// stripe_config.php
require_once __DIR__ . '/../../vendor/autoload.php';

\Stripe\Stripe::setApiKey('sk_test_51PddMgLgyvtECR7RJNqJhPVVIneo0i28PMSmFk6dRf5RoKsM6EZfzdchKz4VoHotZQsCV2WPVUXAm3Ip0jaJgAqa00JMKk5Hw3');


// Stripe Payment API configuration
define('STRIPE_PUBLISHABLE_KEY', 'pk_test_51PddMgLgyvtECR7RyFwMHQmJQjvJfNL9QhOzJcg2s0CQKcDEKqrhRZrwQ0ZzKc4uIhESthtd9klxY0gGVE8Iv0Lf00p4uCUK3M');
define('STRIPE_SECRET_KEY', 'sk_test_51PddMgLgyvtECR7RJNqJhPVVIneo0i28PMSmFk6dRf5RoKsM6EZfzdchKz4VoHotZQsCV2WPVUXAm3Ip0jaJgAqa00JMKk5Hw3');


// Cloudinary API Configuration
define('CLOUDINARY_API_SECRET', 'Oh1xYdFX4zYjYtNjZUmGYxcFbEo');
define('CLOUDINARY_API_KEY', '632459119565537');
define('CLOUDINARY_CLOUD_NAME', 'dspumsfwh');
define('CLOUDINARY_FOLDER_NAME', 'smart_shop');

use Cloudinary\Cloudinary;

$cloudinary = new Cloudinary([
    'cloud' => [
        'cloud_name' => CLOUDINARY_CLOUD_NAME,  // Use the defined constant here
        'api_key'    => CLOUDINARY_API_KEY,    // Use the defined constant here
        'api_secret' => CLOUDINARY_API_SECRET, // Use the defined constant here
    ],
]);
