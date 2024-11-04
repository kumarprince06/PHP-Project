<?php

class CartController extends Controller
{

    private $cartService;
    private $wishlistService;
    public function __construct()
    {
        if (isLoggedIn()) {
            // Redirect to Login page
            redirect('pages/login');
        }
        $this->cartService = new CartService;
        $this->wishlistService = new WishlistService;
    }



    // Add To Cart
    public function addToCart($productId)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            flashErrorMessage('errorMessage', 'Invalid request');
            redirect('productController/index');
            return;
        }

        $cart = new Cart;
        $cart->setUserId($_SESSION['sessionData']['userId']);
        $cart->setQuantity(isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1);
        $cart->setProductId($productId);

        if ($this->cartService->addToCart($cart)) {
            flashMessage('successMessage', 'Product added to your cart!');
        } else {
            flashErrorMessage('errorMessage', 'Error adding product to cart.');
        }

        redirect('productController/index');
    }

    // Increase Cart Item Quantity
    public function increaseCartItemQuantity($productId)
    {

        $cart = new Cart;
        $cart->setUserId($_SESSION['sessionData']['userId']);
        $cart->setProductId($productId);

        if (!$this->cartService->increaseQuantity($cart)) {
            flashErrorMessage('errorMessage', 'Failed to increase quantity. Please try again.');
        }

        redirect('userController/myCart');
    }

    // Decrease Cart Item Quantity
    public function decreaseCartItemQuantity($productId)
    {

        $cart = new Cart;
        $cart->setUserId($_SESSION['sessionData']['userId']);
        $cart->setProductId($productId);
        if (!$this->cartService->decreaseQuantity($cart)) {

            flashErrorMessage('cart_error', 'Failed to decrease quantity. Please try again.');
        }
        redirect('userController/myCart');
    }

    // Add Wishlist item to Cart in CartController
    public function addWishlistProductToCart($productId)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            flashErrorMessage('errorMessage', 'Invalid request');
            redirect('user/showWishlist');
            return;
        }

        // Initialize Cart model
        $cart = new Cart;
        $cart->setUserId($_SESSION['sessionData']['userId']);
        $cart->setProductId($productId);

        // Use WishlistService to add to cart and remove from wishlist
        error_log("Goes to wishList Service");
        if ($this->wishlistService->moveWishlistItemToCart($cart)) {
            flashMessage('successMessage', 'Product added to your cart.');
        } else {
            flashErrorMessage('errorMessage', 'Failed to add product to cart.');
        }

        redirect('userController/showWishlist');
    }



    // Delete cart item
    public function delete($productId)
    {
        // Check POST Request
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

            flashErrorMessage('errorMessage', 'Invalid Request!');
            redirect('userController/myCart');
            return;
        }
        // Get user ID from session
        $cart = new Cart;
        $cart->setUserId($_SESSION['sessionData']['userId']);
        $cart->setProductId($productId);

        // Call the model method to delete the cart item
        if ($this->cartService->deleteCartItem($cart)) {
            flashMessage('successMessage', 'Item removed from your cart successfully!');
        } else {
            flashErrorMessage('errorMessage', 'Failed to remove item from your cart. Please try again.');
        }

        // Redirect back to the cart page
        redirect('userController/myCart');
    }
}
