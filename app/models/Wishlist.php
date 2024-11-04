<?php
class Wishlist
{
    private $db;
    private $id;
    private $userId;
    private $productId;

    public function __construct()
    {
        $this->db = new Database();
    }

    // Getter Setter 
    public function getId(){
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getUserId(){
        return $this->userId;
    }

    public function setUserId($userId){
        $this->userId = $userId;
    }

    public function getProductId(){
        return $this->productId;
    }

    public function setProductId($productId){
        $this->productId = $productId;
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

}
