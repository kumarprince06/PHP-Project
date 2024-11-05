<?php
class OrderRepository
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function beginTransaction()
    {
        $this->db->beginTransaction();
    }

    public function commit()
    {
        $this->db->commit();
    }

    public function rollback()
    {
        $this->db->rollback();
    }

    public function createOrder($userId, $totalAmount)
    {

        $query = "INSERT INTO orders (user_id, total) VALUES (:user_id, :total)";
        $this->db->query($query);
        $this->db->bind(':user_id', $userId);
        $this->db->bind(':total', $totalAmount);

        // Execute the query and check for success
        if ($this->db->execute()) {
            // Fetch and log the last inserted ID
            $lastId = $this->db->lastInsertId();
            return $lastId; // Return the last inserted ID
        } else {
            error_log('Failed to create order');
            return null; // Or handle the error as needed
        }
    }


    public function addOrderItem($orderId, $orderItem)
    {
        error_log("Adding order item: Order ID: $orderId, Item: " . json_encode($orderItem));

        $query = "INSERT INTO order_items (order_id, product_id, category_id, quantity, price) VALUES (:order_id, :product_id, :category_id, :quantity, :price)";
        $this->db->query($query);
        $this->db->bind(':order_id', $orderId);
        $this->db->bind(':product_id', $orderItem['product_id']);
        $this->db->bind(':category_id', $orderItem['category_id']);
        $this->db->bind(':quantity', $orderItem['quantity']);
        $this->db->bind(':price', $orderItem['price']);

        try {
            if ($this->db->execute()) {
                error_log("Order item added successfully: Order ID: $orderId, Product ID: " . $orderItem['product_id']);
            } else {
                error_log("Failed to add order item: Order ID: $orderId, Product ID: " . $orderItem['product_id']);
            }
        } catch (Exception $e) {
            error_log("Error adding order item: " . $e->getMessage());
            return false;
        }
    }
}
