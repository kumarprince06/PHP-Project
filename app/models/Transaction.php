<?php

class Transaction
{
    // Properties
    private $transaction_id;
    private $user_id;
    private $order_id;
    private $payment_intent;
    private $amount_total;
    private $currency;
    private $payment_status;
    private $created_at;
    private $expires_at;
    private $status;
    private $customer_email;
    private $customer_name;
    private $payment_method_type;
    private $billing_country;

    // Constructor
    public function __construct($data = [])
    {
        if (!empty($data)) {
            $this->transaction_id = $data['transaction_id'] ?? null;
            $this->user_id = $data['user_id'] ?? null;
            $this->order_id = $data['order_id'] ?? null;
            $this->payment_intent = $data['payment_intent'] ?? null;
            $this->amount_total = $data['amount_total'] ?? null;
            $this->currency = $data['currency'] ?? 'usd';
            $this->payment_status = $data['payment_status'] ?? 'pending';
            $this->created_at = $data['created_at'] ?? date('Y-m-d H:i:s');
            $this->expires_at = $data['expires_at'] ?? null;
            $this->status = $data['status'] ?? 'incomplete';
            $this->customer_email = $data['customer_email'] ?? null;
            $this->customer_name = $data['customer_name'] ?? null;
            $this->payment_method_type = $data['payment_method_type'] ?? 'card';
            $this->billing_country = $data['billing_country'] ?? null;
        }
    }

    // Getters
    public function getTransactionId()
    {
        return $this->transaction_id;
    }
    public function getUserId()
    {
        return $this->user_id;
    }
    public function getOrderId()
    {
        return $this->order_id;
    }
    public function getPaymentIntent()
    {
        return $this->payment_intent;
    }
    public function getAmountTotal()
    {
        return $this->amount_total;
    }
    public function getCurrency()
    {
        return $this->currency;
    }
    public function getPaymentStatus()
    {
        return $this->payment_status;
    }
    public function getCreatedAt()
    {
        return $this->created_at;
    }
    public function getExpiresAt()
    {
        return $this->expires_at;
    }
    public function getStatus()
    {
        return $this->status;
    }
    public function getCustomerEmail()
    {
        return $this->customer_email;
    }
    public function getCustomerName()
    {
        return $this->customer_name;
    }
    public function getPaymentMethodType()
    {
        return $this->payment_method_type;
    }
    public function getBillingCountry()
    {
        return $this->billing_country;
    }

    // Setters
    public function setTransactionId($transaction_id)
    {
        $this->transaction_id = $transaction_id;
    }
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }
    public function setOrderId($order_id)
    {
        $this->order_id = $order_id;
    }
    public function setPaymentIntent($payment_intent)
    {
        $this->payment_intent = $payment_intent;
    }
    public function setAmountTotal($amount_total)
    {
        $this->amount_total = $amount_total;
    }
    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }
    public function setPaymentStatus($payment_status)
    {
        $this->payment_status = $payment_status;
    }
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }
    public function setExpiresAt($expires_at)
    {
        $this->expires_at = $expires_at;
    }
    public function setStatus($status)
    {
        $this->status = $status;
    }
    public function setCustomerEmail($customer_email)
    {
        $this->customer_email = $customer_email;
    }
    public function setCustomerName($customer_name)
    {
        $this->customer_name = $customer_name;
    }
    public function setPaymentMethodType($payment_method_type)
    {
        $this->payment_method_type = $payment_method_type;
    }
    public function setBillingCountry($billing_country)
    {
        $this->billing_country = $billing_country;
    }

    // Method to save transaction to the database
    public function save()
    {
        // Assuming you have a $db connection and a `transactions` table
        global $db;

        $sql = "INSERT INTO transactions (
                    transaction_id, user_id, order_id, payment_intent,
                    amount_total, currency, payment_status, created_at,
                    expires_at, status, customer_email, customer_name,
                    payment_method_type, billing_country
                ) VALUES (
                    :transaction_id, :user_id, :order_id, :payment_intent,
                    :amount_total, :currency, :payment_status, :created_at,
                    :expires_at, :status, :customer_email, :customer_name,
                    :payment_method_type, :billing_country
                )";

        $db->query($sql);
        $db->bind(':transaction_id', $this->transaction_id);
        $db->bind(':user_id', $this->user_id);
        $db->bind(':order_id', $this->order_id);
        $db->bind(':payment_intent', $this->payment_intent);
        $db->bind(':amount_total', $this->amount_total);
        $db->bind(':currency', $this->currency);
        $db->bind(':payment_status', $this->payment_status);
        $db->bind(':created_at', $this->created_at);
        $db->bind(':expires_at', $this->expires_at);
        $db->bind(':status', $this->status);
        $db->bind(':customer_email', $this->customer_email);
        $db->bind(':customer_name', $this->customer_name);
        $db->bind(':payment_method_type', $this->payment_method_type);
        $db->bind(':billing_country', $this->billing_country);

        return $db->execute();
    }
}
