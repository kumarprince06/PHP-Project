<?php
class UserController extends Controller
{

    private $wishlistService;
    private $cartService;
    private $orderService;
    public function __construct()
    {
        // Check if user is not logged in
        if (!isLoggedIn()) {
            redirect('pages/login'); // Redirect to home or another page if logged in
        }
        $this->wishlistService = new WishlistService();
        $this->cartService = new CartService();
        $this->orderService = new OrderService;
    }


    // User Dashboard
    public function dashboard()
    {

        $this->view('user/dashboard');
    }

    // Add To Wishlist
    public function addToWishlist($productId)
    {
        // Check Post Request
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            flashMessage('errorMessage', 'Something went wrong!');
            redirect('productController/index');
            return;
        }
        $wishlist = new Wishlist;
        $wishlist->setUserId($_SESSION['sessionData']['userId']);
        $wishlist->setProductId($productId);
        if ($this->wishlistService->addWishlist($wishlist)) {
            flashMessage('successMessage', 'Product added to your wishlist!');
            redirect('productController/index'); // Redirect to wishlist page
        } else {
            // If product is already in the wishlist
            flashErrorMessage('errorMessage', 'Product is already in your wishlist!');
            redirect('productController/index'); // Redirect to wishlist page
        }
    }

    // Show wishlist
    public function showWishlist()
    {

        $wishlist = new Wishlist;
        $wishlist->setUserId($_SESSION['sessionData']['userId']);
        $data['wishlist'] = $this->wishlistService->getWishlistByUserId($wishlist);

        $this->view('user/wishlist', $data);
    }

    // Delete wishlist Item
    public function delete($productId)
    {
        // check for post request
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

            flashErrorMessage('errorMessage', '');
            redirect('userController/showWishlist');
        }
        // Proccess
        $wishlist = new Wishlist;
        $wishlist->setUserId($_SESSION['sessionData']['userId']);
        $wishlist->setProductId($productId);
        echo $wishlist->getUserId();
        echo $wishlist->getProductId();
        if ($this->wishlistService->deleteWishlistItem($wishlist)) {
            flashMessage('successMessage', 'Product deleted successfully');
            redirect('userController/showWishlist');
            return;
        }

        flashErrorMessage('errorMessage', 'Product not removed from wishlist');
        redirect('userController/showWishlist');
    }

    // Cart Handler
    public function myCart()
    {
        // Get the logged-in user ID from the session
        $userId = $_SESSION['sessionData']['userId'];

        // Fetch the cart items for the user
        $cartItems = $this->cartService->getCartItemsByUserId($userId);

        // Prepare data to pass to the view
        $data = [
            'title' => 'My Cart',
            'cartItems' => $cartItems
        ];

        // Load the cart view with the data
        $this->view('user/cart', $data);
    }

    // My Order Handler
    public function order()
    {
        // Get the logged-in user ID from the session
        $userId = $_SESSION['user_id'];

        // Fetch the cart items for the user
        // $cartItems = $this->cartModel->getOrderItemsByUserId($userId);

        // Prepare data to pass to the view
        $data = [
            'title' => 'My Cart',
            // 'cartItems' => $cartItems
        ];

        // Load the cart view with the data
        $this->view('user/order', $data);
    }

    public function checkout()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            flashErrorMessage('errorMessage', 'Invalid request method');
            redirect('userController/myCart');
            return;
        }

        $userId = $_SESSION['sessionData']['userId'];

        if ($this->orderService->processCheckout($userId)) {
            flashMessage('successMessage', 'Order placed successfully!');
        } else {
            flashErrorMessage('checkout_error', 'Failed to place order. Please try again.');
        }

        redirect('userController/order');
    }
}
