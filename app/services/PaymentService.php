<?php

use \Stripe\Stripe;
use \Stripe\Checkout\Session;

class PaymentService
{

    public function createPaymentIntent($amount, $currency = 'usd')
    {
        try {
            $paymentIntent = \Stripe\PaymentIntent::create([
                'amount' => $amount,
                'currency' => $currency,
                'payment_method_types' => ['card'],
            ]);
            return $paymentIntent;
        } catch (\Stripe\Exception\ApiErrorException $e) {
            error_log("Stripe API error: " . $e->getMessage());
            return null; // Handle this in your controller as needed
        }
    }
}
