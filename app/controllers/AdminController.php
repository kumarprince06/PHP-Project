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
        $data = [
            'daily' => $revenue['daily'],
            'monthly' => $revenue['monthly'],
            'yearly' => $revenue['yearly']
        ];
        $this->view('admin/dashboard', $data);
    }

    public function order_management()
    {
        $this->view('admin/order_management');
    }
    public function user_management()
    {
        $this->view('admin/order_management');
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
}
