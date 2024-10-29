<?php
class Wishlist
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function addToWishlist($userId, $productId)
    {
        // First, check if the product is already in the user's wishlist
        if ($this->isProductInWishlist($userId, $productId)) {
            return false; // Return false if the product is already in the wishlist
        }

        $this->db->query('INSERT INTO wishlists (userId, productId) VALUES (:user_id, :product_id)');
        $this->db->bind(':user_id', $userId);
        $this->db->bind(':product_id', $productId);

        return $this->db->executePrepareStmt(); // Returns true on success
    }

    // Method to check if the product is already in the user's wishlist
    private function isProductInWishlist($userId, $productId)
    {
        $query = "SELECT * FROM wishlists WHERE userId = :user_id AND productId = :product_id";
        $this->db->query($query);
        $this->db->bind(':user_id', $userId);
        $this->db->bind(':product_id', $productId);

        $result = $this->db->singleResult(); // Assuming this returns a single row or null

        return !empty($result); // Return true if the result is not empty (product is in the wishlist)
    }

    // Optional: Method to retrieve the user's wishlist
    public function getWishlistByUserId($userId)
    {
        $query = "SELECT * FROM products INNER JOIN wishlists on products.id = wishlists.id WHERE userId = :user_id";
        $this->db->query($query);
        $this->db->bind(':user_id', $userId);

        return $this->db->resultSet(); // Assuming this returns an array of wishlist items
    }
}
