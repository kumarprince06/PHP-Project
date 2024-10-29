<?php

class Carts extends Controller
{

    private $cartModel;
    public function __construct()
    {
        if (isLoggedIn()) {
            // Redirect to Login page
            redirect('pages/login');
        }
        $this->cartModel = $this->model('Cart');
    }



    // Add To Cart
    public function addToCart($productId)
    {
        // Check if request is POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Get the logged-in user’s ID from the session
            $userId = $_SESSION['user_id'];

            // Define quantity (assuming default is 1 if not specified)
            $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;

            // Prepare data to pass to model
            $data = [
                'userId' => $userId,
                'productId' => $productId,
                'quantity' => $quantity
            ];

            // Call the model’s addToCart method to add or update the cart item
            if ($this->cartModel->addToCart($data)) {
                flashMessage('cart_success', 'Product added to your cart!');
            } else {
                flashErrorMessage('cart_error', 'Error adding product to cart.');
            }

            // Redirect back to the products page or cart page
            redirect('products/index');
        } else {
            // If not a POST request, redirect to products page
            redirect('products/index');
        }
    }


}
