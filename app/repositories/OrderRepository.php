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
                error_log('Failed to add order item: Order ID: ' . $orderItemData['orderId'] . ' Product ID: " ' . $orderItemData['productId']);
            }
        } catch (Exception $e) {
            error_log("Error adding order item: " . $e->getMessage());
            return false;
        }
    }

    public function getOrderItemsByUserId($userId)
    {
        // SQL Query to fetch orders and their related order items for a specific user
        $sql = "SELECT
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
                o.user_id = :userId
            ORDER BY
                o.order_date DESC";

        // Prepare and bind parameters
        $this->db->query($sql);
        $this->db->bind(':userId', $userId);

        // Try executing the query and handle any potential errors
        try {
            return $this->db->resultSet(); // Fetch and return the result set as an array
        } catch (Exception $e) {
            // Log or handle the error as required
            error_log("Error fetching order items for user $userId: " . $e->getMessage());
            return []; // Return an empty array or handle accordingly
        }
    }


    public function getMonthlyRevenue($currentYear)
    {
        $sql = "SELECT DATE_FORMAT(order_date, '%M') AS month, 
                SUM(total) AS revenue
                FROM orders 
                WHERE status = 'Delivered' AND YEAR(order_date) =:year
                GROUP BY DATE_FORMAT(order_date, '%M'), MONTH(order_date) 
                ORDER BY MONTH(order_date)";
        $this->db->query($sql);
        $this->db->bind(':year', $currentYear);

        return $this->db->resultSet();
    }

    public function getYearlyRevenue($years = 5)
    {
        $currentYear = date('Y');
        // Calculate the starting year for the query (e.g., 5 years ago)
        $startYear = $currentYear - $years + 1;

        // Query to fetch yearly revenue
        $sql = "SELECT YEAR(order_date) AS year, SUM(total) AS revenue
            FROM orders
            WHERE status = 'Delivered'
            AND YEAR(order_date) BETWEEN :startYear AND :currentYear
            GROUP BY YEAR(order_date)
            ORDER BY YEAR(order_date)";

        $this->db->query($sql); // Pass the query to db handler

        // Bind the values for :startYear and :currentYear
        $this->db->bind(':startYear', $startYear);
        $this->db->bind(':currentYear', $currentYear);

        // Capture and return the result
        return $this->db->resultSet();
    }

    public function getDailyOrderCount()
    {
        $this->db->query("SELECT DATE(order_date) AS order_date, COUNT(*) AS daily_order_count
                            FROM orders
                            GROUP BY DATE(order_date)
                            ORDER BY order_date DESC");
        return $this->db->resultSet(); // Fetch and return the result set
    }

    public function getMonthlyOrderCount()
    {
        $this->db->query('
        SELECT YEAR(order_date) AS year, MONTH(order_date) AS month, COUNT(*) AS monthly_order_count
        FROM orders
        GROUP BY YEAR(order_date), MONTH(order_date)
        ORDER BY year DESC, month DESC
    ');
        return $this->db->resultSet();
    }

    public function getYearlyOrderCount()
    {
        $this->db->query(" SELECT YEAR(order_date) AS year, COUNT(*) AS yearly_order_count
                            FROM orders
                            GROUP BY YEAR(order_date)
                            ORDER BY year DESC");
        return $this->db->resultSet();
    }

    public function getAllOrders()
    {
        // Query to fetch orders with the status not 'Completed'
        $this->db->query("SELECT 
                            orders.id AS order_id,
                            orders.order_date,
                            orders.total AS order_total, -- Total stored in the orders table
                            SUM(order_items.price * order_items.quantity) AS calculated_total, -- Total calculated from items
                            orders.status,
                            users.name AS customer_name,
                            users.email AS customer_email,
                            SUM(order_items.quantity) AS total_quantity
                        FROM 
                            orders
                        JOIN 
                            users ON orders.user_id = users.id
                        JOIN 
                            order_items ON orders.id = order_items.order_id
                        GROUP BY 
                            orders.id, orders.order_date, orders.total, orders.status, users.name, users.email
                        ORDER BY 
                            orders.order_date DESC");
        try {
            // Attempt to get the result set from the query
            return $this->db->resultSet();
        } catch (Exception $e) {
            // Log the error if there was an exception while executing the query
            error_log("Error fetching orders: " . $e->getMessage());
            return [];  // Return an empty array on error
        }
    }

    public function updateOrderStatus($orderId, $status)
    {
        // SQL query to update the status of an order
        $query = "UPDATE orders SET status = :status WHERE id = :orderId";

        // Prepare the query
        $this->db->query($query);
        $this->db->bind(':status', $status);
        $this->db->bind(':orderId', $orderId);

        // Execute the query and check if it's successful
        return $this->db->execute();
    }

    public function getTotalSalesCount()
    {
        $currentYear = date('Y');

        $sql = "SELECT DATE_FORMAT(o.order_date, '%M') AS month, 
                   SUM(oi.quantity) AS total_sales
            FROM orders o
            JOIN order_items oi ON o.id = oi.order_id
            WHERE o.status = 'Delivered' AND YEAR(o.order_date) = :year
            GROUP BY DATE_FORMAT(o.order_date, '%M'), MONTH(o.order_date)
            ORDER BY MONTH(o.order_date)";

        $this->db->query($sql);
        $this->db->bind(':year', $currentYear);

        return $this->db->resultSet();
    }

    public function getOrderedProductDetailsByOrderId($orderId)
    {
        $this->db->query("SELECT 
                            p.name AS product_name,
                            oi.quantity,
                            oi.price,
                            img.name AS image
                        FROM order_items oi
                        JOIN products p ON p.id = oi.product_id
                        LEFT JOIN images img ON img.product_id = p.id
                        JOIN orders o ON o.id = oi.order_id
                        WHERE oi.order_id = :order_id  -- Filter by the specific order_id
                        AND img.id = (
                            SELECT MIN(i.id)
                            FROM images i
                            WHERE i.product_id = p.id
                        )
                        ORDER BY oi.product_id;
        ");
        $this->db->bind(':order_id', $orderId);
        return $this->db->resultSet();
    }
}
