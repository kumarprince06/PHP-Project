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

        if (!$this->db->executePrepareStmt()) {
            // Log the error for debugging
            error_log("Failed to add product with ID $productId to wishlist for user with ID $userId. Error: " . implode(", "));
            return false; // Return false if execution fails
        }

        return true; // Returns true on success

    }

    private function isProductInWishlist($userId, $productId)
    {
        $query = "SELECT * FROM wishlists WHERE userId = :user_id AND productId = :product_id";
        $this->db->query($query);
        $this->db->bind(':user_id', $userId);
        $this->db->bind(':product_id', $productId);

        $result = $this->db->singleResult(); // Assuming this returns a single row or null

        // Debug statement
        error_log("Checking if product with ID $productId is in wishlist for user with ID $userId: " . (empty($result) ? 'Not in wishlist' : 'Already in wishlist'));

        return !empty($result); // Return true if the result is not empty (product is in the wishlist)
    }


    // Method to retrieve the user's wishlist along with category information
    public function getWishlistByUserId($userId)
    {
        // Join with categories to get category details and include wishlistId
        $query = "SELECT products.*, categories.categoryName, wishlists.id AS wishlistId
                FROM products
                INNER JOIN wishlists ON products.id = wishlists.productId
                INNER JOIN categories ON products.categoryId = categories.categoryId
                WHERE wishlists.userId = :user_id";

        $this->db->query($query);
        $this->db->bind(':user_id', $userId);

        return $this->db->resultSet(); // Assuming this returns an array of wishlist items with category names and wishlistId

    }

    // Method to retrieve the user's wishlist along with category information
    public function getWishlistItemById($wishlistId)
    {
        $this->db->query("SELECT * FROM wishlists WHERE id = :wishlistId");
        $this->db->bind(':wishlistId', $wishlistId);

        // Execute the query and return the single result
        return $this->db->singleResult();
    }

    // Delete wishlist product
    public function deleteWishlist($wishlistId)
    {
        try {
            $this->db->query('DELETE FROM wishlists WHERE id = :wishlistId');
            $this->db->bind(':wishlistId', $wishlistId);

            return $this->db->executePrepareStmt();
        } catch (PDOException $e) {
            error_log("PDO Error: " . $e->getMessage());
        }
    }
}
