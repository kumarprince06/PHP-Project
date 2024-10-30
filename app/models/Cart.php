<?php

class Cart
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function addToCart($data)
    {
        // Check if the product is already in the cart for the current user
        $this->db->query("SELECT * FROM cart WHERE userId = :userId AND productId = :productId");
        $this->db->bind(':userId', $data['userId']);
        $this->db->bind(':productId', $data['productId']);

        $existingCartItem = $this->db->singleResult();

        if ($existingCartItem) {
            // If the product is already in the cart, update the quantity
            $newQuantity = $existingCartItem->quantity + $data['quantity'];

            $this->db->query("UPDATE cart SET quantity = :quantity WHERE userId = :userId AND productId = :productId");
            $this->db->bind(':quantity', $newQuantity);
            $this->db->bind(':userId', $data['userId']);
            $this->db->bind(':productId', $data['productId']);
        } else {
            // If the product is not in the cart, insert it as a new item
            $this->db->query("INSERT INTO cart (userId, productId, quantity) VALUES (:userId, :productId, :quantity)");
            $this->db->bind(':userId', $data['userId']);
            $this->db->bind(':productId', $data['productId']);
            $this->db->bind(':quantity', $data['quantity']);
        }

        // Execute the prepared statement
        return $this->db->executePrepareStmt();
    }

    // get Cart Items
    public function getCartItemsByUserId($userId)
    {
        $query = "SELECT cart.cartId AS cartId, products.id AS productId, products.product_name, 
                     products.brand, products.selling_price, cart.quantity, 
                     (products.selling_price * cart.quantity) AS total_price
              FROM cart
              INNER JOIN products ON cart.productId = products.id
              WHERE cart.userId = :user_id";

        $this->db->query($query);
        $this->db->bind(':user_id', $userId);

        return $this->db->resultSet(); // Returns an array of cart items
    }

    // Increase cart Item Quantity
    public function increaseQuantity($cartId)
    {
        // Assuming you have a 'quantity' column in your 'cart' table
        $this->db->query("UPDATE cart SET quantity = quantity + 1 WHERE cartId = :cartId");
        $this->db->bind(':cartId', $cartId);

        // Execute and return true if successful
        return $this->db->executePrepareStmt();
    }

    // Decrease cart Item Quantity
    public function decreaseQuantity($cartId)
    {
        // Get the current quantity of the item
        $this->db->query("SELECT quantity FROM cart WHERE cartId = :cartId");
        $this->db->bind(':cartId', $cartId);
        $currentQuantity = $this->db->singleResult()->quantity;

        if ($currentQuantity <= 1) {
            // If quantity will be 0 or less, delete the item from the cart
            $this->db->query("DELETE FROM cart WHERE cartId = :cartId");
            $this->db->bind(':cartId', $cartId);
        } else {
            // Otherwise, decrease the quantity by 1
            $this->db->query("UPDATE cart SET quantity = quantity - 1 WHERE cartId = :cartId");
            $this->db->bind(':cartId', $cartId);
        }

        // Execute and return true if successful
        return $this->db->executePrepareStmt();
    }

    // Delete a cart item by ID
    public function deleteCartItem($cartId, $userId)
    {
        // Prepare the SQL statement
        $this->db->query("DELETE FROM cart WHERE cartId = :cartId AND userId = :userId");
        $this->db->bind(':cartId', $cartId);
        $this->db->bind(':userId', $userId);

        // Execute the statement and return the result
        return $this->db->executePrepareStmt();
    }
}
