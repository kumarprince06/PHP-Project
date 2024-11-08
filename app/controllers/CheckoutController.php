<?php
// app/Controllers/CheckoutController.php
class CheckoutController extends Controller
{
    protected $stripeService;
    protected $transactionRepository;
    protected $cartService;
    private $productService;
    private $orderService;
    private $userId;
    private $userEmail;
    private $mailService;

    public function __construct()
    {
        $this->stripeService = new StripeService();
        $this->transactionRepository = new TransactionRepository();
        $this->cartService = new CartService;
        $this->productService = new ProductService;
        $this->orderService = new OrderService;
        $this->userId = $_SESSION['sessionData']['userId'] ?? null;
        $this->userEmail = $_SESSION['sessionData']['userEmail'] ?? null;

        $this->mailService = new MailService;
    }

    public function start()
    {
        // Get cart items and user details from session or other storage
        if (!$this->userId) {
            // Handle user not logged in
            flashErrorMessage('User is not logged in.');
            redirect('userController/login'); // Redirect to login page
        }

        $cart = new CartService;
        $cartItems = $cart->getCartItemsByUserId($this->userId);
        if (empty($cartItems)) {
            // Handle empty cart error
            flashErrorMessage('Your cart is empty.');
            redirect('userController/myCart'); // Redirect to cart page with message
        }

        // Create a Stripe Checkout session
        $checkoutURL = $this->stripeService->createCheckoutSession($cartItems, $this->userId);

        if ($checkoutURL) {
            // Redirect to Stripe Checkout page
            header("Location: " . $checkoutURL);
            exit();
        } else {
            // Handle error in creating the session
            flashErrorMessage('Error creating Stripe checkout session.');
            redirect('cartController');
        }
    }

    public function success()
    {
        // Retrieve the session ID from the query string
        $sessionId = $_GET['session_id'] ?? null;  // Ensure session_id is set
        if (!$sessionId) {
            flashErrorMessage('Session ID is missing.');
            redirect('cartController');
        }

        try {
            // Fetch the session details from Stripe using the session ID
            $session = \Stripe\Checkout\Session::retrieve($sessionId);

            // Retrieve cart Data
            $cart = new CartService;
            $cartItems = $cart->getCartItemsByUserId($_SESSION['sessionData']['userId']);
            // Check the payment status
            if ($session->payment_status == 'paid') {
                // Save the order and order items into the database
                $this->saveOrder($session, $cartItems);
                // Redirect to the success page
                flashMessage('successMessage', 'Your order has been placed successfully!');
                redirect('userController/order');
            } else {
                // Handle failed payment status
                flashErrorMessage('Payment was not successful.');
                redirect('userController/myCart');
            }
        } catch (\Stripe\Exception\ApiErrorException $e) {
            // Handle any Stripe API errors
            flashErrorMessage('There was an error processing your payment.');
            redirect('userController/myCart');
        }
    }

    private function saveOrder($session, $cartItems)
    {
        // Create the order in the orders table
        $orderId = $this->orderService->createOrder($this->userId, $session->amount_total);

        // Loop through the items and save them to the order_items table
        foreach ($cartItems as $item) {
            // Create data array to insert each order item
            $data = [
                'orderId' => $orderId,         // The order ID you just created
                'productId' => $item->productId,  // Product ID
                'categoryId' => $item->category,  // Category of the product
                'quantity' => $item->quantity,    // Quantity the user is buying
                'price' => $item->selling_price,  // Price per unit (selling price)
            ];

            // Add the order item with the correct data
            $this->orderService->addOrderItem($data);  // Pass the data array to add the item
            $this->productService->updateStock($item->productId, $item->quantity);
            // Remove cart item from the user's cart after completion of order
            $cart = new Cart;
            $cart->setUserId($this->userId);
            $cart->setProductId($item->productId);
            $this->cartService->deleteCartItem($cart);
        }


        //  Send the order confirmation email to the customer
        $this->mailService->sendOrderNotificationWithPHPMailer($orderId, $this->userEmail);
    }
}
