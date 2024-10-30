<?php

class Carts extends Controller
{

    private $cartModel;
    private $wishlistModel;
    public function __construct()
    {
        if (isLoggedIn()) {
            // Redirect to Login page
            redirect('pages/login');
        }
        $this->cartModel = $this->model('Cart');
        $this->wishlistModel = $this->model('Wishlist');
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

    // Incease Quantity Handler
    public function increase($cartId)
    {

        if ($this->cartModel->increaseQuantity($cartId)) {
            redirect('user/myCart');
        }
    }

    // Decrease Quantity Handler
    public function decrease($cartId)
    {

        if ($this->cartModel->decreaseQuantity($cartId)) {
            redirect('user/myCart');
        }
    }

    // Add Wishlist item
    public function addWishlistProductToCart($productId)
    {
        // Check if the request is POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Get the wishlist ID from the form submission
            $wishlistId = $_POST['wishlistId'];

            // Get the user ID from the session
            $userId = $_SESSION['user_id'];

            // Retrieve the wishlist item (assuming you have a wishlistModel with this method)
            $wishlistItem = $this->wishlistModel->getWishlistItemById($wishlistId);

            if (!$wishlistItem) {
                flashErrorMessage('cart_error', 'Wishlist item not found.');
                redirect('user/showWishlist');
                return;
            }

            // Add to cart (assuming quantity is 1)
            $cartData = [
                'userId' => $userId,
                'productId' => $productId,
                'quantity' => 1 // Assuming quantity is stored in the wishlist item
            ];

            if ($this->cartModel->addToCart($cartData)) {
                // Remove from wishlist after adding to cart
                $this->wishlistModel->deleteWishlist($wishlistId);
                flashMessage('wishlistMessage', 'Product added to your cart.');
            } else {
                flashErrorMessage('errorMessage', 'Failed to add product to cart.');
            }

            // Redirect to the cart page or wishlist page
            redirect('user/showWishlist');
        } else {
            // Redirect if not a POST request
            redirect('user/showWishlist');
        }
    }

    // Delete cart item
    public function delete($cartId)
    {
        // Check POST Request
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Get user ID from session
            $userId = $_SESSION['user_id'];

            // Call the model method to delete the cart item
            if ($this->cartModel->deleteCartItem($cartId, $userId)) {
                flashMessage('cart_success', 'Item removed from your cart successfully!');
            } else {
                flashErrorMessage('cart_error', 'Failed to remove item from your cart. Please try again.');
            }

            // Redirect back to the cart page
            redirect('user/myCart');
        } else {
            // If not a POST request, redirect back to the cart page
            redirect('user/myCart');
        }
    }
}
