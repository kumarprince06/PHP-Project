<?php

class OrderController
{

    private $orderService;

    public function __construct()
    {
        $this->orderService = new OrderService;
    }

    public function getOrderedProductDetails()
    {
        // Get the raw input data
        $input = json_decode(file_get_contents('php://input'), true);

        if (isset($input['order_id'])) {
            $orderId = $input['order_id'];

            // Fetch ordered product details from the database
            $products = $this->orderService->getOrderedProductDetailsByOrderId($orderId);

            // Return the response as JSON
            echo json_encode(['products' => $products]);
        } else {
            // Return error if order_id is missing
            http_response_code(400);
            echo json_encode(['error' => 'Invalid request. Order ID is required.']);
        }
    }
}
