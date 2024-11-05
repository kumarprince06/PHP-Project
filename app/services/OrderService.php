<?php
class OrderService
{
    private $orderRepository;
    private $cartRepository;
    private $productRepository;

    public function __construct()
    {
        $this->orderRepository = new OrderRepository();
        $this->cartRepository = new CartRepository();
        $this->productRepository = new ProductRepository();
    }

    public function processCheckout($userId)
    {
        try {
            // Begin transaction
            $this->orderRepository->beginTransaction();
            // Retrieve cart items for the user
            $cartItems = $this->cartRepository->getCartItemsByUserId($userId);
            // die(var_dump($cartItems));
            if (empty($cartItems)) {
                throw new Exception('Cart is empty');
            }

            $totalAmount = 0;
            $orderItems = [];
            // Calculate total and prepare order items
            foreach ($cartItems as $item) {
                $product = $this->productRepository->getProductById($item->productId);

                if ($product->stock < $item->quantity) {
                    throw new Exception("Insufficient stock for product ID {$item->product_id}");
                }

                $totalAmount += $product->selling_price * $item->quantity;
                $orderItems[] = [
                    'product_id' => $item->productId,
                    'quantity' => $item->quantity,
                    'price' => $product->selling_price,
                    'category_id' => $product->category
                ];
            }

            // Create the order and get order ID
            $orderId = $this->orderRepository->createOrder($userId, $totalAmount);
            // Insert each order item and update stock
            foreach ($orderItems as $orderItem) {
                error_log('Goes for adding cart item into orderItem');
                $this->orderRepository->addOrderItem($orderId, $orderItem);
                error_log('Goes for decreasing stock from products');
                $this->productRepository->decreaseStock($orderItem['product_id'], $orderItem['quantity']);
            }

            error_log('Goes to clear cart Item');
            // Clear cart for the user
            $this->cartRepository->clearCartByUserId($userId);
            error_log('cart Item Cleared..!');
            // Commit transaction
            $this->orderRepository->commit();
            return true;
        } catch (Exception $e) {
            // Rollback on failure
            $this->orderRepository->rollback();
            return false;
        }
    }
}
