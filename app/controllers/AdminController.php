<?php

class AdminController extends Controller
{
    private $mailService;
    private $orderService;
    private $productService;
    private $userService;
    private $categoryService;
    private $imageService;
    public function __construct()
    {
        if (!isLoggedIn()) {
            redirect('pages/login');
        }
        $this->orderService = new OrderService;
        $this->mailService = new MailService;
        $this->productService = new ProductService;
        $this->userService = new UserService;
        $this->categoryService = new CategoryService;
        $this->imageService = new ImageService;
    }

    public function dashboard()
    {
        $data = [
            'monthly' => $this->orderService->getRevenueOverView()['monthly'],
            'yearly' => $this->orderService->getRevenueOverView()['yearly'],
            'yearlyOrder' => $this->orderService->getOrderOverview()['yearlyOrder'],
            'productCount' => $this->productService->getTotalProductCount(),
            'userCount' => $this->userService->getTotalUserCount(),
            'OrderDetail' => $this->orderService->getAllOrders(),
            'salesCount' => $this->orderService->getTotalSalesCount(),
        ];

        $this->view('admin/dashboard', $data);
    }

    public function order_management()
    {
        $orders = $this->orderService->getAllOrders();  // Fetch all orders

        if (empty($orders)) {
            error_log('No orders to display');
        }
        $data = ['orders' => $orders];  // Pass the orders to the view
        $this->view('admin/order', $data);
    }

    public function update_order_status()
    {
        // Check if the form is submitted via POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            flashErrorMessage('errorMessage', 'Invalid request!');
            redirect('adminController/order_management');
        }
        // Get the posted data
        $orderId = $_POST['order_id'];
        $status = $_POST['status'];
        $userEmail = $_POST['email'];

        error_log("Email: " . $userEmail);
        // Validate data (you can also add more validation as needed)
        if (empty($orderId) || empty($status) || empty($userEmail)) {
            error_log('Error: Missing order ID or status or user email');
            return;
        }

        // Call the OrderService to update the order status
        $updateSuccess = $this->orderService->updateOrderStatus($orderId, $status);

        // Check if the update was successful
        if ($updateSuccess) {
            //  Send the order confirmation email to the customer
            $this->mailService->sendOrderUpdateNotificationWithPHPMailer($orderId, $userEmail, $status);
            // Redirect or display a success message
            redirect('adminController/order_management');
            exit;
        } else {
            // Log failure or display an error message
            error_log('Failed to update the order status');
        }
    }

    public function inventory()
    {
        $topSellingProduct = $this->productService->getTopSellingProduct();
        // $products = $this->productService->getAllProducts();
        $categories = $this->categoryService->getAllCategories();
        $lowAndOutOfStockCounts = $this->productService->getLowAndOutOfStockCounts();

        // Pagination parameters
        $itemsPerPage = 6;
        $currentPage = isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 0 ? (int)$_GET['page'] : 1;
        $offset = ($currentPage - 1) * $itemsPerPage;

        // Fetch products and total product count
        $products = $this->productService->getPaginatedProducts($itemsPerPage, $offset);
        $totalProducts = $this->productService->getTotalProductCount();

        // Calculate total pages
        $totalPages = ceil($totalProducts / $itemsPerPage);


        $data = [
            'topSellingProduct' => $topSellingProduct,
            'products' => $products,
            'categories' => $categories,
            'topSellingProduct' => $this->productService->getTopSellingProduct(),
            'productCount' => $this->productService->getTotalProductCount(),
            'stockCount' => $lowAndOutOfStockCounts,
            'currentPage' => $currentPage,
            'totalPages' => $totalPages,
        ];


        $this->view('admin/inventory', $data);
    }

    public function addProduct()
    {
        $category = $this->categoryService->getAllCategories();

        $data = [
            'category' => $category,
        ];

        $this->view('admin/addProduct', $data);
    }

    public function editProduct($id)
    {
        // Fetch existing post
        $product = $this->productService->getProductById($id);
        $image = $this->imageService->getImagesByProductId($id);
        $categoryList = $this->categoryService->getAllCategories();
        $data = [
            'title' => 'Shop',
            'id' => $product->id,
            'name' => $product->name,
            'brand' => $product->brand,
            'originalPrice' => $product->original_price,
            'sellingPrice' =>  $product->selling_price,
            'type' => $product->type,
            'category' => $product->category,
            'stock' => $product->stock,
            'description' => $product->description,
            'nameError' => '',
            'brandError' => '',
            'originalPriceError' => '',
            'sellingPriceError' => '',
            'typeError' => '',
            'stockError' => '',
            'imageError' => '',
            'descriptionError' => '',
            'categoryList' => $categoryList,
            'productImage' => $image
        ];

        $this->view('admin/editProduct', $data);
    }

    public function changePassword()
    {
        // Initialize error messages and form data
        $data = [
            'oldPassword' => trim($_POST['oldPassword'] ?? ''),
            'newPassword' => trim($_POST['newPassword'] ?? ''),
            'confirmPassword' => trim($_POST['confirmPassword'] ?? ''),
            'oldPasswordError' => '',
            'newPasswordError' => '',
            'confirmPasswordError' => ''
        ];

        // Handle the POST request
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validate input fields
            $this->validatePasswordFields($data);

            // If no validation errors, check and update password
            if ($this->isValidPasswordData($data)) {
                // Check if the old password is correct
                if ($this->userService->checkOldPassword($data['oldPassword'], $_SESSION['sessionData']['userEmail'])) {
                    // Hash the new password and update it
                    $hashedNewPassword = password_hash($data['newPassword'], PASSWORD_BCRYPT);
                    if ($this->userService->updatePassword($hashedNewPassword, $_SESSION['sessionData']['userEmail'])) {
                        flashMessage('successMessage', 'Password changed successfully');
                        redirect('/adminController/dashboard');
                    } else {
                        flashErrorMessage('errorMessage', 'Failed to change password');
                        $this->view('admin/changePasswordForm', $data);
                    }
                } else {
                    flashErrorMessage('errorMessage', 'Old password is incorrect');
                    $this->view('admin/changePasswordForm', $data);
                }
            } else {
                // If validation fails, show the form with errors
                $this->view('admin/changePasswordForm', $data);
            }
        } else {
            // If GET request, just show the form
            $this->view('admin/changePasswordForm');
        }
    }

    // Validate password fields
    private function validatePasswordFields(&$data)
    {
        if (empty($data['oldPassword'])) {
            $data['oldPasswordError'] = 'Old password is required.';
        }

        if (empty($data['newPassword'])) {
            $data['newPasswordError'] = 'New password is required.';
        }

        if (empty($data['confirmPassword'])) {
            $data['confirmPasswordError'] = 'Confirm password is required.';
        }

        if ($data['newPassword'] !== $data['confirmPassword']) {
            $data['confirmPasswordError'] = 'Passwords do not match.';
        }
    }

    // Check if the form data is valid
    private function isValidPasswordData($data)
    {
        return empty($data['oldPasswordError']) && empty($data['newPasswordError']) && empty($data['confirmPasswordError']);
    }
}
