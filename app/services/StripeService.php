<?php

use \Stripe\Stripe;
use \Stripe\Checkout\Session;

class StripeService
{
    public function __construct()
    {
        Stripe::setApiKey(STRIPE_SECRET_KEY); // Replace with actual Stripe Secret Key
    }

    public function createCheckoutSession($cartItems, $userId)
    {
        // Prepare line items from cart items
        $line_items = array_map(function ($item) {

            return [
                'price_data' => [
                    'currency' => 'inr',
                    'product_data' => [
                        'name' => $item->name,
                    ],
                    'unit_amount' => $item->selling_price * 100,
                ],
                'quantity' => $item->quantity,
            ];
        }, $cartItems);

        try {
            // Create a Stripe Checkout session
            $checkout_session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => $line_items,
                'mode' => 'payment',
                'success_url' => URLROOT . '/checkoutController/success?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => URLROOT . '/checkoutController/cancel',
                'locale' => 'en',
                'customer_email' => $_SESSION['sessionData']['userEmail'],
                'metadata' => [
                    'user_id' => $userId,
                ],
            ]);
            return $checkout_session->url;
        } catch (Exception $e) {
            error_log('Stripe error: ' . $e->getMessage());
            return false;
        }
    }
}
