<?php

// Upload Image Function
function uploadImage(&$data)
{
    // Check if an image is uploaded and no image is already set in the data
    if (isset($_FILES['images']) && $_FILES['images']['error'] === UPLOAD_ERR_OK) {
        // If image is not set in data (i.e., the image field is empty or new)
        if (is_null($data['image'])) {
            $imageTmpName = $_FILES['images']['tmp_name'];
            $imageName = $_FILES['images']['name'];
            $imageSize = $_FILES['images']['size'];
            $imageError = $_FILES['images']['error'];
            $imageExtension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));

            // Validate the image type and size
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

            if (!in_array($imageExtension, $allowedExtensions)) {
                $data['imageError'] = "Invalid image type. Allowed types are: jpg, jpeg, png, gif.";
            }

            if ($imageSize > 5 * 1024 * 1024) { // 5MB max size
                $data['imageError'] = "Image size is too large. Maximum size is 5MB.";
            }

            // Move image to upload folder if there are no errors
            if (empty($data['imageError'])) {
                $uploadDirectory = APPROOT . '/../public/images/'; // Server path to the images directory
                $newImageName = uniqid('', true) . '.' . $imageExtension; // Generate a unique filename
                $uploadPath = $uploadDirectory . $newImageName;

                if (move_uploaded_file($imageTmpName, $uploadPath)) {
                    $data['image'] = $newImageName; // Save only the image filename in data
                } else {
                    $data['imageError'] = "Failed to upload the image.";
                }
            }
        } elseif (!empty($data['image'])) {
            // If the image already exists in data (i.e., no new upload), retain the old image
            $data['image'] = $data['image'];
        }
    } else {
        // If no image is uploaded and no image exists in data, show an error
        $data['imageError'] = "Image is required.";
    }
}
