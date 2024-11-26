<?php
class ImageRepository
{

    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    // Image Upload Function
    public function uploadImage($id, $imageData)
    {
        // die(var_dump($imageData));
        // Ensure $imageData is an array and not empty
        if (empty($imageData) || !is_array($imageData)) {
            throw new Exception("Invalid image data. Must be a non-empty array.");
        }

        // Loop through the image URLs and insert them into the 'images' table
        foreach ($imageData as $image) {
            if (!empty($image)) { // Ensure the image URL is not empty
                $this->db->query("INSERT INTO images (product_id, name) VALUES (:product_id, :image)");
                $this->db->bind(':product_id', $id);
                $this->db->bind(':image', $image);

                if (!$this->db->execute()) {
                    throw new Exception("Failed to save image URL: $image");
                }
            }
        }

        return true; // Return true if all images are successfully uploaded
    }

    public function getImagesByProductId($id)
    {
        // Assuming 'images' is the table where product images are stored
        $this->db->query('SELECT * FROM images WHERE product_id = :id');

        // Bind the product ID to the query
        $this->db->bind(':id', $id);

        // Execute and fetch the results
        return $this->db->resultSet();
    }

    public function deleteImage($productId, $id)
    {
        $this->db->query('DELETE FROM images WHERE product_id=:productId AND id=:id');
        $this->db->bind(':productId', $productId);
        $this->db->bind(':id', $id);

        if ($this->db->execute()) {
            return true;
        }

        return false;
    }
}
