<?php

// Upload Image Function
function uploadImage(&$data)
{
    // Check if image is uploaded
    if (isset($_FILES['images']) && $_FILES['images']['error'] === UPLOAD_ERR_OK) {
        $imageTmpName = $_FILES['images']['tmp_name'];
        $imageName = $_FILES['images']['name'];
        $imageSize = $_FILES['images']['size'];
        $imageError = $_FILES['images']['error'];
        $imageExtension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));

        // Validate the image
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

        if (!in_array($imageExtension, $allowedExtensions)) {
            $data['imageError'] = "Invalid image type. Allowed types are: jpg, jpeg, png, gif.";
        }

        if ($imageSize > 5 * 1024 * 1024) { // 5MB max size
            $data['imageError'] = "Image size is too large. Maximum size is 5MB.";
        }

        // Move image to upload folder
        if (empty($data['imageError'])) {
            echo APPROOT;
            echo URLROOT;
            $uploadDirectory = APPROOT . '/../public/images/'; // Server path to the images directory

            $newImageName = uniqid('', true) . '.' . $imageExtension; // Generate a unique filename
            $uploadPath = $uploadDirectory . $newImageName;

            if (move_uploaded_file($imageTmpName, $uploadPath)) {
                $data['image'] = $newImageName; // Save only the image filename in data
            } else {
                $data['imageError'] = "Failed to upload the image.";
            }
        }
    } else {
        $data['imageError'] = "Image is required.";
    }
}
