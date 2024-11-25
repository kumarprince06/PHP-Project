<?php
class ImageUploadRepository
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
        foreach ($imageData as $imageUrl) {
            if (!empty($imageUrl)) { // Ensure the image URL is not empty
                $this->db->query("INSERT INTO images (product_id, image_url) VALUES (:product_id, :image_url)");
                $this->db->bind(':product_id', $id);
                $this->db->bind(':image_url', $imageUrl);

                if (!$this->db->execute()) {
                    throw new Exception("Failed to save image URL: $imageUrl");
                }
            }
        }

        return true; // Return true if all images are successfully uploaded
    }
}
