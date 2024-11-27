<?php

function deleteImageFromCloudinary($imageName, $folderName)
{
    // Define the target directory for product images
    $targetDir = getcwd() . '/images/' . $folderName . '/';

    // Generate the file path to the image
    $targetFilePath = $targetDir . $imageName;

    // Log the generated file path for debugging
    error_log("Attempting to delete image: " . $targetFilePath);

    // Check if the target path is a file
    if (is_file($targetFilePath)) {
        // Try deleting the file and log the result
        if (unlink($targetFilePath)) {
            error_log("Successfully deleted image: " . $imageName);
        } else {
            error_log("Failed to delete image: " . $imageName);
        }
    } else {
        // Log if the path is not a file
        error_log("The target is not a file or does not exist: " . $targetFilePath);
    }
}
