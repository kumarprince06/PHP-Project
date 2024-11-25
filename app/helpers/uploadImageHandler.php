<?php

function uploadImage(&$data)
{
    global $cloudinary;

    // Check if files are uploaded
    if (isset($_FILES['images']) && count($_FILES['images']['name']) > 0) {
        $imageUrls = [];
        $errors = [];

        // Loop through each file uploaded
        for ($i = 0; $i < count($_FILES['images']['name']); $i++) {
            $imageName = $_FILES['images']['name'][$i];
            $imageSize = $_FILES['images']['size'][$i];
            $tmpName = $_FILES['images']['tmp_name'][$i];
            $imageExtension = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));

            // Validate the image type and size
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
            if (!in_array($imageExtension, $allowedExtensions)) {
                $errors[] = "Invalid type for image $imageName. Allowed types are: jpg, jpeg, png, gif.";
                continue;
            }

            if ($imageSize > 5 * 1024 * 1024) { // 5MB max size
                $errors[] = "Image $imageName is too large. Maximum size is 5MB.";
                continue;
            }

            // Upload the image to Cloudinary
            try {
                $response = $cloudinary->uploadApi()->upload(
                    $tmpName,
                    ['folder' => CLOUDINARY_FOLDER_NAME]
                );
                $imageUrls[] = $response['secure_url']; // Store the image URL
            } catch (Exception $e) {
                error_log("Cloudinary upload failed: " . $e->getMessage());
                $errors[] = "Failed to upload image $imageName: " . $e->getMessage();
            }
        }

        // Save results to data array
        $data['imageUrls'] = $imageUrls; // Array of uploaded URLs
        $data['imageErrors'] = $errors; // Array of errors if any
    } else {
        $data['imageErrors'] = ["No images were uploaded."];
    }
}
