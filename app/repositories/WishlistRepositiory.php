<?php

class WishlistRepositiory
{
    private $db;
    public function __construct()
    {
        $this->db = new Database;
    }

    public function addWishlist(Wishlist $wishlist)
    {
        // First, check if the product is already in the user's wishlist
        if ($this->isProductInWishlist($wishlist)) {
            return false; // Return false if the product is already in the wishlist
        }

        $this->db->query('INSERT INTO wishlists (userId, productId) VALUES (:user_id, :product_id)');
        $this->db->bind(':user_id', $wishlist->getUserId());
        $this->db->bind(':product_id', $wishlist->getProductId());

        if (!$this->db->execute()) {
            // Log the error for debugging
            error_log("Failed to add product with ID " . $wishlist->getProductId() . " to wishlist for user with ID " .  $wishlist->getUserId() . " Error: " . implode(", "));
            return false; // Return false if execution fails
        }

        return true; // Returns true on success
    }

    public function deleteWishlistItem(Wishlist $wishlist)
    {
        $this->db->query('DELETE FROM wishlists WHERE productId=:productId AND userId =:userId');
        $this->db->bind(':productId', $wishlist->getProductId());
        $this->db->bind(':userId', $wishlist->getUserId());
        return $this->db->execute();
    }

    public function getWishlistByUserId(Wishlist $wishlist)
    {
        // Query to join products, wishlists, and categories to retrieve wishlist items with category names
        $query = "SELECT products.*, categories.name AS category_name, wishlists.id AS wishlistId
              FROM products
              INNER JOIN wishlists ON products.id = wishlists.productId
              INNER JOIN categories ON products.category = categories.id
              WHERE wishlists.userId = :userId";

        // Prepare and bind the userId parameter
        $this->db->query($query);
        $this->db->bind(':userId', $wishlist->getUserId());

        // Execute and return the result set
        return $this->db->resultSet();
    }


    public function isProductInWishlist(Wishlist $wishlist)
    {
        $query = "SELECT * FROM wishlists WHERE userId = :user_id AND productId = :product_id";

        // Prepare and bind the query
        $this->db->query($query);
        $this->db->bind(':user_id', $wishlist->getUserId());
        $this->db->bind(':product_id', $wishlist->getProductId());

        // Execute and fetch the result
        $result = $this->db->singleResult();

        if ($result === false) {
            // Log an error if the query execution fails
            error_log("Database error: Unable to check if product with ID " . $wishlist->getProductId() . " is in wishlist for user with ID " . $wishlist->getUserId());
            return false; // Return false to indicate failure
        }

        // Log success status
        error_log("Status: Product with ID " . $wishlist->getProductId() . (empty($result) ? " is not in the wishlist." : " is already in the wishlist."));

        return !empty($result); // Return true if product is found in the wishlist
    }
}
