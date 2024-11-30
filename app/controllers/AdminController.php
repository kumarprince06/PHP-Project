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
        $revenue = $this->orderService->getRevenueOverView();
        $orderCount = $this->orderService->getOrderOverview();
        $productCount = $this->productService->getTotalProductCount();
        $userCount = $this->userService->getTotalUserCount();
        $data = [
            'monthly' => $revenue['monthly'],
            'yearly' => $revenue['yearly'],
            'dailyOrder' => $orderCount['dailyOrder'],
            'monthlyOrder' => $orderCount['monthlyOrder'],
            'yearlyOrder' => $orderCount['yearlyOrder'],
            'productCount' => $productCount,
            'userCount' => $userCount,
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
        $products = $this->productService->getAllProducts();
        $category = $this->categoryService->getAllCategories();
        $data = ['products' => $products, 'category' => $category];  // Store products in an associative array
        $this->view('admin/inventory', $data);  // Pass the array to the view
    }

    public function profile()
    {

        $this->view('admin/profile');
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
}
