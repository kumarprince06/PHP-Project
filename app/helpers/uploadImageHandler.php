<?php

function uploadImage(&$data)
{
    // Define the target directory for image uploads
    $targetDir = getcwd() . "/images/Products/"; // Make sure the 'images' folder exists and is writable
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0777, true); // Create the directory if it doesn't exist
    }

    // Check if files are uploaded
    if (isset($_FILES['images']) && count($_FILES['images']['name']) > 0) {
        $imageNames = []; // This will store the image names for the database
        $errors = [];

        // Get the product name from the form data and sanitize it for valid filenames
        $productName = isset($data['name']) ? strtolower(str_replace(' ', '_', trim($data['name']))) : 'product';

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

            // Generate a unique name for the image based on product name and index
            $imageNumber = $i + 1; // Start numbering images from 1
            $uniqueImageName = $productName . "_" . $imageNumber . '.' . $imageExtension;

            // Define the full file path for the image
            $targetFilePath = $targetDir . $uniqueImageName;

            // Move the uploaded file to the server directory
            if (move_uploaded_file($tmpName, $targetFilePath)) {
                $imageNames[] = $uniqueImageName; // Store only the image name (not the full path) for the database
            } else {
                $errors[] = "Failed to upload image $imageName.";
            }
        }

        // Save results to data array
        $data['images'] = $imageNames; // Array of image names to store in the database
        $data['imageErrors'] = $errors;    // Array of errors if any
    } else {
        $data['imageErrors'] = ["No images were uploaded."];
    }
}
