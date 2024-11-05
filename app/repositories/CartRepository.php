<?php
class CartRepository
{
    protected $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    // Method to add or update a cart item
    public function addToCart(Cart $cart)
    {

        error_log("Assigned Quantity");
        // Default quantity to 1 if not provided
        if (!$cart->getQuantity()) {
            $cart->setQuantity(1);
        }
        error_log("Checking product Presence");
        // Check if the product already exists in the user's cart
        $query = "SELECT * FROM cart WHERE userId =:userId AND productId =:productId";
        $this->db->query($query);
        $this->db->bind(':userId', $cart->getUserId());
        $this->db->bind(':productId', $cart->getProductId());
        $existingItem = $this->db->singleResult();

        if ($existingItem) {
            // Update the existing cart item
            error_log("Product Already Present");
            $query = "UPDATE cart SET quantity = quantity + :quantity WHERE userId = :userId AND productId = :productId";
            $this->db->query($query);
            $this->db->bind(':quantity', $cart->getQuantity());
            $this->db->bind(':userId', $cart->getUserId());
            $this->db->bind(':productId', $cart->getProductId());
            return $this->db->execute();
        } else {
            error_log("New Product");
            // Insert a new cart item
            $query = "INSERT INTO cart (userId, productId, quantity) VALUES (:userId, :productId, :quantity)";
            $this->db->query($query);
            $this->db->bind(':userId', $cart->getUserId());
            $this->db->bind(':productId', $cart->getProductId());
            $this->db->bind(':quantity', $cart->getQuantity());
            return $this->db->execute();
        }
    }

    // Method to increase quantity
    public function increaseQuantity(Cart $cart)
    {
        $query = "UPDATE cart SET quantity = quantity + 1 WHERE userId = :userId AND productId = :productId";
        $this->db->query($query);
        $this->db->bind(':userId', $cart->getUserId());
        $this->db->bind(':productId', $cart->getProductId());
        return $this->db->execute();
    }


    // Method to decrease quantity
    public function decreaseQuantity(Cart $cart)
    {
        $query = "UPDATE cart SET quantity = quantity - 1 WHERE userId = :userId AND productId =:productId AND quantity > 1";
        $this->db->query($query);
        $this->db->bind(':userId', $cart->getUserId());
        $this->db->bind(':productId', $cart->getProductId());
        return $this->db->execute();
    }

    // Method to delete a cart item
    public function deleteCartItem(Cart $cart)
    {
        $query = "DELETE FROM cart WHERE userId = :userId AND productId = :productId";
        $this->db->query($query);
        $this->db->bind(':userId', $cart->getUserId());
        $this->db->bind(':productId', $cart->getProductId());
        return $this->db->execute();
    }

    // 
    public function getCartItemsByUserId($userId)
    {
        $query = "SELECT cart.cartId AS cartId, products.id AS productId, products.name, 
                     products.brand, products.selling_price, cart.quantity, 
                     (products.selling_price * cart.quantity) AS total_price
              FROM cart
              INNER JOIN products ON cart.productId = products.id
              WHERE cart.userId = :user_id";

        $this->db->query($query);
        $this->db->bind(':user_id', $userId);

        return $this->db->resultSet(); // Returns an array of cart items
    }


    public function clearCartByUserId($userId)
    {
        $query = "DELETE FROM cart WHERE userId = :userId";
        $this->db->query($query);
        $this->db->bind(':userId', $userId);
        $this->db->execute();
    }
}
