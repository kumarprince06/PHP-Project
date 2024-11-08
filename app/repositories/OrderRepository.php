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
        $this->db->bind(':total', $totalAmount / 100);

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


    public function addOrderItem($orderItemData)
    {
        $query = "INSERT INTO order_items (order_id, product_id, category_id, quantity, price) VALUES (:order_id, :product_id, :category_id, :quantity, :price)";
        $this->db->query($query);
        $this->db->bind(':order_id', $orderItemData['orderId']);
        $this->db->bind(':product_id', $orderItemData['productId']);
        $this->db->bind(':category_id', $orderItemData['categoryId']);
        $this->db->bind(':quantity', $orderItemData['quantity']);
        $this->db->bind(':price', $orderItemData['price']);

        try {
            if (!$this->db->execute()) {
                error_log('Failed to add order item: Order ID: ' . $orderItemData['orderId']. ' Product ID: " '. $orderItemData['productId']);
            }
        } catch (Exception $e) {
            error_log("Error adding order item: " . $e->getMessage());
            return false;
        }
    }

    public function getOrderItemsByUserId($userId)
    {
        // Query to fetch orders and their related order items
        $sql = "SELECT
                    o.id AS order_id,
                    o.order_date,
                    o.total AS order_total,
                    o.status AS order_status,
                    oi.product_id,
                    p.name AS product_name,
                    p.brand AS product_brand,
                    p.original_price,
                    p.selling_price,
                    oi.quantity,
                    oi.price AS item_price,
                    oi.category_id
                FROM
                    orders AS o
                INNER JOIN
                    order_items AS oi ON o.id = oi.order_id
                INNER JOIN
                    products AS p ON oi.product_id = p.id
                WHERE
                    o.user_id =:userId
                ORDER BY
                    o.order_date DESC";

        $this->db->query($sql);
        $this->db->bind(':userId', $userId);

        // Fetch and return the result set
        return $this->db->resultSet();
    }
}
