<?php

class PageController extends Controller
{
    private $userService;
    private $cartService;
    private $productService;
    public function __construct()
    {
        $this->userService = new UserService;
        $this->cartService = new CartService;
        $this->productService = new ProductService;
    }
    // Home Page Handler
    public function index()
    {
        // Initialize cart items
        $cartitems = [];

        // Check if the user is logged in
        if (isLoggedIn()) {
            // Fetch cart items for the logged-in user
            $cartitems = $this->cartService->getCartItemsByUserId($_SESSION['sessionData']['userId']);
            // die(var_dump($cartitems));
        }

        // Fetch Product
        $products = $this->productService->getAllProducts();

        // Prepare data for the view
        $data = [
            'title' => 'Shop',
            'cartCount' => count($cartitems), // Use count() to get the number of items
            'products' => $products
        ];

        // Load the view
        $this->view('pages/index', $data);
    }


    // About Page Handler
    public function about()
    {
        // Initialize cart items
        $cartitems = [];

        // Check if the user is logged in
        if (isLoggedIn()) {
            // Fetch cart items for the logged-in user
            $cartitems = $this->cartService->getCartItemsByUserId($_SESSION['sessionData']['userId']);
            // die(var_dump($cartitems));
        }
        // Prepare data for the view
        $data = [
            'title' => 'Shop',
            'cartCount' => count($cartitems) // Use count() to get the number of items
        ];
        $this->view('pages/about', $data);
    }

    // Contact Page Handler
    public function contact()
    {
        // Initialize cart items
        $cartitems = [];

        // Check if the user is logged in
        if (isLoggedIn()) {
            // Fetch cart items for the logged-in user
            $cartitems = $this->cartService->getCartItemsByUserId($_SESSION['sessionData']['userId']);
            // die(var_dump($cartitems));
        }
        // Prepare data for the view
        $data = [
            'title' => 'Shop',
            'cartCount' => count($cartitems) // Use count() to get the number of items
        ];
        $this->view('pages/contact', $data);
    }

    // Login Page handler
    public function login()
    {
        // Redirect if already logged in
        if (isLoggedIn()) {
            redirect('pageController/index');
            return;
        }

        // Check for POST request
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->view('pages/login');
            return;
        }

        // Initialize data
        $data = [
            'title' => 'Shop',
            'email' => trim($_POST['email']),
            'password' => trim($_POST['password']),
            'emailError' => '',
            'passwordError' => ''
        ];

        // Validate email
        if (empty($data['email'])) {
            $data['emailError'] = 'Email is required!';
        } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $data['emailError'] = 'Invalid email format!';
        } else {
            $row = $this->userService->getUserByEmail($data['email']);
            if (empty($row)) {
                $data['emailError'] = 'No user found with that email!';
            }
        }

        // Validate password
        if (empty($data['password'])) {
            $data['passwordError'] = 'Password is required!';
        }

        // Check if there are no validation errors
        if (!empty($data['emailError']) && !empty($data['passwordError'])) {
            // Load the view with errors if validation fails or login unsuccessful
            $this->view('pages/login', $data);
        }
        // Attempt to log in user
        $user = new User;
        $user->setEmail($data['email']);
        $user->setPassword($data['password']);
        $loggedInUser = $this->userService->login($user);

        if ($loggedInUser) {
            // Create user session on successful login
            createUserSession($loggedInUser);
            if ($_SESSION['sessionData']['role'] === 'admin') {
                error_log("redirecting to admin dashboard");
                redirect('adminController/dashboard');
            } else {
                redirect('pageController/index');
            }
            return;
        } else {
            // Set error if password is incorrect
            $data['passwordError'] = 'Invalid password. Please double-check and try again.';
            $this->view('pages/login', $data);
            return;
        }
    }

    // Registration Page Handler
    public function register()
    {
        // Check if user is already logged in
        if (isLoggedIn()) {
            redirect('pages/index'); // Redirect to home or another page if logged in
        }

        // Check for post request
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            // Load view
            $this->view('pages/register');
        }
        // Process Login

        // Initialization
        $data = [
            'title' => 'Shop',
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'password' => $_POST['password'],
            'nameError' => '',
            'emailError' => '',
            'passwordError' => ''
        ];
        // Validate name
        if (empty($data['name'])) {
            $data['nameError'] = 'Name is required..!';
        }

        // Validate email
        if (empty($data['email'])) {
            $data['emailError'] = 'Email is required..!';
        } elseif (!preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $data['email'])) {
            $data['emailError'] = 'Please enter valid email email!';
        } else {
            // Check email in database
            if ($this->userService->getUserByEmail($data['email'])) {
                $data['emailError'] = 'Email already exists!';
            }
        }

        // Validate password
        if (empty($data['password'])) {
            $data['passwordError'] = 'Password is required..!';
        } elseif (strlen($data['password']) < 6) {
            $data['passwordError'] = 'Password must be atleast 6 characters..!';
        }

        if (empty($data['emailError']) && empty($data['passwordError'])) {
            // Process Registration
            // Hash password
            $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
            $user = new User;
            $user->setName($data['name']);
            $user->setEmail($data['email']);
            $user->setPassword($data['password']);
            if ($this->userService->register($user)) {
                flashMessage('register_success', 'Registration Successful! You can now log in.');
                redirect('pages/login');
            } else {
                die("Something went wrong..!");
            }
        } else {
            // Load with error
            $this->view('pages/register', $data);
        }
    }

    // Logout User
    public function logout()
    {
        unset($_SESSION['sessionData']);

        session_destroy(); // To destroy all session

        // Redirect to the homepage or dashboard
        redirect('pages/index'); // Change 'pages/index' to your desired location

    }
}
