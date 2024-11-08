<?php
class OrderService
{
    private $orderRepository;
    private $cartRepository;
    private $productRepository;
    private $paymentService;

    public function __construct()
    {
        $this->orderRepository = new OrderRepository();
        $this->cartRepository = new CartRepository();
        $this->productRepository = new ProductRepository();
        $this->paymentService = new PaymentService();
    }

    public function processCheckout($userId)
    {
        try {
            // Begin transaction
            $this->orderRepository->beginTransaction();
            error_log("Transaction started for user ID: $userId");

            // Retrieve cart items for the user
            $cartItems = $this->cartRepository->getCartItemsByUserId($userId);
            if (empty($cartItems)) {
                error_log("Error: Cart is empty for user ID: $userId");
                throw new Exception('Cart is empty');
            }

            $totalAmount = 0;
            $orderItems = [];
            // Calculate total and prepare order items
            foreach ($cartItems as $item) {
                $product = $this->productRepository->getProductById($item->productId);
                if ($product->stock < $item->quantity) {
                    error_log("Error: Insufficient stock for product ID {$item->productId}");
                    throw new Exception("Insufficient stock for product ID {$item->productId}");
                }
                $totalAmount += $product->selling_price * $item->quantity;
                $orderItems[] = [
                    'product_id' => $item->productId,
                    'quantity' => $item->quantity,
                    'price' => $product->selling_price,
                    'category_id' => $product->category
                ];
            }

            // Create a payment intent with Stripe
            $paymentIntent = $this->paymentService->createPaymentIntent($totalAmount * 100); // Amount in cents
            if (
                !$paymentIntent || !isset($paymentIntent->id)
            ) {
                error_log("Error: Payment intent creation failed.");
                throw new Exception('Failed to create payment intent');
            }

            // Create the order and get order ID
            $orderId = $this->orderRepository->createOrder($userId, $totalAmount);
            error_log("Order created successfully with ID: $orderId");

            // Insert each order item and update stock
            foreach ($orderItems as $orderItem) {
                $this->orderRepository->addOrderItem($orderId, $orderItem);
                $this->productRepository->updateStock($orderItem['product_id'], $orderItem['quantity']);
            }
            error_log("All order items processed and stock updated.");

            // Clear cart for the user
            $this->cartRepository->clearCartByUserId($userId);
            error_log("Cart cleared for user ID: $userId");

            // Commit transaction
            $this->orderRepository->commit();
            error_log("Transaction committed successfully for user ID: $userId");

            return $paymentIntent; // Return payment intent for frontend confirmation
        } catch (Exception $e) {
            // Rollback on failure
            $this->orderRepository->rollback();
            error_log("Transaction rolled back for user ID: $userId. Error: " . $e->getMessage());
            return false;
        }
    }

    public function getOrderItemsByUserId($userId)
    {
        return $this->orderRepository->getOrderItemsByUserId($userId);
    }

    public function createOrder($userId, $totalAmount)
    {
        return $this->orderRepository->createOrder($userId, $totalAmount);
    }

    public function addOrderItem($orderItemData)
    {
        return $this->orderRepository->addOrderItem($orderItemData);
    }

    public function getRevenueOverview()
    {
        $dailyRevenue = $this->orderRepository->getDailyRevenue();
        $monthlyRevenue = $this->orderRepository->getMonthlyRevenue();
        $yearlyRevenue = $this->orderRepository->getYearlyRevenue();


        // Return array structure
        return [
            'daily' => $dailyRevenue,
            'monthly' => $monthlyRevenue,
            'yearly' => $yearlyRevenue,
        ];
    }

    public function getOrderOverview()
    {
        $dailyCount = $this->orderRepository->getDailyOrderCount();
        $monthlyCount = $this->orderRepository->getMonthlyOrderCount();
        $yearlyCount = $this->orderRepository->getYearlyOrderCount();


        // Return array structure
        return [
            'dailyOrder' => $dailyCount,
            'monthlyOrder' => $monthlyCount,
            'yearlyOrder' => $yearlyCount,
        ];
    }

    public function getAllOrders()
    {
        $orderData = $this->orderRepository->getAllOrders();
        return $orderData;
    }

    public function updateOrderStatus($orderId, $status)
    {
        try {
            // Call the repository to update the order status
            return $this->orderRepository->updateOrderStatus($orderId, $status);
        } catch (Exception $e) {
            error_log("Error updating order status: " . $e->getMessage());
            return false;
        }
    }
}
