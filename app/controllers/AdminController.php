<?php

class AdminController extends Controller
{

    private $orderService;
    public function __construct()
    {
        if (!isLoggedIn()) {
            redirect('pages/login');
        }
        $this->orderService = new OrderService;
    }

    public function dashboard()
    {
        $revenue = $this->orderService->getRevenueOverView();
        $orderCount = $this->orderService->getOrderOverview();
        $data = [
            'daily' => $revenue['daily'],
            'monthly' => $revenue['monthly'],
            'yearly' => $revenue['yearly'],
            'dailyOrder' => $orderCount['dailyOrder'],
            'monthlyOrder' => $orderCount['monthlyOrder'],
            'yearlyOrder' => $orderCount['yearlyOrder'],

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
        $this->view('admin/order_management', $data);
    }

    public function revenue_overview()
    {
        $revenue = $this->orderService->getRevenueOverView();
        $data = [
            'daily' => $revenue['daily'],
            'monthly' => $revenue['monthly'],
            'yearly' => $revenue['yearly']
        ];
        $this->view('admin/revenue_overview', $data);
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

        // Validate data (you can also add more validation as needed)
        if (empty($orderId) || empty($status)) {
            error_log('Error: Missing order ID or status');
            return;
        }

        // Call the OrderService to update the order status
        $updateSuccess = $this->orderService->updateOrderStatus($orderId, $status);

        // Check if the update was successful
        if ($updateSuccess) {
            // Redirect or display a success message
            redirect('adminController/order_management');
            exit;
        } else {
            // Log failure or display an error message
            error_log('Failed to update the order status');
        }
    }
}
