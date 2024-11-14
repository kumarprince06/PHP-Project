<?php

class PageController extends Controller
{

    private $userModel;
    public function __construct()
    {

        $this->userModel = $this->model('User');
    }

    // Home Page Handler

    public function index()
    {
        $data = [
            'title' => 'Shop',

        ];

        $this->view('pages/index', $data);
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
        } elseif (!$this->userModel->getUserByEmail($data['email'])) {
            $data['emailError'] = 'No user found with that email!';
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
        $loggedInUser = $this->userModel->login($data['email'], $data['password']);

        if ($loggedInUser) {
            // Create user session on successful login
            createUserSession($loggedInUser);
            redirect('pageController/index');
            return;
        } else {
            // Set error if password is incorrect
            $data['passwordError'] = 'Incorrect password!';
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
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process Login

            // Initialization
            $data = [
                'title' => 'Shop',
                'email' => $_POST['email'],
                'password' => $_POST['password'],
                'emailError' => '',
                'passwordError' => ''
            ];

            // Validate email
            if (empty($data['email'])) {
                $data['emailError'] = 'Please enter email!';
            } elseif (!preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $data['email'])) {
                $data['emailError'] = 'Please enter valid email email!';
            } else {
                // Check email in database
                if ($this->userModel->getUserByEmail($data['email'])) {
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

                if ($this->userModel->register($data)) {
                    flashMessage('register_success', 'Registration Successful! You can now log in.');
                    redirect('pages/login');
                } else {
                    die("Something went wrong..!");
                }
            } else {
                // Load with error
                $this->view('pages/register', $data);
            }
        } else {
            // Load view

            $data = [
                'title' => '',
                'email' => '',
                'password' => '',
                'emailError' => '',
                'passwordError' => ''
            ];
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
