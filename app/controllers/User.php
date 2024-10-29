<?php
class User extends Controller
{

    private $wishlistModel;
    public function __construct()
    {
        // Check if user is not logged in
        if (!isLoggedIn()) {
            redirect('pages/login'); // Redirect to home or another page if logged in
        }

        $this->wishlistModel = $this->model('Wishlist');
    }


    // User Dashboard
    public function dashboard()
    {

        $this->view('user/dashboard');
    }


    public function addToWishlist($productId)
    {
        // Check Post Request
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_SESSION['user_id']; // Get the logged-in user's ID

            // Debug statement
            error_log("Attempting to add product with ID $productId to user with ID $userId");

            if ($this->wishlistModel->addToWishlist($userId, $productId)) {
                flashMessage('wishlist_success', 'Product added to your wishlist!');
                redirect('products/index'); // Redirect to wishlist page
            } else {
                // If product is already in the wishlist
                flashErrorMessage('wishlist_error', 'Product is already in your wishlist!');
                redirect('products/index'); // Redirect to wishlist page
            }
        } else {
            // Redirect to product view page
            redirect('products/');
        }
    }

    public function showWishlist()
    {
        $userId = $_SESSION['user_id'];
        $data['wishlist'] = $this->wishlistModel->getWishlistByUserId($userId);

        $this->view('user/wishlist', $data);
    }

    public function delete($wishlistId)
    {
        // check for post request
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Proccess

            if ($this->wishlistModel->deleteWishlist($wishlistId)) {
                flashMessage('wishlistMessage', 'Product deleted successfully');
                redirect('user/showWishlist');
            }
        } else {
            // Redirect to post
            redirect('user/dashboard');
        }
    }

    public function cart()
    {
        $data = [
            'title' => 'Shop'
        ];
        $this->view('user/cart', $data);
    }
}
