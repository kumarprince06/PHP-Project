<?php

function deleteImageFromDirectory($image)
{
    $imagePath = URLROOT . '/public/images/' . $image;
    // Check if the file exists before attempting to delete it
    if (file_exists($imagePath)) {
        return unlink($imagePath);  // Attempt to delete the file
    }

    return false;  // Return false if the file does not exist
}
