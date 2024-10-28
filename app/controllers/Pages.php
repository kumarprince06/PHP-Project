<?php

class Pages extends Controller
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

    // Login Pgae handler
    public function login()
    {

        // Check for post request
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Process Login
            // Initialize data
            $data = [
                'title' => 'Shop',
                'email' => $_POST['email'],
                'password' => $_POST['password'],
                'emailError' => '',
                'passwordError' => ''
            ];

            // Validate email
            if (empty($data['email'])) {
                $data['emailError'] = 'Email is required..!';
            } else if (!preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $data['email'])) {
                $data['emailError'] = 'Invalid email..!';
            } else {
                // Check for user/email
                if ($this->userModel->getUserByEmail($data['email'])) {
                    // User found
                } else {
                    $data['emailError'] = 'No user found..!';
                }
            }

            // Validate password
            if (empty($data['password'])) {
                $data['passwordError'] = 'Password is required..!';
            }

            if (empty($data['emailError']) && empty($data['passwordError'])) {
                // Process login
                // Check and set logged in user
                $loggedInUser = $this->userModel->login($data['email'], $data['password']);

                if ($loggedInUser) {
                    // Create user session
                    $this->createUserSession($loggedInUser);
                    die("Success");
                } else {
                    // If login fails, set error
                    $data['passwordError'] = 'Password incorrect..!';
                    $this->view('pages/login', $data);
                }
            } else {
                // load view with error
                $this->view('pages/login', $data);
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
            $this->view('pages/login', $data);
        }
    }

    // Registration Page Handler
    public function register()
    {

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
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);

        session_destroy(); // To destroy all session

        // Redirect to the homepage or dashboard
        redirect('pages/index'); // Change 'pages/index' to your desired location

    }

    // Create user session
    public function createUserSession($user)
    {
        // Start session if not already started
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Store user data in session variables
        $_SESSION['user_id'] = $user->id; // Assuming $user has an 'id' property
        $_SESSION['user_email'] = $user->email; // Assuming $user has an 'email' property

        // Redirect to the homepage or dashboard
        redirect('pages/index'); // Change 'pages/index' to your desired location
    }
}
